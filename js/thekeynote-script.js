( function( $ ) {
	var self = {

	};

	self.init = function() {
		self.ready();
	}

	self.ready = function() {
		$( document ).ready( function() {
			ham_menu_cb();
			banner_slider();
		});
	}

	var ham_menu_cb = function() {
		var ham_menu = $( '.ham-menu' );
		var main_navigation = $( '.main-navigation' );

		ham_menu.on( 'click', function() {
			main_navigation.fadeToggle( 200 );
		});
	}

	var banner_slider = function() {
		$( '.banner-slider' ).slick({
			autoplay: true,
			autoplaySpeed: 1000,
			pauseOnHover: false,
			adaptiveHeight: true,
			dots: false,
			infinite: true,
			speed: 500,
			fade: true,
			cssEase: 'linear'
		});		
	}

	return self.init();
})( jQuery );