<?php
/**
 * The template for displaying contact page.
 *
 * Template Name: Contact page
 *
 */

get_header(); ?>

<!-- Wrapper start -->
	<div class="main">

		<!-- Header section start -->
		<?php
		$shop_isle_header_image = get_header_image();
		if( !empty($shop_isle_header_image) ):
			echo '<section class="page-header-module module bg-dark" data-background="'.esc_url($shop_isle_header_image).'">';
		else:
			echo '<section class="page-header-module module bg-dark">';
		endif;
		?>
			<div class="container">

				<div class="row">

					<div class="col-sm-10 col-sm-offset-1">

						<h1 class="module-title font-alt"><?php the_title(); ?></h1>

					</div>

				</div><!-- .row -->

			</div>
		</section>
		<!-- Header section end -->

		<!-- Contact start -->
		
		<?php 
		
		if( have_posts() ):
		
			while ( have_posts() ) : the_post();

				get_template_part( 'content', 'contact' );

			endwhile; 
			
		endif;	
			
get_footer(); ?>