<?php
/**
 * Page inviewer module class.
 *
 * @package WordPress
 * @subpackage ev-inc\modules\inviewer\v1
 * @since 1.0.0
 * @version 1.0.0
 */

/**
 * Page inviewer module class.
 *
 * @since 1.0.0
 */
class EvolveThemes_Module_Inviewer {

	/**
	 * Contstructor.
	 */
	public function __construct() {
		add_action( 'evolvethemes_assets_scripts', array( $this, 'enqueue' ) );
	}

	/**
	 * Enqueue assets on frontend.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {
		/* Main inviewer script. */
		wp_enqueue_script( 'evolvethemes-inviewer', EV_INC_FOLDER_URI . 'modules/inviewer/v1/js/inviewer.min.js', null, '1.0.0', false );
	}

}

( new EvolveThemes_Module_Inviewer() );
