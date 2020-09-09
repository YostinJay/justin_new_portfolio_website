(function ($) {
	'use strict';

	/**
	 * Main theme object.
	 */
	var EvolveThemes_SchismSticky = function () {

		var self = this;

		this.sticky_fix = function() {
			var sticky_parent = $( '.schism-sticky' );

			sticky_parent.each(
				function() {
					var sticky_top = $( this ).find( '.schism-sticky_top' ).first(),
					sticky_bottom = $( this ).find( '.schism-sticky_bottom' ).first();

					sticky_bottom.css( 'margin-top', sticky_top.outerHeight() );
				}
			);
		}

		/**
		 * Sticky check
		 */
		this.sticky = function () {
			if ( $( '.schism-sticky' ).length == 0 ) {
				return;
			}

			window.document.documentElement.addEventListener(
				'evolvethemes-fonts-active',
				function () {
					self.sticky_fix();
				}
			);
		};

		/**
		 * Event binding.
		 */
		this.bind = function () {
			self.sticky();
		};

		/**
		 * Initialization.
		 */
		this.init = function () {
			self.bind();

			$( window ).resize( self.sticky_fix );
		};

		this.init();

	};

	( new EvolveThemes_SchismSticky() );

})( jQuery );
