(function ($) {
	'use strict';

	/**
	 * Main theme object.
	 */
	var EvolveThemes_Schism = function () {

		var self = this;

		/**
		 * Load fonts.
		 */
		this.load_fonts = function () {
			if (typeof window.FontsLoadr === 'undefined') {
				return;
			}

			if (typeof window.schism.fonts === 'undefined') {
				return;
			}

			if (typeof window.Preloadr !== 'undefined') {
				window.document.documentElement.addEventListener(
					'evolvethemes-fonts-active',
					function () {
						window.Preloadr.complete( 'fonts' );
					}
				);

				window.document.documentElement.addEventListener(
					'evolvethemes-fonts-inactive',
					function () {
						window.Preloadr.complete( 'fonts' );
					}
				);
			}

			window.FontsLoadr.init( window.schism.fonts );
		};

		/**
		 * Correctly size embeds.
		 */
		this.size_embeds = function () {
			$( '.schism-l' ).fitVids();
		};

		/**
		 * Initialize the preloader.
		 */
		this.init_preloader = function () {
			if (typeof window.Preloadr === 'undefined') {
				return;
			}

			if (typeof window.schism.preloader === 'undefined') {
				return;
			}

			window.Preloadr.init( window.schism.preloader );
		};

		/**
		 * Event binding.
		 */
		this.bind = function () {
			/* Initialize the preloader. */
			self.init_preloader();

			/* Load fonts. */
			self.load_fonts();

			/* Size embeds. */
			self.size_embeds();
		};

		/**
		 * Initialization.
		 */
		this.init = function () {
			self.bind();
		};

		this.init();

	};

	(window.schism.controller = new EvolveThemes_Schism());

})( jQuery );
