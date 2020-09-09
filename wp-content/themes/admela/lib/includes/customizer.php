<?php
/**
 * Admela: Customizer
 *
 * @package WordPress
 * @subpackage Admela
 * @since 1.0
 */

/**
 * Add refresh support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
 
if(! function_exists( 'admela_customize_register' )):
 
function admela_customize_register( $wp_customize ) {
	
	
	$wp_customize->get_setting( 'blogname' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	$wp_customize->selective_refresh->add_partial(
		'blogname', array(
			'selector'        => '.admela_sitetitle a',
			'render_callback' => 'admela_customize_partial_blogname',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'blogdescription', array(
			'selector'        => '.admela_description',
			'render_callback' => 'admela_customize_partial_blogdescription',
		)
	);
	
	
	/**
	* Add panel,section,setting,control for the theme options.
	*/
	
	$wp_customize->add_panel('admela_panel_id',array(
		'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'title' => esc_html__( 'Admela Settings', 'admela' ),
	    'description' => esc_html__( 'This panel allows you to set up our theme settings.', 'admela' ),
	));

	$wp_customize->add_section('admela_header_social_network_section',array(
		'title' => esc_html__('Header Social Network','admela'),
		'priority' => 10,
		'panel' => 'admela_panel_id'
	));

	$wp_customize->add_setting('admela_header_social_fb_setting',array(
        'capability' => 'edit_theme_options',
		'transport' => 'refresh',
        'sanitize_callback' => 'admela_sanitize_url',
	));

	$wp_customize->add_control('admela_header_social_fb_control',array(
        'type' => 'url',
		'section' => 'admela_header_social_network_section', 
		'label' => esc_html__('Enter your facebook social follow url ','admela'),
		'settings' => 'admela_header_social_fb_setting',
		'description' => esc_html__('Here, you can change your header facebook social url','admela'),
	));
	
	
	$wp_customize->add_setting('admela_header_social_twitter_setting',array(
        'capability' => 'edit_theme_options',
		'transport' => 'refresh',
        'sanitize_callback' => 'admela_sanitize_url',
	));
	
	$wp_customize->add_control('admela_header_social_twitter_control',array(
        'type' => 'url',
		'section' => 'admela_header_social_network_section', 
		'label' => esc_html__('Enter your twitter social follow url ','admela'),
		'settings' => 'admela_header_social_twitter_setting',
		'description' => esc_html__('Here, you can change your header twitter social url','admela'),
	));
	
	$wp_customize->add_setting('admela_header_social_gplus_setting',array(
        'capability' => 'edit_theme_options',		
		'transport' => 'refresh',
        'sanitize_callback' => 'admela_sanitize_url',
	));
	
	$wp_customize->add_control('admela_header_social_gplus_control',array(
        'type' => 'url',
		'section' => 'admela_header_social_network_section', 
		'label' => esc_html__('Enter your Googleplus social follow url ','admela'),
		'settings' => 'admela_header_social_gplus_setting',
		'description' => esc_html__('Here, you can change your header Googleplus social url','admela'),
	));
	
	$wp_customize->add_setting('admela_header_social_instagram_setting',array(
        'capability' => 'edit_theme_options',
		'transport' => 'refresh',
        'sanitize_callback' => 'admela_sanitize_url',
	));
	
	$wp_customize->add_control('admela_header_social_instagram_control',array(
        'type' => 'url',
		'section' => 'admela_header_social_network_section', 
		'label' => esc_html__('Enter your instagram social follow url ','admela'),
		'settings' => 'admela_header_social_instagram_setting',
		'description' => esc_html__('Here, you can change your header instagram social url','admela'),
	));
	
		
	// Slider Section,Setting,Control
	
	$admela_args = array(
		'orderby' => 'name',
		'order' => 'ASC'
	);
  
	$admela_getcats = get_categories($admela_args);
	
	$admela_cats = array();
	$i = 0;
	
	foreach($admela_getcats as $admela_cat) {
		
		if( $i == 0 ){
			$admela_catdefault = $admela_cat->term_id;
			$i++;
		}
		
		$admela_cats[$admela_cat->term_id] = $admela_cat->slug;
	}
		
	// After Header Ad Section,Setting,Control
	
	$wp_customize->add_section('admela_after_header_ad_section',array(
		'title' => esc_html__('After Header Ad Code','admela'),
		'priority' => 11,
		'panel' => 'admela_panel_id'
	));

	$wp_customize->add_setting('admela_after_header_ad_setting',array(
        'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
        'sanitize_callback' => 'admela_sanitize_textarea',
	));

	$wp_customize->add_control('admela_after_header_ad_control',array(
        'type' => 'textarea',
		'section' => 'admela_after_header_ad_section', 
		'label' => esc_html__('Paste your Ad  Code','admela'),
		'settings' => 'admela_after_header_ad_setting',
		'description' => esc_html__('Here, you can also add your after header ad code with shorcode format','admela'),
	));
	
  	
	$wp_customize->add_section('admela_slider_category_section',array(
		'title' => esc_html__('Home Page Slider','admela'),
		'priority' => 12,
		'panel' => 'admela_panel_id'
	));

	$wp_customize->add_setting('admela_slider_category_setting',array(
        'capability' => 'edit_theme_options',		
		'transport' => 'refresh', 
        'default' => 1,		
        'sanitize_callback' => 'absint'		
	));

	$wp_customize->add_control('admela_slider_category_control',array(
        'type' => 'select',		
		'section' => 'admela_slider_category_section', 
		'label' => esc_html__('Choose category name','admela'),
		'settings' => 'admela_slider_category_setting',
		'description' => esc_html__('Here, you can select the category name to display those posts in slider','admela'),
	    'choices'  => $admela_cats
	));
	
	$wp_customize->add_setting('admela_slider_post_order_setting',array(
        'capability' => 'edit_theme_options',		
		'transport' => 'refresh',
		'default' => 'latest',
        'sanitize_callback' => 'admela_sanitize_select'        
	));

	$wp_customize->add_control('admela_slider_post_order_control',array(
        'type' => 'select',		
		'section' => 'admela_slider_category_section', 
		'label' => esc_html__('Choose slider post order by','admela'),
		'settings' => 'admela_slider_post_order_setting',
		'description' => esc_html__('Here, you can select the slider post order by latest or random','admela'),
	    'choices' => array(
		 'latest' => esc_html__('Latest','admela'),
		 'random' => esc_html__('Random','admela')	 
		)
	));
		
	$wp_customize->add_setting('admela_slider_post_perpage_setting',array(
        'capability' => 'edit_theme_options',
		'default'    => '10',
		'transport' => 'refresh', 
        'sanitize_callback' => 'absint', // The hue is stored as a positive integer.		
	));

	$wp_customize->add_control('admela_slider_post_perpage_control',array(
        'type' => 'text',		
		'section' => 'admela_slider_category_section', 
		'label' => esc_html__('Enter the posts count to display in slider','admela'),
		'settings' => 'admela_slider_post_perpage_setting',
		'description' => esc_html__('Here, you can change the slider posts count to display in slider','admela'),
	    
	));
	
	// Home page category post section,settings,control
	
	$wp_customize->add_section('admela_home_category_post_section',array(
		'title' => esc_html__('Home Category Post Section','admela'),
		'priority' => 13,
		'panel' => 'admela_panel_id'
	));

	$wp_customize->add_setting('admela_home_category_post_setting',array(
        'capability' => 'edit_theme_options',		
		'transport' => 'refresh',  
		'default' => '1',
        'sanitize_callback' => 'absint'		
	));
		

	$wp_customize->add_control('admela_home_category_post_control',array(
        'type' => 'select',
		'section' => 'admela_home_category_post_section', 
		'label' => esc_html__('Choose Category','admela'),
		'settings' => 'admela_home_category_post_setting',
		'description' => esc_html__('Here, you can choose the category to display those posts in home category post section','admela'),
	    'choices'  => $admela_cats
	));
	
	
	$wp_customize->add_setting('admela_home_category_post_subtitle_setting',array(
        'capability' => 'edit_theme_options',
		'default'    => esc_html__('Here, you can add your category related description','admela'),
		'transport' => 'refresh',
        'sanitize_callback' => 'admela_sanitize_textarea',
	));

	$wp_customize->add_control('home_category_post_subtitle_control',array(
        'type' => 'textarea',
		'section' => 'admela_home_category_post_section', 
		'label' => esc_html__('Change your home category post subtitle text','admela'),
		'settings' => 'admela_home_category_post_subtitle_setting',
		'description' => esc_html__('Here, you can change your home category post subtitle text','admela'),
	));
	
	$wp_customize->add_setting('admela_home_category_post_order_setting',array(
        'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'default' => 'latest',		
        'sanitize_callback' => 'admela_sanitize_select'		
	));
	
	$wp_customize->add_control('admela_home_category_post_order_control',array(
        'type' => 'select',		
		'section' => 'admela_home_category_post_section', 
		'label' => esc_html__('Choose home category post order by','admela'),
		'settings' => 'admela_home_category_post_order_setting',
		'description' => esc_html__('Here, you can select the home category post order by latest or random','admela'),
	    'choices' => array(
		 'latest' => esc_html__('Latest','admela'),
		 'random' => esc_html__('Random','admela')		 
		)
	));
		
	// After Category Section Ad section,setting,control
	
	$wp_customize->add_section('admela_after_home_category_post_ad_section',array(
		'title' => esc_html__('Home After Category Post Section Ad','admela'),
		'priority' => 14,
		'panel' => 'admela_panel_id'
	));
	
	$wp_customize->add_setting('admela_after_home_category_post_ad_setting',array(
        'capability' => 'edit_theme_options',		
		'transport' => 'refresh',
        'sanitize_callback' => 'admela_sanitize_textarea',
	));

	$wp_customize->add_control('admela_after_home_category_post_ad_control',array(
        'type' => 'textarea',
		'section' => 'admela_after_home_category_post_ad_section', 
		'label' => esc_html__('Paste your after category post section Ad  Code','admela'),
		'settings' => 'admela_after_home_category_post_ad_setting',
		'description' => esc_html__('Here, you can also add your after category post section code with shorcode format','admela'),
	));
	
	
	// Latest post section,setting,control
	
	$wp_customize->add_section('admela_latest_post_section',array(
		'title' => esc_html__('Latest Post Section','admela'),
		'priority' => 15,
		'panel' => 'admela_panel_id'
	));
	
	$wp_customize->add_setting('admela_latest_post_title_setting',array(
        'capability' => 'edit_theme_options',
		'default'    => esc_html__('Latest Stories...!','admela'),
		'transport' => 'refresh',
        'sanitize_callback' => 'admela_sanitize_text',
	));

	$wp_customize->add_control('admela_latest_post_title_control',array(
        'type' => 'text',
		'section' => 'admela_latest_post_section', 
		'label' => esc_html__('Change your latest post title text','admela'),
		'settings' => 'admela_latest_post_title_setting',
		'description' => esc_html__('Here, you can change your latest post title text','admela'),
	));
	
	$wp_customize->add_setting('admela_latest_post_subtitle_setting',array(
        'capability' => 'edit_theme_options',
		'default'    => esc_html__('Here, you can see your latest published articles','admela'),
		'transport' => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
	));

	$wp_customize->add_control('admela_latest_post_subtitle_control',array(
        'type' => 'textarea',
		'section' => 'admela_latest_post_section', 
		'label' => esc_html__('Change your latest post sub title text','admela'),
		'settings' => 'admela_latest_post_subtitle_setting',
		'description' => esc_html__('Here, you can change your latest post sub title text','admela'),
	));
	
	// After LatestPost Section Ad section,setting,control
	
	$wp_customize->add_section('admela_after_home_latestpost_ad_section',array(
		'title' => esc_html__('Home After Latestpost Post Section Ad','admela'),
		'priority' => 16,
		'panel' => 'admela_panel_id'
	));
	
	$wp_customize->add_setting('admela_after_home_latestpost_ad_setting',array(
        'capability' => 'edit_theme_options',		
		'transport' => 'refresh',
        'sanitize_callback' => 'admela_sanitize_textarea',
	));

	$wp_customize->add_control('admela_after_home_latestpost_ad_control',array(
        'type' => 'textarea',
		'section' => 'admela_after_home_latestpost_ad_section', 
		'label' => esc_html__('Paste your after latest post section Ad  Code','admela'),
		'settings' => 'admela_after_home_latestpost_ad_setting',
		'description' => esc_html__('Here, you can also add your after latest post section code with shorcode format','admela'),
	));
	
	$wp_customize->add_setting('admela_single_post_top_ad_setting',array(
        'capability' => 'edit_theme_options',		
		'transport' => 'refresh',
        'sanitize_callback' => 'admela_sanitize_textarea',
	));

	$wp_customize->add_control('admela_single_post_top_ad_control',array(
        'type' => 'textarea',
		'section' => 'admela_single_post_section', 
		'label' => esc_html__('Paste your single post content top Ad  Code','admela'),
		'settings' => 'admela_single_post_top_ad_setting',
		'description' => esc_html__('Here, you can also add your single post content top ad code with shorcode format','admela'),
	));
	
	$wp_customize->add_setting('admela_single_post_top_ad_alignment_setting',array(
        'capability' => 'edit_theme_options',
		'default'    => 'none',
		'transport' => 'refresh',  
        'sanitize_callback' => 'admela_sanitize_select'		
	));

	$wp_customize->add_control('admela_single_post_top_ad_alignment_control',array(
        'type' => 'select',
		'section' => 'admela_single_post_section', 
		'label' => esc_html__('Choose your single post content top ad alignment','admela'),
		'settings' => 'admela_single_post_top_ad_alignment_setting',
		'description' => esc_html__('Here, you can also add your single post content top ad alignment','admela'),
	    'choices' => array(
		 'none' => esc_html__('None','admela'),
		 'left' => esc_html__('Left','admela'),
		 'right' => esc_html__('Right','admela')
		)
	));
	
	
	$wp_customize->add_setting('admela_single_post_bottom_ad_setting',array(
        'capability' => 'edit_theme_options',		
		'transport' => 'refresh',
        'sanitize_callback' => 'admela_sanitize_textarea',
	));

	$wp_customize->add_control('admela_single_post_bottom_ad_control',array(
        'type' => 'textarea',
		'section' => 'admela_single_post_section', 
		'label' => esc_html__('Paste your single post content bottom Ad Code','admela'),
		'settings' => 'admela_single_post_bottom_ad_setting',
		'description' => esc_html__('Here, you can also add your single post content bottom ad code with shorcode format','admela'),
	));
	
	// Single post section, socialshare setting, socialshare control
	
	$wp_customize->add_section('admela_single_post_section',array(
		'title' => esc_html__('Single Post Section','admela'),
		'priority' => 17,
		'panel' => 'admela_panel_id'
	));
	
	$wp_customize->add_setting('admela_single_post_socialshare_setting',array(
        'capability' => 'edit_theme_options',
		'default'    => false,
		'transport' => 'refresh',
        'sanitize_callback' => 'admela_sanitize_checkbox',
	));

	$wp_customize->add_control('admela_single_post_socialshare_control',array(
        'type' => 'checkbox',
		'section' => 'admela_single_post_section', 
		'label' => esc_html__('Enable the single post social share','admela'),
		'settings' => 'admela_single_post_socialshare_setting',
		'description' => esc_html__('Here, you can enable/disable social share ','admela'),
	));
	
	// Single relatedpost setting, relatedpost control
		
	$wp_customize->add_setting('admela_single_post_relatedpost_type_setting',array(
        'capability' => 'edit_theme_options',
		'default'    => 'category',
		'transport' => 'refresh',
        'sanitize_callback' => 'admela_sanitize_relatedposttype',
	));

	$wp_customize->add_control('admela_single_post_relatedpost_control',array(
        'type' => 'radio',
		'section' => 'admela_single_post_section', 
		'label' => esc_html__('Choose the single post related post order by category (or) tag wise','admela'),
		'settings' => 'admela_single_post_relatedpost_type_setting',
		'description' => esc_html__('Here, you can choose single post related post order by category (or) tag wise','admela'),
	    'choices' => array(
		 'category' => esc_html__('Category','admela'),
		 'tag' => esc_html__('Tag','admela')
		),
	));
	
	
	$wp_customize->add_setting('admela_single_post_relatedpost_order_setting',array(
        'capability' => 'edit_theme_options',
		'default'    => 'latest',
		'transport' => 'refresh',
        'sanitize_callback' => 'admela_sanitize_relatedpostorder',
	));

	$wp_customize->add_control('admela_single_post_relatedpost_order_control',array(
        'type' => 'radio',
		'section' => 'admela_single_post_section', 
		'label' => esc_html__('Choose the single post related post order by latest (or) random wise','admela'),
		'settings' => 'admela_single_post_relatedpost_order_setting',
		'description' => esc_html__('Here, you can choose single post related post order by latest (or) random wise','admela'),
	    'choices' => array(
		 'latest' => esc_html__('Latest','admela'),
		 'random' => esc_html__('Random','admela')
		),
	));	
	
	
	
	// Footer About us text section, setting, control
	
	$wp_customize->add_section('admela_footer_section',array(
		'title' => esc_html__('Footer Section','admela'),
		'priority' => 18,
		'panel' => 'admela_panel_id'
	));
	
	$wp_customize->add_setting('admela_footer_aboutus_text_setting',array(
        'capability' => 'edit_theme_options',
		'default' => esc_html__('Write some short description about your site','admela'),
		'transport' => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
	));

	$wp_customize->add_control('admela_footer_aboutus_text_control',array(
        'type' => 'textarea',
		'section' => 'admela_footer_section', 
		'label' => esc_html__('Change your about us text','admela'),
		'settings' => 'admela_footer_aboutus_text_setting',
		'description' => esc_html__('Here, you can also change your about us text','admela'),
	));
	
	$wp_customize->add_setting('admela_footer_copyrights_setting',array(
        'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'default' => esc_html__('Admela Theme All Rights Reserved','admela'),
        'sanitize_callback' => 'wp_filter_nohtml_kses',
	));

	$wp_customize->add_control('admela_footer_copyrights_control',array(
        'type' => 'textarea',
		'section' => 'admela_footer_section', 
		'label' => esc_html__('Change your footer copy rights text','admela'),
		'settings' => 'admela_footer_copyrights_setting',
		'description' => esc_html__('Here, you can also change your footer copy rights text','admela'),
	));
	
    
}

endif;

add_action( 'customize_register', 'admela_customize_register' );


/**
 * Render the site title for the selective refresh partial.
 *
 * @since Admeal 1.0
 * @see admela_customize_register()
 *
 * @return void
 */
if(! function_exists( 'admela_customize_partial_blogname' )):
function admela_customize_partial_blogname() {
	bloginfo( 'name' );
}
endif;
/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Admeal 1.0
 * @see admela_customize_register()
 *
 * @return void
 */
if(! function_exists( 'admela_customize_partial_blogdescription' )):
function admela_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
endif;


/**
 * Sanitize the header social url.
 *
 * @param string $admela_url.
 */

if(! function_exists( 'admela_sanitize_url' )):

function admela_sanitize_url( $admela_url ) {
  return esc_url_raw( $admela_url );
}

endif;

/**
 * Sanitize the admela_sanitize_checkbox.
 *
 * @param string $admela_input.
 */

if(! function_exists( 'admela_sanitize_checkbox' )):

function admela_sanitize_checkbox( $admela_input ) {
  return (isset($admela_input) ? true : false);
}

endif;


/**
 * Sanitize the admela_sanitize_relatedposttype.
 *
 * @param string $admela_input.
 */

if(! function_exists( 'admela_sanitize_relatedposttype' )):

function admela_sanitize_relatedposttype( $admela_input ) {
  
    $admela_valid = array('category','tag');
	
	if(in_array($admela_input,$admela_valid,true)) {
	  
	  return $admela_input;
  
	}
	
	return 'category';
	
}

endif;


/**
 * Sanitize the admela_sanitize_relatedpostorder.
 *
 * @param string $admela_input.
 */

if(! function_exists( 'admela_sanitize_relatedpostorder' )):

function admela_sanitize_relatedpostorder( $admela_input ) {
  
    $admela_valid = array('latest','random');
	
	if(in_array($admela_input,$admela_valid,true)) {
	  
	  return $admela_input;
  
	}
	
	return 'latest';
	
}

endif;


/**
 * Sanitize the Text Area.
 *
 * @param string $admela_textarea.
 */

if(! function_exists( 'admela_sanitize_textarea' )):

function admela_sanitize_textarea( $admela_textarea ) {
  return wp_specialchars_decode( $admela_textarea,ENT_COMPAT );
}

endif;


/**
 * Sanitize the input text.
 *
 * @param string $admela_text.
 */

if(! function_exists( 'admela_sanitize_text' )):

function admela_sanitize_text( $admela_text ) {
  return esc_html($admela_text);
}

endif;


/**
 * Sanitize the select.
 *
 * @param string $admela_input,$admela_setting.
*/

if(! function_exists( 'admela_sanitize_select' )):

//select sanitization function
function admela_sanitize_select( $input, $setting ){
         
    //admela_input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);
 
    //get the list of possible select options 
    $admela_choices = $setting->manager->get_control( $setting->id )->choices;
                             
    //return input if valid or return default option
 	return ( array_key_exists( $input, $admela_choices ) ? $input : $input );
             
}
endif;


/**
 * Bind JS handlers to instantly live-preview changes.
 */
if(! function_exists( 'admela_customize_preview_js' )):
function admela_customize_preview_js() {
	wp_enqueue_script( 'customize-preview', get_theme_file_uri( '/js/admela-customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
}
endif;
add_action( 'customize_preview_init', 'admela_customize_preview_js' );

