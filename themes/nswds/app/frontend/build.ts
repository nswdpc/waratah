import { $ } from "bun";
import * as sass from 'sass-embedded';
import { transform } from "lightningcss";

const DIST_JS = "./dist/js";
const DIST_CSS = "./dist/css";
const SRC_JS = "./src/js/app.js";
const SRC_SCSS = "./src/scss/app.scss";

async function clean() {
  console.log("🪥 Clean");
  await $`rm -rf ./dist ./build`;
  await $`mkdir -p ${DIST_JS} ${DIST_CSS}`;
}

async function buildJS() {
  console.log("🚀 Building JS...");
  
  const config = {
    entrypoints: [SRC_JS],
    outdir: DIST_JS,
    naming: "[name].[ext]",
    sourcemap: "external" as const,
  };

  await Bun.build({
    ...config,
    minify: false
  });

  await Bun.build({
    ...config,
    minify: true,
    naming: "[name].min.[ext]",
    sourcemap: "none" as const
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
        // Silence deprecation in nsw-design-system
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