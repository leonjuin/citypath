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
	        lotus:'resources/templates/lotus/assets',
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
mix.copy('resources/templates/lotus/assets/images/', 'public/templates/lotus/assets/images', false);
mix.copy('resources/templates/lotus/assets/fonts/', 'public/templates/lotus/assets/fonts', false);  

//~= application js
//1== admin
mix.combine(['resources/assets/js/admin/**/*.js'], 'public/assets/js/admin/app.js');
mix.combine(['resources/assets/js/admin-map/**/*.js'], 'public/assets/js/admin-map/app.js');

//2== user
mix.combine(['resources/assets/js/user/**/*.js'], 'public/assets/js/app.js');
mix.combine(['resources/assets/js/user/app.js'], 'public/assets/js/app.js');
// mix.combine(['resources/assets/js/user/brian-app.js'], 'public/assets/js/brian-app.js');

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
mix.combine([
	'bootstrap/dist/css/bootstrap.min.css',
	'jscrollpane/style/jquery.jscrollpane.css',
	'sweetalert2/dist/sweetalert2.min.css',
	'ladda/dist/ladda-themeless.min.css',
	'select2/dist/css/select2.min.css',
	'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
	'fullcalendar/dist/fullcalendar.min.css',
	'bootstrap-sweetalert/dist/sweetalert.css',
	'summernote/dist/summernote.css',
	'owl.carousel/dist/assets/owl.carousel.min.css',
	'ion-rangeslider/css/ion.rangeSlider.css',
	'daterangepicker/daterangepicker.css',
	'c3/c3.min.css',
	'chartist/dist/chartist.min.css',
	'nprogress/nprogress.css',
	'jquery-steps/demo/css/jquery.steps.css',
	'bootstrap-select/dist/css/bootstrap-select.min.css',
	'dropify/dist/css/dropify.min.css',
	'bootstrap-datepicker/bootstrap-datepicker.min.css',
	'angular-bootstrap-calendar/dist/css/angular-bootstrap-calendar.min.css'
].map(function(p){ 
	return path.node_modules + p; 

}), 'public/assets/css/admin/vendor.css');	 

//~= lotus template vendor css
//2== user
mix.combine([
 '/lib/font-awesome.min.css',
 '/lib/font-lotusicon.css',
 '/lib/bootstrap.min.css',
 '/lib/owl.carousel.css',
 '/lib/jquery-ui.min.css', 
 '/lib/magnific-popup.css',
 '/lib/settings.css',
 '/lib/bootstrap-select.min.css',
 '/custom.css',
 '/header.css',
 '/helper.css',
 '/responsive.css',
 '/style.css'
].map(function(p){
	return path.templates.lotus + '/css' + p;

}), 'public/templates/lotus/assets/css/user/vendor.css');

//~= cleanui general vendor js
//1== admin
let vendorModules = [
	'angular/angular.min.js',
	'jquery/dist/jquery.min.js', 
	'bootstrap/dist/js/bootstrap.min.js', 

	'jquery-ui/jquery-ui.js', 
	'moment/min/moment.min.js',
	
	'angular-moment/angular-moment.min.js',
	'angular-animate/angular-animate.min.js',
	'angular-sanitize/angular-sanitize.min.js',
	'angular-ui-router/release/angular-ui-router.min.js',
	'angular-cookies/angular-cookies.min.js',
	'angular-route/angular-route.min.js',
	'ng-file-upload/dist/ng-file-upload.all.min.js',
	'ng-file-upload/dist/ng-file-upload.min.js',

	'daterangepicker/daterangepicker.js', 
	'jquery-ui-touch-punch/jquery.ui.touch-punch.min.js', 
    'fastclick/lib/fastclick.js',
    'block-ui/jquery.blockUI.js', 
    'bootstrap-notify/bootstrap-notify.min.js',
    'jquery-slimscroll/jquery.slimscroll.min.js', 
    'jquery-sparkline/jquery.sparkline.min.js', 
    'bootstrap-select/dist/js/bootstrap-select.min.js',
   	'magnify-popup/dist/jquery.magnific-popup.min.js',
   	'icheck/icheck.min.js', 
	'spin.js/spin.min.js',
	'ladda/dist/ladda.min.js',
   	'bootstrap-fileinput/js/fileinput.min.js', 
   	'progressbar.js/dist/progressbar.min.js',
   	'sweetalert2/dist/sweetalert2.min.js',
   	'angular-bootstrap-calendar/dist/js/angular-bootstrap-calendar-tpls.min.js',
   	'bootstrap-datepicker/bootstrap-datepicker.min.js'
].map(function(p){ 	
	return path.node_modules + p; 
});

let withoutNodeModules = [
	'jquery-ui/jquery-ui.min.js',
	'jquery-detectmobile/detect.js',
	'bootstrap-bootbox/bootbox.min.js',
	'jquery-field-plugin/jquery.field.min.js'
	
].map(function(p){ 
	return path.node_modules_no_package + p; 
});

mix.combine(vendorModules.concat(withoutNodeModules), 'public/assets/js/admin/vendor.js');

//~= lotus templates vendor js
//2== user
mix.combine([
	'/lib/jquery-1.11.0.min.js',
	'/lib/jquery-ui.min.js',
	'/lib/bootstrap.min.js',
	'/lib/bootstrap-select.js',
	'/lib/isotope.pkgd.min.js',
	'/lib/jquery.themepunch.tools.min.js',
	'/lib/jquery.themepunch.revolution.min.js',
	'/lib/owl.carousel.js',
	'/lib/jquery.appear.min.js',
	'/lib/jquery.countTo.js',
	'/lib/jquery.countdown.min.js',
	'/lib/jquery.parallax-1.1.3.js',
	'/lib/jquery.magnific-popup.min.js',
	'/lib/SmoothScroll.js',
	'/lib/jquery.form.min.js',
	'/lib/jquery.validate.min.js',
	'/min/scripts.min.js',
].map(function(p){ 
	return path.templates.lotus+ '/js' + p; 
}), 'public/templates/lotus/assets/js/user/vendor.js');	 

mix.combine([
	'jquery/dist/jquery.min.js', 
	'moment/min/moment.min.js'
].map(function(p){
	return path.node_modules + p
}), 'public/assets/js/vendor.js');


mix.then(function () {
	fs.remove('public/images');
});
