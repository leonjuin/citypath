const { mix } = require('laravel-mix');
const fs = require('fs-extra');
const imagemin = require('imagemin');
const imageminMozjpeg = require('imagemin-mozjpeg');
const imageminPngquant = require('imagemin-pngquant');
const imageminJpegtran = require('imagemin-jpegtran');
const imageminGifSicle = require('imagemin-gifsicle');

var path = {
	    src: {},
	    build: {},
	    watch: {},
	    clean: ['build/assets', 'build/version_angular', 'build/version_html'],
	    templates: {
	        cleanui: {},
	    },
	    node_modules : 'node_modules/',
	    node_modules_no_package : 'node_modules_no_package/',
	    javascript : 'resources/assets/js'
	};

var imageminPlugins = {
	plugins : [
		imageminMozjpeg(),
		imageminPngquant(),
		imageminGifSicle()
	]
};

//mix.options.processCssUrls = false;
mix.options({
  processCssUrls: false
});

//!= kill all!
fs.remove('public');

//then repopulate
//~= public folder
mix.copy('resources/public', 'public', false);

//~= general assets
mix.copy('resources/assets/fonts', 'public/assets/fonts', false);   
mix.copy('resources/assets/images/', 'public/assets/images', false);
mix.copy('resources/assets/css/', 'public/assets/css', false);
mix.copy('resources/templates', 'public/templates', false);

//~= application js
//1== admin
mix.combine(['resources/assets/js/admin/**/*.js'], 'public/assets/js/admin/app.js');
mix.combine(['resources/assets/js/admin-map/**/*.js'], 'public/assets/js/admin-map/app.js');

//2== user
mix.combine(['resources/assets/js/user/**/*.js'], 'public/assets/js/app.js');
mix.combine(['resources/assets/js/user/app.js'], 'public/assets/js/app.js');

//~= application js == end ==

//~= application css
//1== admin
mix.sass('resources/assets/sass/admin/app.scss', 'public/assets/css/admin/app.css');
//2== user
mix.sass('resources/assets/sass/user/app.scss', 'public/assets/css/app.css');	
mix.combine(['resources/assets/css/user/app.css'], 'public/assets/css/app.css');
//~= application css == end ==

// ~= general vendor css
// 1== admin
// mix.combine([

// ].map(function(p){ 
// 	return path.node_modules + p; 

// }), 'public/assets/css/admin/vendor.css');	 


// //~= cleanui general vendor js
// //1== admin
// let vendorModules = [

// ].map(function(p){ 	
// 	return path.node_modules + p; 
// });

// let withoutNodeModules = [
// 	'jquery-ui/jquery-ui.min.js',
// 	'jquery-detectmobile/detect.js',
// 	'bootstrap-bootbox/bootbox.min.js',
// 	'jquery-field-plugin/jquery.field.min.js'
// ].map(function(p){ 
// 	return path.node_modules_no_package + p; 
// });

// mix.combine(vendorModules.concat(withoutNodeModules), 'public/assets/js/admin/vendor.js');

// mix.combine([

// ].map(function(p){
// 	return path.node_modules + p
// }), 'public/assets/js/vendor.js');


mix.then(function () {
	fs.remove('public/images');
});
