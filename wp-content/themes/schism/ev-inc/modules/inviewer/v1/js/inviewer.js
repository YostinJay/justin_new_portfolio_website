( function( window, factory ) {
	if ( typeof module === 'object' && module.exports ) {
		module.exports.Inviewr = factory();
	}
	else {
		window.Inviewr = factory();
		window.Inviewr.init();
	}
} )( typeof window !== 'undefined' ? window : this, function() {
	'use strict';

	var self = {};

	/**
	 * Selectors.
	 */
	self.selectors = [];

	/**
	 * Elements to keep track of.
	 */
	self.elements = [];

	/**
	 * Intersection observer.
	 */
	self.observer = null;

	/**
	 * Mode.
	 */
	self.mode = '';

	/**
	 * Register.
	 */
	self.register = function( selector, options ) {
		self.selectors.push( {
			selector: selector,
			options: options
		} );

		self.refresh();
	};

	/**
	 * Fetch elements.
	 */
	self.fetch = function() {
		self.selectors.forEach( function( data ) {
			document.querySelectorAll( data.selector ).forEach( function( _element ) {
				if ( _element.evolvethemes_inviewr_options ) {
					return;
				}

				_element.evolvethemes_inviewr_options = JSON.stringify( data.options );

				if ( 'compat' !== self.mode ) {
					self.observer.observe( _element );
				}
				else {
					self.elements.push( _element );
				}
			} );
		} );
	};

	/**
	 * Check for in-view elements.
	 */
	self.check = function() {
		self.elements.forEach( function( element, index, object ) {
			var options = JSON.parse( element.evolvethemes_inviewr_options );

			if ( ( element.getBoundingClientRect().top <= window.innerHeight && 0 <= element.getBoundingClientRect().bottom ) && 'none' !== getComputedStyle( element ).display ) {
				self.inview( element, options );

				if ( ! options.toggle ) {
					object.splice( index, 1 );
				}
			}
			else {
				self.notInview( element, options );
			}
		} );

		if ( 0 === self.elements.length ) {
			self.unbind();
		}
	};

	/**
	 * Refresh.
	 */
	self.refresh = function() {
		self.fetch();

		if ( 'compat' === self.mode ) {
			self.bind();
			self.check();
		}
	};

	/**
	 * Event binding for compat mode.
	 */
	self.bind = function() {
		if ( 0 === self.elements.length ) {
			return;
		}

		document.addEventListener( 'scroll', self.check );
		window.addEventListener( 'resize', self.check );
		window.addEventListener( 'orientationchange', self.check );
	};

	/**
	 * Event unbinding for compat mode.
	 */
	self.unbind = function() {
		document.removeEventListener( 'scroll', self.check );
		window.removeEventListener( 'resize', self.check );
		window.removeEventListener( 'orientationchange', self.check );
	};

	/**
	 * Custom events polyfill for browser that do not support them.
	 */
	self.customEventPolyfill = function() {
		if ( typeof window.CustomEvent === 'function' ) {
			return;
		}

		function CustomEvent( event, params ) {
			params = params || { bubbles: false, cancelable: false, detail: undefined };
			var evt = document.createEvent( 'CustomEvent' );
			evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
			return evt;
		}

		CustomEvent.prototype = window.Event.prototype;

		window.CustomEvent = CustomEvent;
	};

	/**
	 * Emit an event.
	 */
	self.emit = function( element, name ) {
		var event = new CustomEvent( name );

		element.dispatchEvent( event );
	};

	/**
	 * Operations performed when an element comes into view.
	 */
	self.inview = function( element ) {
		element.classList.add( 'evolvethemes-inviewr' );

		self.emit( element, 'evolvethemes-inview' );
	};

	/**
	 * Operations performed when an element comes out of view.
	 */
	self.notInview = function( element, options ) {
		if ( options.toggle ) {
			element.classList.remove( 'evolvethemes-inviewr' );
		}

		self.emit( element, 'evolvethemes-not-inview' );
	};

	/**
	 * Initialization & event binding.
	 */
	self.init = function() {
		self.customEventPolyfill();

		if ( 'IntersectionObserver' in window ) {
			self.observer = new IntersectionObserver( function( items ) { // jshint ignore:line
				items.forEach( function( item ) {
					var options = JSON.parse( item.target.evolvethemes_inviewr_options );

					if ( item.intersectionRatio > 0 ) {
						self.inview( item.target, options );

						if ( ! options.toggle ) {
							self.observer.unobserve( item.target );
						}
					}
					else {
						self.notInview( item.target, options );
					}
				} );
			} );
		}
		else {
			self.mode = 'compat';
		}

		document.addEventListener( 'DOMContentLoaded', self.refresh );
	};

	return self;

} );
