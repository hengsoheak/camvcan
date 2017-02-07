<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 */

get_header(); ?>

	<!-- Wrapper start -->
	<div class="main">

		<?php
			if( ( function_exists('is_cart') && is_cart() ) || ( function_exists('is_checkout') && is_checkout() ) || ( function_exists('is_wc_endpoint_url') && is_wc_endpoint_url( 'lost-password' ) ) || ( function_exists('is_account_page') && is_account_page() ) ):
				echo '<section class="module module-cart-top">';
			else:
				
				$shop_isle_header_image = get_header_image();
				if( !empty($shop_isle_header_image) ):
					echo '<section class="page-header-module module bg-dark" data-background="'.esc_url($shop_isle_header_image).'">';
				else:
					echo '<section class="page-header-module module bg-dark">';
				endif;
				
			endif;
		?>
		
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<h1 class="module-title font-alt"><?php the_title(); ?></h1>
				</div>
			</div>
			<?php 
				if(( function_exists('is_cart') && is_cart() ) || ( function_exists('is_checkout') && is_checkout() ) || ( function_exists('is_wc_endpoint_url') && is_wc_endpoint_url( 'lost-password' ) ) || ( function_exists('is_account_page') && is_account_page() )):
					echo '<hr class="divider-w pt-20"><!-- divider -->';
				endif; 
			?>
		</div><!-- .container -->
		
		<?php	
			echo '</section>';
		?>	
	

		<!-- Pricing start -->
		<?php 
			if(( function_exists('is_cart') && is_cart() ) || ( function_exists('is_checkout') && is_checkout() ) || ( function_exists('is_wc_endpoint_url') && is_wc_endpoint_url( 'lost-password' ) ) || ( function_exists('is_account_page') && is_account_page() )):
				echo '<section class="page-module-content module module-cart-bottom">';
			else:
				echo '<section class="page-module-content module">';
			endif; 
		?>
			<div class="container">
			
				<div class="row">	

					<!-- Content column start -->
					<?php if(( function_exists('is_cart') && is_cart() ) || ( function_exists('is_checkout') && is_checkout() ) || ( function_exists('is_wc_endpoint_url') && is_wc_endpoint_url( 'lost-password' ) ) || ( function_exists('is_account_page') && is_account_page() )): ?>
						<div class="col-sm-12">
					<?php else: ?>
						<div class="col-sm-8">
					<?php endif; ?>	
							<?php
							/**
							* @hooked woocommerce_breadcrumb - 10
							*/
							do_action( 'shop_isle_content_top' ); ?>

							<?php while ( have_posts() ) : the_post(); ?>

								<?php
								do_action( 'shop_isle_page_before' );
								?>

								<?php get_template_part( 'content', 'page' ); ?>

								<?php
								/**
								 * @hooked shop_isle_display_comments - 10
								 */
								do_action( 'shop_isle_page_after' );
								?>

							<?php endwhile; // end of the loop. ?>

						</div>
					<!-- Content column end -->

					<!-- Sidebar column start -->
					<?php if(( function_exists('is_cart') && is_cart() ) || ( function_exists('is_checkout') && is_checkout() ) || ( function_exists('is_wc_endpoint_url') && is_wc_endpoint_url( 'lost-password' ) ) || ( function_exists('is_account_page') && is_account_page() )): ?>
					<?php else: ?>
						<div class="col-xs-12 col-sm-4 col-md-3 col-md-offset-1 sidebar">

							<?php do_action( 'shop_isle_sidebar' ); ?>

						</div>
					<?php endif; ?>	
					<!-- Sidebar column end -->

				</div><!-- .row -->
			
			</div>
		<?php
			echo '</section>';
		?>	
		<!-- Pricing end -->


<?php get_footer(); ?>