import { $, build, write } from "bun";
import { transform, bundle } from "lightningcss";
import * as sass from 'sass-embedded';

const DIST_JS = "./dist/js";
const DIST_CSS = "./dist/css";

async function clean() {
  console.log("🪥 Clean");
  await $`rm -rf ./dist ./build`;
  await $`mkdir -p ${DIST_JS} ${DIST_CSS}`;
}

async function buildJS() {
  console.log("🚀 Building JS...");
  
  await build({
    entrypoints: [
      "./src/js/app.js"
    ],
    outdir: DIST_JS,
    naming: "[name].[ext]",
    minify: false,
    sourcemap: "external"
  });

  await build({
    entrypoints: [
      "./src/js/app.js"
    ],
    outdir: DIST_JS,
    naming: "[name].min.[ext]",
    minify: true,
    sourcemap: "none",
  });
}

async function buildCSS() {
  console.log("🎨 Build CSS");
  
  const result = await sass.compileAsync(
    "./src/scss/app.scss",
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
await clean();
await Promise.all([buildJS(), buildCSS()]);
console.log("✅ Build Complete");