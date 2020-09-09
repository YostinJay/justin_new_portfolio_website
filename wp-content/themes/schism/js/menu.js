(function ($) {
	'use strict';

	/**
	 * Main theme object.
	 */
	var EvolveThemes_SchismMenu = function () {

		var self = this,
			menuTrap = false;

		this.menuPanelSpacing = function() {
			var nav_panel = $( '.schism-nav' ),
				trigger = $( '.schism-h-nav__trigger' );

			if ( ! trigger.length ) {
				return;
			}

			nav_panel.css( 'padding-top', trigger.offset().top + trigger.outerHeight() );
		};

		/**
		 * Menu panel.
		 */
		this.menuPanel = function () {
			var trigger = $( '.schism-h-nav__trigger' );

			if ( ! trigger.length ) {
				return;
			}

			self.menuPanelSpacing();

			trigger.on(
				'click',
				function () {
					menuTrap = !menuTrap;
					$( 'body' ).toggleClass( 'schism-h-nav_open' );

					return false;
				}
			);
		};

		/**
		 * Bind focus on menu items.
		 */
		this.bindMenuItems = function() {
			var items = $('.schism-h-nav__trigger, .schism-nav .menu a');

			$(document).on('blur', '.schism-h-nav__trigger, .schism-nav .menu a', function() {
				if ( this === items.last().get(0) ) {
					if ( menuTrap == true ) {
						items.first().focus();
					}
				}
			} );
		};

		/**
		 * Event binding.
		 */
		this.bind = function () {
			self.menuPanel();
			self.bindMenuItems();
		};

		/**
		 * Initialization.
		 */
		this.init = function () {
			self.bind();

			$( window ).resize( self.menuPanelSpacing );
		};

		this.init();

	};

	( new EvolveThemes_SchismMenu() );

})( jQuery );
