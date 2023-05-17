import gulp from 'gulp';
import gulpSass from 'gulp-sass';
import sassCompiler from 'sass';
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import rollup from 'gulp-better-rollup';
import babel from '@rollup/plugin-babel';
import cssnano from 'cssnano';
import concat from 'gulp-concat';
import gulpTerser from 'gulp-terser';
import terser from 'terser';
import resolve from '@rollup/plugin-node-resolve'
import commonjs from '@rollup/plugin-commonjs'
import del from 'del';
import rename from 'gulp-rename';
import filter from 'gulp-filter';
import gulpDebug from 'gulp-debug';
import mkdirp from 'mkdirp';

const sass = gulpSass(sassCompiler);

const designSystem = {
  'src': {
    'js': './node_modules/nsw-design-system/dist/js/main.js',
    'css': ''
  }
};

const thirdParty = {
  'src': {
    'css' : [
      './node_modules/slim-select/dist/slimselect.css'
    ]
  }
};

const config = {
    'src': {
        'css': [
          './src/scss/app.scss'
        ],
        'js': [
          './src/js/app.js'
        ]
    },
    'dist': {
        'css': 'dist/css',
        'js': 'dist/js'
    },
    'build': {
        'css': 'build/css',
        'js': 'build/js'
    }

};

gulp.task('clean', function(done) {
    return del([ 'dist/**/*', 'build/**/*' ], { dot: true } );
});

// CSS - sass processing
gulp.task('sassBuild', function() {
    return gulp.src(config.src.css, {allowEmpty: true})
        .pipe( gulpDebug( {'title': 'SCSS process' }))
        .pipe(sass().on('error', sass.logError))
        .pipe(concat('component.css'))
        .pipe(gulp.dest(config.build.css));
});

gulp.task('cssBuild', function() {
    return gulp.src(thirdParty.src.css)
        .pipe( gulpDebug( {'title': 'Thirdparty CSS process' }))
        .pipe(concat('thirdparty.css'))
        .pipe(gulp.dest(config.build.css));
});

gulp.task('appCssBuild', function() {
     let buildFiles = [
       config.build.css + '/thirdparty.css',
       config.build.css + '/component.css',
     ];
     return gulp.src( buildFiles )
        .pipe( gulpDebug( {'title': 'App CSS build' }))
        .pipe(sourcemaps.init())
        .pipe(concat('app.css'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(config.dist.css))
        .pipe(filter('**/app.css'))
        // minify
        .pipe(postcss([
            cssnano()
        ]))
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(config.dist.css));
});

// Clean up CSS build files
gulp.task('appCssBuildCleanup', function(done) {
  gulpDebug( {'title': 'appCssBuildCleanup' });
  return del( config.build.css + '/*' );
});

// CSS processing
gulp.task('css' , gulp.series('sassBuild', 'cssBuild', 'appCssBuild') );

// JS
gulp.task('designSystemJsBuild', function() {
  return gulp.src( designSystem.src.js )
      .pipe( gulpDebug( {'title': 'Add NSW Design System JS' }))
      .pipe( concat('nswdesignsystem.js') )
      .pipe( gulp.dest(config.build.js) );
});

// Build app components
gulp.task('componentJsBuild', function() {
    return gulp.src( config.src.js, { allowEmpty: true } )
        .pipe( gulpDebug( {'title': 'Components JS build' }))
        .pipe(
            rollup(
                {
                    plugins: [
                        babel({ babelHelpers: 'bundled' }), resolve(), commonjs()
                    ],
                },
                { name: 'NSWDPC', format: 'umd', }
            )
        )
        .pipe(concat('component.js'))
        .pipe(gulp.dest(config.build.js));

});

// Combine Design System and App components
gulp.task('appJsBuild', function() {
  let buildFiles = [
    config.build.js + '/nswdesignsystem.js',
    config.build.js + '/component.js'
  ];
  return gulp.src( buildFiles )
      .pipe( gulpDebug( {'title': 'App JS processing' }))
      .pipe(sourcemaps.init())
      .pipe(concat('app.js'))
      .pipe(sourcemaps.write('.'))
      .pipe( gulp.dest(config.dist.js) )
      // filter only JS files
      .pipe(filter('**/app.js'))
      // terser
      .pipe( gulpDebug( {'title': 'Terser() app.js' }))
      .pipe( gulpTerser() )
      .pipe(rename({ suffix: '.min' }))
      .pipe(gulp.dest(config.dist.js));
});

// Clean up CSS build files
gulp.task('appJsBuildCleanup', function(done) {
  gulpDebug( {'title': 'appJsBuildCleanup' });
  return del( config.build.js + '/*' );
});

// JS build
gulp.task('js' , gulp.series('designSystemJsBuild', 'componentJsBuild', 'appJsBuild') );

// Build task, clean first
gulp.task('build', gulp.series( 'clean', gulp.parallel( 'js', 'css' ) ) );

// Watch, build
gulp.task('watch', function() {
  gulp.watch('./src/**/*', gulp.parallel( 'js', 'scss' ));
});
