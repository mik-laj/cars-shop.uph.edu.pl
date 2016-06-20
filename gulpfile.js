var gulp = require('gulp');
var spawn = require('child_process').spawn;

var $ = require('gulp-load-plugins')();
var yargs = require('yargs');
var bs = require('browser-sync');
var reload = bs.stream;

gulp.task('scss', function () {
    gulp.src('./assets/scss/**/*.scss')
        .pipe($.sass().on('error', $.sass.logError))
        .pipe(reload())
        .pipe(gulp.dest('./public/static/css'))
});

gulp.task('js', function () {
    gulp.src('./assets/js/**/*.js')
        .pipe($.sourcemaps.init())
        .pipe($.babel())
        .pipe($.sourcemaps.write("."))
        .pipe(reload())
        .pipe(gulp.dest('./public/static/js'))
});

gulp.task('browsersync', ['server'], function (){
    bs.init({
        proxy: '127.0.0.1:8015',
        open: 'local'
    });
});

gulp.task('bs', ['browsersync']);

gulp.task('server', function (){
    var child = spawn('php', ['-S', '127.0.0.1:8015', '-t', 'public', 'public/index.php'], {
        detached: false,
        stdio: 'inherit',
        env: process.env
    });
});

gulp.task('watch', function () {
    gulp.watch('./assets/scss/**/*.scss', ['scss']);
    gulp.watch('./assets/js/**/*.js', ['js']);
    gulp.watch('./src/**/*.php', bs.reload);
    gulp.watch('./templates/**/*.php', bs.reload);
});

gulp.task('build', ['js', 'scss']);

gulp.task('default', ['browsersync', 'server', 'build', 'watch'])