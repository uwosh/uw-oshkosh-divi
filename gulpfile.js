// Include gulp
const gulp = require('gulp');

// Include Our Plugins
const jshint = require('gulp-jshint');
const sass = require('gulp-sass');
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
const copy = require('gulp-copy');
const babel = require('gulp-babel');
const imagemin = require('gulp-imagemin');
const merge = require('merge-stream');
const svgo = require('gulp-svgo');
const mkdirp = require('gulp-mkdirp');
const clean = require('gulp-clean');
const runSequence = require('run-sequence');
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS = require('gulp-clean-css');
const gulpif = require('gulp-if');
const scsslint = require('gulp-scss-lint');
const browserSync = require('browser-sync').create();
const watch = require('gulp-watch');

gulp.task('serve', function(){
  // Building and piping the files before browserSync init
  runSequence('build-theme', 'bs-init');

  // Watching all files in the src
  return watch('src/**/*.*', function(){
    runSequence('build-theme', 'bs-reload');
  });
});

// Tasks for local WordPress development
gulp.task('bs-init', function(){
  browserSync.init({
      proxy: 'localhost:8080'
  });
});

gulp.task('bs-reload', function (){
    browserSync.reload();
});

gulp.task('default', function(cb){
  runSequence('build-theme');
});

gulp.task('build-theme', function(cb) {
  runSequence('clean-theme',
    ['style-theme', 'js-theme', 'images-theme', 'php-theme'],
    ['js-theme-lint', 'theme-scss-lint'],
    cb);
});

// Tasks for WordPress theme build
gulp.task('clean-theme', function() {
    return gulp.src(['dist/wp-content/themes/*', '!dist/wp-content/themes/index.php', '!dist/wp-content/themes/Divi'])
        .pipe(clean());
});

// Building the CSS
gulp.task('style-theme', function () {
  return gulp.src('src/themes/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({
      browsers: ['last 2 versions']
    }))
    .pipe(cleanCSS({
          keepSpecialComments: 1
      }))
    .pipe(gulp.dest('dist/wp-content/themes/'));
});

gulp.task('js-theme', function(){
  return gulp.src('src/themes/**/js/**/*.js')
      .pipe(babel({
        presets: ['es2015']
      }))
      .pipe(uglify())
      .pipe(gulp.dest('dist/wp-content/themes/'));
});

gulp.task('images-theme', function(){
  return gulp.src('src/themes/**/images/**/*')
      .pipe(imagemin())
      .pipe(gulp.dest('dist/wp-content/themes/'));
});

gulp.task('php-theme', function(){
  return gulp.src('src/themes/**/**/*.php')
      .pipe(gulp.dest('dist/wp-content/themes/'));
});

gulp.task('js-theme-lint', function(){
  return gulp.src('src/themes/**/js/*.js')
      .pipe(jshint({
        'esversion': 6
      }))
      .pipe(jshint.reporter('default'));
});

gulp.task('theme-scss-lint', function() {
  return gulp.src('src/themes/**/style/*.scss')
    .pipe(scsslint({'config': 'config/scss-lint-config.yml'}));
});


// // Tasks for the WordPressplugin plugin build
// gulp.task('build-plugin', function(cb) {
//   runSequence('plugin-clean', ['plugin-style', 'plugin-js', 'plugin-images', 'plugin-php'], ['plugin-js-lint', 'plugin-scss-lint'], cb);
// });
//
// // Tasks for WordPress theme build
// gulp.task('plugin-clean', function() {
//     return gulp.src('dist/wp-content/plugins/')
//         .pipe(clean());
// });
//
// // Building the CSS
// gulp.task('plugin-style', function () {
//   return gulp.src('src/plugins/**/*.scss')
//     .pipe(sass().on('error', sass.logError))
//     .pipe(autoprefixer({
//       browsers: ['last 2 versions']
//     }))
//     .pipe(cleanCSS({
//           keepSpecialComments: 1
//       }))
//     .pipe(gulp.dest('dist/wp-content/plugins/'));
// });
//
// gulp.task('plugin-js', function(){
//   return gulp.src('src/plugins/**/js/**/*.js')
//       .pipe(babel({
//         presets: ['es2015']
//       }))
//       .pipe(uglify())
//       .pipe(gulp.dest('dist/wp-content/plugins/'));
// });
//
// gulp.task('plugin-images', function(){
//   return gulp.src('src/plugins/**/img/**/*')
//       .pipe(imagemin())
//       .pipe(gulp.dest('dist/wp-content/plugins/'));
// });
//
// gulp.task('plugin-php', function(){
//   return gulp.src('src/plugins/**/**/*.php')
//       .pipe(gulp.dest('dist/wp-content/plugins/'));
// });
//
// gulp.task('plugin-js-lint', function(){
//   return gulp.src('src/plugins/**/js/*.js')
//       .pipe(jshint({
//         'esversion': 6
//       }))
//       .pipe(jshint.reporter('default'));
// });
//
// gulp.task('plugin-scss-lint', function() {
//   return gulp.src('src/plugins/**/style/*.scss')
//     .pipe(scsslint({'config': 'config/scss-lint-config.yml'}));
// });
