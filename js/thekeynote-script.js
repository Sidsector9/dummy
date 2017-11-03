( function( $ ) {
	var self = {

	};

	self.init = function() {
		self.ready();
	}

	self.ready = function() {
		$( document ).ready( function() {
			ham_menu_cb();
		});
	}

	var ham_menu_cb = function() {
		var ham_menu = $( '.ham-menu' );
		var main_navigation = $( '.main-navigation' );

		ham_menu.on( 'click', function() {
			main_navigation.fadeToggle( 200 );
		});
	}

	return self.init();
})( jQuery );