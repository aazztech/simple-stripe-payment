const { src, dest, series, watch } = require('gulp');
const browserify = require('browserify');
const babelify = require('babelify');
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');

let jsFolder = 'assets/js/src/';
let jsWatch = 'assets/js/src/*.js';
let jsSrc = 'new-app.js';
let jsDst = './assets/js/dist/';
let jsFiles = [jsSrc];

const js = function(cb) {
  jsFiles.map( function( entry ) {
    return browserify({
      entries: [jsFolder + entry]
    })
    .transform(babelify, {presets: ["@babel/preset-env"]})
    .bundle()
    .pipe( source( entry ) )
    .pipe( buffer() )
    .pipe( dest(jsDst) );
  });

  cb()
};


// watchFiles
const watchFiles = function (cb) {
  return watch(jsWatch, js);
}


// defaultTask
const defaultTask = function (cb) {
  console.log('Gulp is running');
  cb();
}

exports.default = watchFiles;

