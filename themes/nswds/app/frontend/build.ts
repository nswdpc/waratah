import { $ } from "bun";
import * as sass from 'sass-embedded';
import { transform } from "lightningcss";

const DIST_JS = "./dist/js";
const DIST_CSS = "./dist/css";
const SRC_JS = "./src/js/app.js";
const SRC_SCSS = "./src/scss/app.scss";
const BUILD_JS = "./build/js";
const NSW_JS = "node_modules/nsw-design-system/dist/js/main.js";

async function clean() {
  console.log("🪥 Clean");
  await $`rm -rf ./dist ./build`;
  await $`mkdir -p ${DIST_JS} ${DIST_CSS} ${BUILD_JS}`;
}

async function buildJS() {
  console.log("🚀 Building JS...");

  // Bundle src/js/app.js to a temporary build location
  const buildResult = await Bun.build({
    entrypoints: [SRC_JS],
    outdir: BUILD_JS,
    naming: "app.js",
    sourcemap: "none",
  });

  if (!buildResult.success) {
    console.error("Build failed:", buildResult.logs);
    throw new Error("JS Build failed");
  }

  // Read vendor nsw-design-system distribution
  const nswContent = await Bun.file(NSW_JS).text();
  const appContent = await Bun.file(`${BUILD_JS}/app.js`).text();

  // Combine nsw-design-system with our built app source bundle
  const combinedJS = `${nswContent}\n;${appContent}`;
  await Bun.write(`${DIST_JS}/app.js`, combinedJS);

  // Minif
  await Bun.build({
    entrypoints: [`${DIST_JS}/app.js`],
    outdir: DIST_JS,
    naming: "app.min.js",
    minify: true,
    sourcemap: "none",
  });
}

async function buildCSS() {
  console.log("🎨 Build CSS");

  const result = await sass.compileAsync(
    SRC_SCSS,
    {
      loadPaths: [
        "node_modules"
      ],
      quietDeps: false,
      silenceDeprecations: [
        'if-function'
      ]
    }
  );

  await Bun.write("./build/css/component.css", result.css);

  const componentCss = await Bun.file("./build/css/component.css").text();

  const { code, map } = transform({
    filename: 'app.css',
    code: Buffer.from(componentCss),
    minify: true,
    sourceMap: true,
  });

  await Bun.write(`${DIST_CSS}/app.css`, componentCss);
  if (code) {
    await Bun.write(`${DIST_CSS}/app.min.css`, code);
  }
  if (map) {
    await Bun.write(`${DIST_CSS}/app.css.map`, map);
  }
}

// Orchestrate
console.time("Build took");
await clean();
await Promise.all([buildJS(), buildCSS()]);
console.timeEnd("Build took");
console.log("✅ Build Complete");
