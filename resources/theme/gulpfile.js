const fileExists = require('file-exists');

// Requires
let gulp        = require('gulp'),
    header      = require('gulp-header'),
    less        = require('gulp-less'),
    uglify      = require('gulp-uglify'),
    cleanCSS    = require('gulp-clean-css'),
    rename      = require('gulp-rename'),
    del         = require('del');

// Load package.json for banner
let pkg = require('./package.json');
// Banner for compiled files
let banner = ['/*! <%= pkg.author %> | <%= pkg.homepage %> | <%= pkg.description %> */', ''].join('\n');
// Load themes
let theme = require('./_theme.json');
// Empty paths object
let paths = {
    "styles": {
        "styles": [],
        "sources": [
            'bower_components/uikit/dist/css/*.css',
            'node_modules/uikit/dist/css/*.css'
        ],
        "destination": "../dist/css"
    },
    "scripts": {
        "scripts": [
            'js/*.js',
            '../js/*.js'
        ],
        "sources": [
            'bower_components/uikit/dist/js/*.js',
            'node_modules/uikit/dist/js/*.js'
        ],
        "destination": "../dist/js"
    },
    "images": {
        "sources": [
            'bower_components/uikit/src/images/**',
            'node_modules/uikit/src/images/**',
            'master/images/**',
            'theme/images/**',
            '../images/**'
        ],
        "destination": "../dist/images"
    },
    "icons": {
        "sources": [
            'master/icons/**',
            'theme/icons/**',
            '../icons/**'
        ],
        "destination": "../dist/icons"
    },
    "fonts": {
        "sources": [
            'master/fonts/**',
            'theme/fonts/**',
            '../fonts/**'
        ],
        "destination": "../dist/fonts"
    }
};
// Set styles
for (const style of Object.keys(theme.styles)) {
    if(fileExists(style + ".less")) {
        paths.styles.styles[style] = style + ".less";
    }
}
// Empty destinations object
let destinations = [];
// Set destinations
for (const item of Object.values(paths)) {
    destinations.push(item.destination);
}

/* Not all tasks need to use streams, a gulpfile is just another node program
 * and you can use all packages available on npm, but it must return either a
 * Promise, a Stream or take a callback and call it
 */
function clean() {
    return del(destinations, {force: true});
}

// Compile and minify less files for all themes and theme styles
function styles() {
    for (const style of Object.keys(paths.styles.styles)) {
        gulp.src(paths.styles.styles[style])
            .pipe(less())
            .pipe(cleanCSS())
            .pipe(header(banner, { pkg : pkg }))
            .pipe(rename({
                basename: style,
                suffix: '.min'
            }))
            .pipe(gulp.dest(paths.styles.destination));
    }
}

// Compile and script files for all themes
function scripts() {
    for (const script of Object.values(paths.scripts.scripts)) {
        gulp.src(script)
            .pipe(uglify())
            .pipe(header(banner, { pkg : pkg }))
            .pipe(rename({ suffix: '.min' }))
            .pipe(gulp.dest(paths.scripts.destination));
    }
}

// Copy javascript, image, style, icons and font files
function copy() {
    for (const item of Object.values(paths)) {
        for(const source of Object.values(item.sources)) {
            gulp.src(source).pipe(gulp.dest(item.destination));
        }
    }
}

// Watch all tasks
function watch() {
    // Watch copy files
    for (const item of Object.values(paths)) {
        for(const source of Object.values(item.sources)) {
            gulp.watch(source, copy);
        }
    }
    // Watch styles
    for (const style of Object.keys(paths.styles.styles)) {
        gulp.watch(paths.styles.styles[style], styles);
    }
    // Watch scripts
    for (const script of Object.values(paths.scripts.scripts)) {
        gulp.watch(script, scripts);
    }
}

// You can use CommonJS `exports` module notation to declare tasks
exports.clean = clean;
exports.style = styles;
exports.scripts = scripts;
exports.copy = copy;
exports.watch = watch;

// Specify if tasks run in series or parallel using `gulp.series` and `gulp.parallel`
let build = gulp.series(clean, gulp.parallel(styles, scripts, copy));
let buildStyles = gulp.series(clean, gulp.parallel(styles));
let buildScripts = gulp.series(clean, gulp.parallel(scripts));
let buildCopy = gulp.series(clean, gulp.parallel(copy));
let buildWatch = gulp.series(clean, gulp.parallel(watch));

// Styles task
gulp.task('styles', buildStyles);

// Scripts task
gulp.task('scripts', buildScripts);

// Copy task
gulp.task('copy', buildCopy);

// Watch task
gulp.task('watch', buildWatch);

// Default task, that can be called by just running `gulp` from cli
gulp.task('default', build);