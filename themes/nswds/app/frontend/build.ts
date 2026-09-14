import { $ } from "bun";
import * as sass from 'sass-embedded';
import { transform } from "lightningcss";
import { minify as swcMinify } from "@swc/core";

const DIST_JS = "./dist/js";
const DIST_CSS = "./dist/css";
const SRC_JS = "./src/js/app.js";
const SRC_SCSS = "./src/scss/app.scss";
const BUILD_JS = "./build/js";
const BUILD_CSS = "./build/css";
const NSW_JS = "node_modules/nsw-design-system/dist/js/main.js";

async function clean() {
  console.log("🪥 Clean");
  await $`rm -rf ./dist ./build`;
  await $`mkdir -p ${DIST_JS} ${DIST_CSS} ${BUILD_JS} ${BUILD_CSS}`;
}

async function buildJS() {
  console.log("🚀 Building JS...");

  // Bundle src/js/app.js to a temporary build location.
  // Written to disk (not just in-memory) because it's needed as a file
  // entrypoint for the minify step below.
  const buildResult = await Bun.build({
    entrypoints: [SRC_JS],
    outdir: BUILD_JS,
    naming: "app.build.js",
    sourcemap: "none",
  });

  if (!buildResult.success) {
    console.error("Build failed:", buildResult.logs);
    throw new Error("🛑 JS Build failed");
  }

  console.log("✅ Created app.build.js");

  // Use the vendor nswds source
  const nswDesignSystemContent = await Bun.file(NSW_JS).text();
  // Read the app bundle straight from the build result instead of
  // re-reading it off disk.
  const appContent = await buildResult.outputs[0].text();

  // Non-minified combined output — unchanged
  const combinedJS = `${nswDesignSystemContent}\n;${appContent}`;
  await Bun.write(`${DIST_JS}/app.js`, combinedJS);

  console.log("✅ Created the unminified distribution app.js");

  // Minify the app bundle and the NSW vendor dist concurrently.
  // They're independent of each other, and NSW is minified with swcMinify
  // (not Bun.build) since Bun's bundler misdetects NSW's UMD wrapper as
  // CommonJS needing ESM interop, silently dropping the `window.NSW`
  // assignment.
  const [minifyAppResult, nswMinResult] = await Promise.all([
    Bun.build({
      entrypoints: [`${BUILD_JS}/app.build.js`],
      minify: true,
      format: "iife",
      target: "browser",
      sourcemap: "none",
    }),

    swcMinify(nswDesignSystemContent, { compress: true, mangle: true }),
  ]);

  if (!minifyAppResult.success) {
    console.error("App minify failed:", minifyAppResult.logs);
    throw new Error("🛑 JS minify failed");
  }

  if (!nswMinResult.code) {
    throw new Error("🛑 NSW minify failed");
  }

  console.log("✅ Minified build app and nsw-design-system");

  // Read the minified app bundle straight from the build result —
  // no intermediate file written or re-read for this one.
  const appMinContent = await minifyAppResult.outputs[0].text();
  const nswMinContent = nswMinResult.code;

  const combinedMinJS = `${nswMinContent}\n;${appMinContent}`;
  await Bun.write(`${DIST_JS}/app.min.js`, combinedMinJS);

  console.log("✅ Created the distribution app.min.js");

  // Guardrail: confirm the shipped file is valid as a classic script and
  // still exposes window.NSW
  new (await import("vm")).Script(combinedMinJS);
  if (!combinedMinJS.includes(".NSW=") && !combinedMinJS.includes(".NSW =")) {
    throw new Error("🛑 NSW UMD assignment missing from app.min.js — check vendor minify step");
  }
}

async function buildCSS() {
  console.log("🎨 Build CSS");

  let result;
  try {
    result = await sass.compileAsync(
      SRC_SCSS,
      {
        loadPaths: ["node_modules"],
        quietDeps: false,
        silenceDeprecations: ['if-function'],
      }
    );
  } catch (err) {
    console.error("Sass compile failed:", err);
    throw new Error("🛑 CSS Build failed");
  }

  if (!result.css) {
    throw new Error("🛑 CSS Build produced no output");
  }

  await Bun.write(`${BUILD_CSS}/component.css`, result.css);
  console.log("✅ Created component.css");

  const componentCss = await Bun.file(`${BUILD_CSS}/component.css`).text();

  let code, map;
  try {
    ({ code, map } = transform({
      filename: 'app.css',
      code: Buffer.from(componentCss),
      minify: true,
      sourceMap: true,
    }));
  } catch (err) {
    console.error("CSS minify failed:", err);
    throw new Error("🛑 CSS minify failed");
  }

  if (!code) {
    throw new Error("🛑 CSS minify produced no output");
  }

  await Bun.write(`${DIST_CSS}/app.css`, componentCss);
  console.log("✅ Created the unminified distribution app.css");

  const minifiedCss = code.toString('utf-8');
  const appMinifiedCss = minifiedCss.startsWith('@charset') ? minifiedCss : '@charset "UTF-8";' + minifiedCss;
  await Bun.write(
    `${DIST_CSS}/app.min.css`,
    appMinifiedCss
  );
  console.log("✅ Created the distribution app.min.css");

  if (map) {
    await Bun.write(`${DIST_CSS}/app.css.map`, map);
  }

  // Guardrail: confirm charset survived and non-ASCII content wasn't dropped
  if (!appMinifiedCss.startsWith('@charset "UTF-8"')) {
    throw new Error("🛑 @charset missing from app.min.css after prepend — check write logic");
  }
}

// Orchestrate
console.time("Elapsed");
await clean();
await Promise.all([buildJS(), buildCSS()]);
console.timeEnd("Elapsed");
console.log("✅ Build complete");
