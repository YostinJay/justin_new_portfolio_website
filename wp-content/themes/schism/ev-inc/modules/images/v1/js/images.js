/**
 * Images loader.
 *
 * This library is entitled to lazy load images in the page.
 *
 * @package ev-inc\modules\images\v1
 */

( function( window, factory ) {
	if ( typeof module === 'object' && module.exports ) {
		module.exports.ImgLoadr = factory();
	} else {
		window.ImgLoadr = factory();
	}
} )(
	typeof window !== 'undefined' ? window : this,
	function() {
		'use strict';

		var self = {};

		/**
		 * Global canvas object.
		 */
		self.canvas = null;

		/**
		 * Global canvas context.
		 */
		self.ctx = null;

		/**
		 * Image sizes.
		 */
		self.sizes = {};

		/**
		 * CSS selector to identify images that need to be loaded.
		 */
		self.selector = 'img.evolvethemes-preloaded-image';

		/**
		 * Properly size image placeholders.
		 */
		self.size = function() {
			var images = document.querySelectorAll( self.selector );

			images.forEach(
				function( img ) {
					if ( 'IMG' !== img.tagName ) {
						return;
					}

					var i_width = img.getAttribute( 'width' ),
					i_height    = img.getAttribute( 'height' );

					if ( ! i_width ) {
						i_width = 300;
					}

					if ( ! i_height ) {
						i_height = 300;
					}

					if ( null === self.canvas ) {
						self.canvas = document.createElement( 'canvas' );
						self.ctx    = self.canvas.getContext( '2d' );
					}

					var size_key = i_width + 'x' + i_height;

					if ( typeof self.sizes[ size_key ] === 'undefined' ) {
						self.canvas.width  = parseInt( i_width, 10 );
						self.canvas.height = parseInt( i_height, 10 );

						self.ctx.rect( 0, 0, self.canvas.width, self.canvas.height );

						self.sizes[ size_key ] = self.canvas.toDataURL( 'image/jpeg', 0 );
					}

					if ( img.dataset.srcset ) {
						img.srcset = self.sizes[ size_key ];
					} else if ( img.dataset.src ) {
						img.src = self.sizes[ size_key ];
					}

				}
			);
		};

		/**
		 * Load an image through the src attribute.
		 */
		self.loadSrc = function( img ) {
			var _temp_img = new Image();

			if ( 'FIGURE' === img.parentElement.tagName ) {
				img.parentElement.classList.add( 'evolvethemes-image-loading' );
			}

			var _onLoadSrc = function() {
				img.src = img.dataset.src;

				img.removeAttribute( 'data-src' );

				if ( 'FIGURE' === img.parentElement.tagName ) {
					img.parentElement.classList.remove( 'evolvethemes-image-loading' );
					img.parentElement.classList.add( 'evolvethemes-image-loaded' );
				}

				_temp_img.removeEventListener( 'load', _onLoadSrc );
			};

			var _onErrorSrc = function() {
				if ( 'FIGURE' === img.parentElement.tagName ) {
					img.parentElement.classList.remove( 'evolvethemes-image-loading' );
					img.parentElement.classList.add( 'evolvethemes-image-error' );
				}

				_temp_img.removeEventListener( 'error', _onErrorSrc );
			};

			_temp_img.addEventListener( 'load', _onLoadSrc );
			_temp_img.addEventListener( 'error', _onErrorSrc );

			_temp_img.src = img.dataset.src;
		};

		/**
		 * Load an image through the srcset attribute.
		 */
		self.loadSrcset = function( img ) {
			var _temp_img = new Image();

			if ( 'FIGURE' === img.parentElement.tagName ) {
				img.parentElement.classList.add( 'evolvethemes-image-loading' );
			}

			var _onLoadSrcset = function() {
				img.srcset = img.dataset.srcset;

				img.removeAttribute( 'data-srcset' );

				if ( 'FIGURE' === img.parentElement.tagName ) {
					img.parentElement.classList.remove( 'evolvethemes-image-loading' );
					img.parentElement.classList.add( 'evolvethemes-image-loaded' );
				}

				_temp_img.removeEventListener( 'load', _onLoadSrcset );
			};

			var _onErrorSrcset = function() {
				if ( 'FIGURE' === img.parentElement.tagName ) {
					img.parentElement.classList.remove( 'evolvethemes-image-loading' );
					img.parentElement.classList.add( 'evolvethemes-image-error' );
				}

				_temp_img.removeEventListener( 'error', _onErrorSrcset );
			};

			_temp_img.addEventListener( 'load', _onLoadSrcset );
			_temp_img.addEventListener( 'error', _onErrorSrcset );

			_temp_img.srcset = img.dataset.srcset;
		};

		/**
		 * Load an image and apply it as background.
		 */
		self.loadBackground = function( el ) {
			var _temp_img = new Image();

			el.classList.add( 'evolvethemes-bg-loading' );

			var _onLoadBackground = function() {
				el.style[ 'background-image' ] = 'url(' + el.dataset.bg + ')';

				el.removeAttribute( 'data-bg' );
				el.classList.remove( 'evolvethemes-bg-loading' );
				el.classList.add( 'evolvethemes-bg-loaded' );

				_temp_img.removeEventListener( 'load', _onLoadBackground );
			};

			var _onErrorBackground = function() {
				el.classList.remove( 'evolvethemes-bg-loading' );
				el.classList.add( 'evolvethemes-bg-error' );

				_temp_img.removeEventListener( 'error', _onErrorBackground );
			};

			_temp_img.addEventListener( 'load', _onLoadBackground );
			_temp_img.addEventListener( 'error', _onErrorBackground );

			_temp_img.src = el.dataset.bg;
		};

		/**
		 * Load a single image.
		 */
		self.loadSingle = function( img ) {
			var mode = null;

			if ( img.dataset.srcset ) {
				mode = 'srcset';
			} else if ( img.dataset.src ) {
				mode = 'src';
			} else if ( img.dataset.bg ) {
				mode = 'background';
			}

			switch ( mode ) {
				case 'srcset':
					self.loadSrcset( img );
					break;
				case 'background':
					self.loadBackground( img );
					break;
				case 'src':
					self.loadSrc( img );
					break;
			}
		};

		/**
		 * Load images.
		 */
		self.load = function() {
			var images = document.querySelectorAll( self.selector );

			images.forEach(
				function( img ) {
					self.loadSingle( img );
				}
			);
		};

		return self;

	}
);
