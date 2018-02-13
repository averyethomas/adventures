'use strict';
var host = '';
var user = '';
var pass = '';
var path = '';

var gulp =      require('gulp'),
    gutil =     require('gulp-util'),
    concat =    require('gulp-concat'),
    pug =      require('gulp-pug'),
    sass =      require('gulp-sass'),
    gmin =      require('gulp-imagemin'),
    ftp =       require('gulp-ftp'),
    watch =     require('gulp-watch'),
    connect =   require('gulp-connect'),
    autoprefixer = require('gulp-autoprefixer');

var folder = 'deploy';
var themeFolder = 'adventure-theme';

//I want to:

//Compile Jade
gulp.task('html', function(){
    return gulp.src('markup/*.pug')
        .pipe(pug({
            pretty: true,
            basedir: __dirname + '/markup/'
        }))
        .pipe(gulp.dest('../' + folder + '/'))
        .pipe(connect.reload());
});
//Compiles Sass
gulp.task('styles', function(){
    return gulp.src('styles/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(gulp.dest('../' + folder))
        .pipe(gulp.dest('../' + themeFolder))
        .pipe(connect.reload());
});

gulp.task('scripts', function(){
    return gulp.src('scripts/**/*.js')
        .pipe(gulp.dest('../' + folder + '/scripts/'))
        .pipe(gulp.dest('../' + themeFolder + '/scripts/'))
        .pipe(connect.reload());
});

gulp.task('images', function(){
    return gulp.src('images/**/*.{jpg,jpeg,png,gif}')
        .pipe(gmin())
        .pipe(gulp.dest('../' + folder + '/images/'))
        .pipe(gulp.dest('../' + themeFolder + '/images/'))
        .pipe(connect.reload());
});

gulp.task('server', function() {
    return connect.server({
        port: 2222,
        livereload: true,
        root: '../' + folder
    });
});

gulp.task('build', function(){
    gulp.run('html');
    gulp.run('styles');
    gulp.run('scripts');
    gulp.run('images');
});

//Minify Images
gulp.task('default', ['server'], function(){
    gulp.watch('markup/**/*.pug', ['html']);
    gulp.watch('styles/*.scss', ['styles']);
    gulp.watch('scripts/*.js', ['scripts']);
    gulp.watch('images/**/*', ['images']);
});

gulp.task('deploy', function(){
    return gulp.src('../' + folder + '/**/*')
        .pipe(ftp({
            host: host,
            user: user,
            pass: pass,
            remotePath: path
        }))
        .pipe(gutil.noop());
});
