/* Author:

*/


var EMBARK = EMBARK || {};

$(function(){
	EMBARK.modernizr();
	EMBARK.init();
	
});


EMBARK.modernizr = function() {
    //load scripts for <= IE8 - :nth-child
    Modernizr.load({
        test: Modernizr.borderradius,
        nope: ['js/libs/selectivizr-min.js']
    });
    Modernizr.load({
        test: Modernizr.input.placeholder,
        nope: ['js/libs/placeholder.min.js']
    });
};



EMBARK.init = function() {

};


//run a test where possible for the script to only run on pages where it's required
EMBARK.item = function() {
	$item = $('.doSomething');
	if (!$item.length) return;

};







