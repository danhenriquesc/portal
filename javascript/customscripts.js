/*
* Scripts JS
* Copyright 2014, Ararazu
* www.ararazu.com
*/

/* Scripts to initialize Plume Slider
================================================== */

	(function(){
		"use strict";
		
		// Mobile Menu
		var body			= $('body');
		var mainMenu		= $('#mainmenu');
		var mainMenuList	= mainMenu.find('#menu-list');
		var btMobileMenu	= $('#bt-menu-mobile');
		var scrolledTop		= $(window).scrollTop();
		var menuLevel1		= false;
		var menuLevel2		= false;
		
		// Click on Mobile Nav Icon
		var MobileNavClosed = '1';
		btMobileMenu.on('click', function() {
			if (MobileNavClosed == '1') {
				mainMenu.addClass('mobile');
				MobileNavClosed = '0';
			} else {
				mainMenu.removeClass('mobile');
				MobileNavClosed = '1';
				mainMenu.find('ul.lvl-1, ul.lvl-1 ul').hide();
			}
		});

		$('.menu a').on('click', function(){
			if ( $(window).width() < 768 ) {
				if (menuLevel1===false) {
					$(this).parent().find('ul.lvl-1').slideDown('fast');
					menuLevel1 = true;
				} else {
					if ( $(this).parent().parent().hasClass('lvl-1') ) {
						if (menuLevel2===false) {
							$(this).parent().find('ul.lvl-2').slideDown('fast');
							menuLevel2  = true;
						} else {
							$(this).parent().find('ul.lvl-2').slideUp('fast');
							menuLevel2  = false;
						}
					} else {
						$(this).parent().find('ul.lvl-1').slideUp('fast');
						menuLevel1 = false;
						menuLevel2 = false;
					}
				}
				return false;
			}
		});
	
		var transitionTime	= 1200;
		var vW							= $(window).width();
		var vH							= $(window).height();	
		
		// <a href="#"... click return false
		$('.control a[href="#"]').on('click', function() { return false; });

		// Owl Carousel
		var owl = $("#owl-carousel");
		owl.owlCarousel({
			items: 4,
			itemsDesktop : [1000,4], 
			itemsDesktopSmall : [960,3], 
			itemsTablet: [750,1], 
			itemsMobile : false,
			pagination: false,
			stopOnHover: true,
			autoPlay: false,
			mouseDrag: false
		});
		
		// Owl - Custom Navigation Events
		$(".owl-next").click(function(){ owl.trigger('owl.next'); })
		$(".owl-prev").click(function(){ owl.trigger('owl.prev'); })
		$(".owl-play").click(function(){ owl.trigger('owl.play',1000); }) //owl.play event accept autoPlay speed as second parameter
		$(".owl-stop").click(function(){ owl.trigger('owl.stop'); })

		$( window ).resize(function() {
			var winWidth		= $(window).width();
			if ( winWidth >= 767 ) {
				mainMenu.find('ul.lvl-1, ul.lvl-1 ul').show();
			} else {
				mainMenu.find('ul.lvl-1, ul.lvl-1 ul').hide();
				menuLevel1 = false;
				menuLevel2 = false;

				mainMenu.removeClass('mobile');
				MobileNavClosed = '1';
				mainMenu.find('ul.lvl-1, ul.lvl-1 ul').hide();
			}
		});

	})();