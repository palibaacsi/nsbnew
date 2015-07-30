<?php
/**
 * Sample implementation of the Custom logo feature
 * http://codex.wordpress.org/Custom_logos
 *
 * You can add an optional custom logo image to logo.php like so ...
 *
 *	<?php if ( get_logo_image() ) : ?>
 *	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
 *		<img src="<?php logo_image(); ?>" width="<?php echo esc_attr( get_custom_logo()->width ); ?>" height="<?php echo esc_attr( get_custom_logo()->height ); ?>" alt="">
 *	</a>
 *	<?php endif; // End logo image check. ?>
 *
 * @package NSB
 */

/**
 * Set up the WordPress core custom logo feature.
 *
 * @uses nsb_logo_style()
 * @uses nsb_admin_logo_style()
 * @uses nsb_admin_logo_image()
 */
function nsb_custom_logo_setup() {
	add_theme_support( 'custom-logo', apply_filters( 'nsb_custom_logo_args', array(
		'default-image'          => '',
		'default-text-color'     => 'FFFFFF',
		'width'                  => 260,
		'height'                 => 125,
		'flex-height'            => true,
		'wp-head-callback'       => 'nsb_logo_style',
		'admin-head-callback'    => 'nsb_admin_logo_style',
		'admin-preview-callback' => 'nsb_admin_logo_image',
	) ) );
}
add_action( 'after_setup_theme', 'nsb_custom_logo_setup' );

if ( ! function_exists( 'nsb_logo_style' ) ) :
/**
 * Styles the logo image and text displayed on the blog
 *
 * @see nsb_custom_logo_setup().
 */
function nsb_logo_style() {
	$logo_text_color = get_logo_textcolor();

	// If no custom options for text are set, let's bail
	// get_logo_textcolor() options: logo_TEXTCOLOR is default, hide text (returns 'blank') or any hex value.
	if ( logo_TEXTCOLOR == $logo_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $logo_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $logo_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // nsb_logo_style

if ( ! function_exists( 'nsb_admin_logo_style' ) ) :
/**
 * Styles the logo image displayed on the Appearance > logo admin panel.
 *
 * @see nsb_custom_logo_setup().
 */
function nsb_admin_logo_style() {
?>
	<style type="text/css">
		.appearance_page_custom-logo #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // nsb_admin_logo_style

if ( ! function_exists( 'nsb_admin_logo_image' ) ) :
/**
 * Custom logo image markup displayed on the Appearance > logo admin panel.
 *
 * @see nsb_custom_logo_setup().
 */
function nsb_admin_logo_image() {
?>
	<div id="headimg">
		<h1 class="displaying-logo-text">
			<a id="name" style="<?php echo esc_attr( 'color: #' . get_logo_textcolor() ); ?>" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<div class="displaying-logo-text" id="desc" style="<?php echo esc_attr( 'color: #' . get_logo_textcolor() ); ?>"><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_logo_image() ) : ?>
		<img src="<?php logo_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // nsb_admin_logo_image
