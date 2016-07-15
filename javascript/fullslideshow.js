(function(){
	"use strict";
	$( window ).load(function() {
		// Initialise Slideshow ( function .plumeSlider() )
		// ----------------------------------------------------

		// Slider File:  js/plume-slider.js
		var vH				= $(window).height();

		var sldshow = $('#slideshow');
		sldshow.css('height', vH);

		sldshow.plumeSlider({
			// options
			'width':			'full',				// full or customized width (only number - in pixels)
			'height':			'full',				// full or customized height (only number - in pixels)
			'type':				'fading',			// fading or carousel
			'interval':			 8000,					// the time that each slide remains on the screen
			'transition':		 1000,					// the time of slide transitions
			'autoplay':			 true,					// automatic slide transitions (after 'interval', go to the next)
			'invert':			 false					// show the last slide as the first
		});
		// ----------------------------------------------------
	});
})();