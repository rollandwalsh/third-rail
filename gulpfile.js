var fs = require('fs');
var path = require('path');

var gulp = require('gulp');
var plugins = require('gulp-load-plugins')();
var sass = require('gulp-sass');

// Temporary solution until gulp 4
// https://github.com/gulpjs/gulp/issues/355
var runSequence = require('run-sequence');

var pkg = require('./package.json');
var dirs = {
  "dist": "dist",
  "src": "src",
  "test": "test"
};

// --------------------
// HELPER TASKS
// --------------------

gulp.task('clean', function (done) {
    require('del')([
        dirs.dist
    ], done);
});

gulp.task('copy', [
    'copy:.htaccess',
    'copy:index.html',
    'copy:jquery',
    'copy:misc',
    'copy:normalize',
    'sass'
]);

gulp.task('copy:.htaccess', function () {
    return gulp.src('node_modules/apache-server-configs/dist/.htaccess')
               .pipe(plugins.replace(/# ErrorDocument/g, 'ErrorDocument'))
               .pipe(gulp.dest(dirs.dist));
});

gulp.task('copy:index.html', function () {
    return gulp.src(dirs.src + '/index.html')
                 .pipe(plugins.replace(/{{JQUERY_VERSION}}/g, pkg.devDependencies.jquery))
               .pipe(gulp.dest(dirs.dist));
});

gulp.task('copy:jquery', function () {
    return gulp.src(['node_modules/jquery/dist/jquery.min.js'])
               .pipe(plugins.rename('jquery-' + pkg.devDependencies.jquery + '.min.js'))
               .pipe(gulp.dest(dirs.dist + '/js/vendor'));
});

gulp.task('copy:app.css', function () {

    var banner = '/*! Third Rail v' + pkg.version +
                    ' | ' + pkg.license + ' License' +
                    ' | ' + pkg.homepage + ' */\n\n';

    return gulp.src(dirs.src + '/css/app.css')
               .pipe(plugins.header(banner))
               .pipe(plugins.autoprefixer({
                   browsers: ['last 2 versions', 'ie >= 8', '> 1%'],
                   cascade: false
               }))
               .pipe(gulp.dest(dirs.dist + '/css'));
});

gulp.task('copy:misc', function () {
    return gulp.src([
      dirs.src + '/**/*',
      
      '!' + dirs.src + '/scss/*', // Needs fix
      '!' + dirs.src + '/index.html'
    ], {
      dot: true
    }).pipe(gulp.dest(dirs.dist));
});

gulp.task('copy:normalize', function () {
    return gulp.src('node_modules/normalize.css/normalize.css')
               .pipe(gulp.dest(dirs.dist + '/css'));
});

gulp.task('sass', function () {
  gulp.src(dirs.src + '/scss/**/*.scss')
    .pipe(sass({ style: 'nested' }).on('error', sass.logError))
    .pipe(plugins.autoprefixer({
      browsers: ['last 2 versions', 'ie 10']
    }))
    .pipe(gulp.dest(dirs.dist + '/css'));
});
 
gulp.task('watch', function () {
  gulp.watch(dirs.src + '/scss/**/*.scss', ['sass']);
  gulp.watch(dirs.src + '/index.html', ['copy:index.html']);
});

gulp.task('lint:js', function () {
    return gulp.src([
        'gulpfile.js',
        dirs.src + '/js/*.js',
        dirs.test + '/*.js'
    ])/* .pipe(plugins.jscs()) */
      .pipe(plugins.jshint())
      .pipe(plugins.jshint.reporter('jshint-stylish'))
      .pipe(plugins.jshint.reporter('fail'));
});

// --------------------
// MAIN TASKS
// --------------------

gulp.task('build', function (done) {
    runSequence(
        ['clean', 'lint:js'],
        'copy',
        'watch',
    done);
});

gulp.task('default', ['build']);