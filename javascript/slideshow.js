(function(){
	"use strict";

	// Slider File:  js/plume-slider.js
	var sldshow = $('#slideshow');
	sldshow.css('height', '700');

	$( window ).load(function() {
		// Initialise Slideshow ( function .plumeSlider() )
		// ----------------------------------------------------
		sldshow.plumeSlider({
			// options
			'width':			'full',				// full or customized width (only number - in pixels)
			'height':			'700',				// full or customized height (only number - in pixels)
			'type':				'fading',			// fading or carousel
			'interval':			 8000,					// the time that each slide remains on the screen
			'transition':		 1000,					// the time of slide transitions
			'autoplay':			 true,					// automatic slide transitions (after 'interval', go to the next)
			'invert':			 false					// show the last slide as the first
		});
		// ----------------------------------------------------
	});
})();