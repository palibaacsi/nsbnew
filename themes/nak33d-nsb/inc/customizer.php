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
           'nsb_logo_image',
           array(
               'label'      => __( 'Upload a logo', 'theme_name' ),
               'section'    => 'nsb_logo_upload',
               'settings'   => 'nsb_logo_image',
               'context'    => 'nsb_logo_ctrl' 
           )
       )
   );

}