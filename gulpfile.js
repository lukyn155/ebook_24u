const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const concat = require('gulp-concat');

function css() {
  return gulp.src('src/scss/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(cleanCSS())
    .pipe(gulp.dest('public/bin/css'));
}

function js() {
  return gulp.src('src/js/**/*.js')
    .pipe(concat('script.js'))
    .pipe(gulp.dest('public/bin/js'));
}

function watch() {
  gulp.watch('src/scss/**/*.scss', css);
  gulp.watch('src/js/**/*.js', js);
}

exports.css = css;
exports.js = js;
exports.default = gulp.series(css, js, watch);