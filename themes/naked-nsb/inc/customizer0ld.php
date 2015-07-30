<?php
/**
 * NSB Theme Customizer
 *
 * @package NSB 
 */

add_action('customize_register','nsb_logo_customizer');
// Loading the Logo
function nsb_logo_customizer( $wp_customize ) {

	$wp_customize->add_section(
	    'nsb_logo_upload',
	    array(
	        'title'     => 'Logo Upload',
	    )
	);

	$wp_customize->add_setting(
	    'nsb_logo_image',
	    array(
	        'default'      => '',
	        'transport'    => 'postMessage'
	    )
	);

	$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'nsb_logo_ctrl',
        array(
            'label'    => 'NSB Logo',
            'setting' => 'nsb_logo_image',
            'section'  => 'nsb_logo_upload'
        )
    )
	);
}

function nsb_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'nsb_logo_image' )->transport = 'postMessage';
}
add_action( 'customize_register', 'nsb_customize_register' );


add_action( 'customize_preview_init', 'nsb_customize_preview_js' );

function nsb_customize_preview_js() {
/*	wp.customize( 'tcx_background_image', function( value ) {
	    value.bind( function( to ) {
	 
	        0 === $.trim( to ).length ?
	            $( 'body' ).css( 'background-image', '' ) :
	            $( 'body' ).css( 'background-image', 'url( ' + to + ')' );
	 
	    });
	});
*/
wp_enqueue_script( 'nsb_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
/*function nsb_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'logo_textcolor' )->transport = 'postMessage';
	$wp_customize->get_section( 'address_section' )->transport = 'postMessage';
	$wp_customize->get_setting( 'address_1' )->transport = 'postMessage';
	$wp_customize->get_setting( 'address_2' )->transport = 'postMessage';
	$wp_customize->get_setting( 'phone' )->transport = 'postMessage';
}
add_action( 'customize_register', 'nsb_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
/*function nsb_customize_preview_js() {
	wp_enqueue_script( 'nsb_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'nsb_customize_preview_js' );
*/