/**
 * File admela-customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */
 
(function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.admela_sitetitle a' ).text( to );
		});
	});
	
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.admela_description' ).text( to );
		});
	});
	
	
 } )( jQuery );