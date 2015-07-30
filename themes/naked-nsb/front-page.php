<?php
/**
 * Template Name: Home Page
 *
 */

get_header(); // This fxn gets the header.php file and renders it ?>

<h1 id="top"></h1>

<div id="spacer"></div>

	<h1 id="about"></h1>

<section id="first" class="row-fluid">
	
	<div id="home-visual" style="text-align:center;"><a id="about"></a>

		<h2>NSB Food Service Equipment & Supplies</h2>
		<h3>+1.703.378.9200</h3>
<!-- <video autoplay loop poster="polina.jpg" id="bgvid">
<source src="polina.webm" type="video/webm"> 
<source src="http://nsb-new.dev/wp-0ther/RickStevesItaly.mp4" type="video/mp4">
</video>-->

	</div><!-- #home-visual -->

</section><!-- #first -->

<section id="second" class="row-fluid">

	<div id="nsb-loop">
		<div id="content" role="main" class="span8 offset2">

			<?php if ( have_posts() ) : 
			// Do we have any posts/pages in the databse that match our query?
			?>

				<?php while ( have_posts() ) : the_post(); 
				// If we have a page to show, start a loop that will display it
				?>

					<article class="post">
					
						<h1 class="title"><?php // the_title(); // Display the title of the page ?></h1>
						
						<div class="the-content">
							<?php the_content(); 
							// This call the main content of the page, the stuff in the main text box while composing.
							// This will wrap everything in p tags
							?>
							
							<?php wp_link_pages(); // This will display pagination links, if applicable to the page ?>
						</div><!-- the-content -->
						
					</article>

				<?php endwhile; // OK, let's stop the page loop once we've displayed it ?>

			<?php else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) ?>
				
				<article class="post error">
					<h1 class="404">Nothing posted yet</h1>
				</article>

			<?php endif; // OK, I think that takes care of both scenarios (having a page or not having a page to show) ?>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->
</section><!-- #nsb-loop -->

<section id="third" class="row-fluid">
	
	<div id="home-third">

	<?php  echo do_shortcode("[metaslider id=28]");  ?>

	<div id="logo-slider">

	<?php logo_slider(); ?>

	</div><!-- #logo-slider -->

	</div><!-- #home-third -->

</section><!-- #third -->

	<h1 id="contact"></h1>

<section id="fourth"  style="padding: 10rem 0;" class="row-fluid">
	<div id="home-fourth">

	<!-- <div style="padding: 10rem 0; text-align:left;float:left;width:50%;">

 <?php /* if ( function_exists( 'contact_detail' ) ) { 

 	echo '<p>Call us at: ' ;

 	contact_detail('phone');
 	
 	echo '<br /> or in the US at: ';

	contact_detail('mobile');
 
	echo '<br />In NoVA, please visit our showroom at: <br /> ';
 	contact_detail('address') . '</p>'; 

 	} */ ?>
</div> -->
	<div id="home-contact" class="inline-pair">

	<?php  echo do_shortcode("[CONTACT_FORM_TO_EMAIL id='1']");  ?>

	</div>

	<div id="home-map" class="inline-pair">

			<div id="home-address">
		<?php if ( function_exists( 'contact_detail' ) ) { 
		echo	contact_detail( 'phone' ) . ' phone <br />'; 
		echo	contact_detail( 'fax' ) . ' fax <br />'; 
		echo	contact_detail( 'mobile' ) ; 
		echo '<p id="front-address">';
			contact_detail( 'address' ); 
		echo '</p>';

		} ?>.
			</div>


	<?php  echo do_shortcode("[wpgmza id='1']");  ?>

	</div>
</div>
</section><!-- #home-fourth -->

<h1 id="store"></h1>
	<div class="clear"></div>

<section id="fifth" class="row-fluid">
	<style type="text/css">

	</style>
	
	<div id="home-fifth">

	<?php if ( is_active_sidebar( 'home-products' ) ) : ?>
		<ul id="sidebar">
			<?php dynamic_sidebar( 'home-products' ); ?>
		</ul>

	<?php endif; ?>

	<div class="clear"></div>

<a href="#top">Back to Top</a>

</section><!-- #home-fifth -->

<?php get_footer(); // This fxn gets the footer.php file and renders it ?>