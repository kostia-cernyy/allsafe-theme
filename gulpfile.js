const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const browserSync = require('browser-sync').create();

const paths = {
    scss: './assets/sass/**/*.sass',
    js: './assets/js/**/*.js',
    cssDest: './dist/css',
    jsDest: './dist/js',
};

function styles() {
    return gulp
        .src(paths.scss)
        .pipe(sass())
        .pipe(postcss([autoprefixer()]))
        .pipe(cleanCSS())
        .pipe(concat('main.min.css'))
        .pipe(gulp.dest(paths.cssDest))
        .pipe(browserSync.stream());
}

function scripts() {
    return gulp
        .src(paths.js)
        .pipe(concat('main.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(paths.jsDest))
        .pipe(browserSync.stream());
}

function watch() {
    browserSync.init({
        proxy: 'http://allsafe.local', // <-- твой local WP
        open: false,
        notify: false,
        ghostMode: false,
    });

    gulp.watch(paths.scss, styles);
    gulp.watch(paths.js, scripts);
    gulp.watch('./**/*.php').on('change', browserSync.reload);
}

exports.styles = styles;
exports.scripts = scripts;
exports.watch = watch;
exports.default = gulp.series(styles, scripts, watch);
