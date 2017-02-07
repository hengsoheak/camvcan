<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header>
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
			<?php
			if ( have_posts() ) : ?>
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar( 'left' ); ?>
	<?php get_sidebar(); ?>

</div><!-- #content -->
<?php get_footer();