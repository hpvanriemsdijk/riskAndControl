var elixir = require('laravel-elixir');
var gulp = require('gulp');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less([
    	"app.less",
    	"../bower/fontawesome/less/font-awesome.less"
    ]);
    mix.styles([
        "app.css",
        "../bower/select2/select2.css", 
        "../bower/select2-bootstrap-css/select2-bootstrap.min.css",
        "../bower/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css",
    ]);
    mix.scripts([
	    '../bower/jquery/dist/jquery.js',
	    '../bower/bootstrap/dist/js/bootstrap.js',
	    '../bower/jQuery.dotdotdot/src/js/jquery.dotdotdot.js',
	    '../bower/isotope/dist/isotope.pkgd.js',
	   	'../bower/raphael/raphael.js',
	    '../bower/morris.js/morris.js',
	    '../bower/select2/select2.js',
        '../bower/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
	], 'public/js/vendor.js');

});
