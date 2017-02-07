<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Acme Themes
 * @subpackage Mercantile
 */
get_header();
global $mercantile_customizer_all_values;
?>
<div class="wrapper inner-main-title">
	<div class="container">
		<div class="row">
			<header class="entry-header col-md-6 init-animate fadeInDown1">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
			<?php
			if( 1 == $mercantile_customizer_all_values['mercantile-show-breadcrumb'] ){
				mercantile_breadcrumbs();
			}
			?>
		</div>
	</div>
</div>
<div id="content" class="site-content container clearfix">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', 'single' );
			
			if ( is_singular( 'attachment' ) ) {
				// Parent post navigation.
				the_post_navigation( array(
					'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'mercantile' ),
				) );
			} elseif ( is_singular( 'post' ) ) {
				// Previous/next post navigation.
				the_post_navigation( array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'mercantile' ) . ':</span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'mercantile' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'mercantile' ) . ':</span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'mercantile' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				) );
			}
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		endwhile; // End of the loop. 
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php 
	get_sidebar( 'left' );
	get_sidebar();
	?>

</div><!-- #content -->
<?php get_footer(); ?>
