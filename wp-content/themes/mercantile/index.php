<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Mercantile
 */
get_header();
global $mercantile_customizer_all_values;
$mercantile_enable_feature = $mercantile_customizer_all_values['mercantile-enable-feature'];

if(
	( is_home() && is_front_page() && 1 != $mercantile_enable_feature )
	|| !is_front_page()
){
	?>
	<div class="wrapper inner-main-title">
		<div class="container">
			<div class="row">
				<header class="entry-header col-md-6 init-animate fadeInDown1">
					<h1 class="page-title"><?php single_post_title(); ?></h1>
				</header>
				<?php
				if( 1 == $mercantile_customizer_all_values['mercantile-show-breadcrumb'] ){
					mercantile_breadcrumbs();
				}
				?>
			</div>
		</div>
	</div>
	<?php
}
?>
	<div id="content" class="site-content container clearfix">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<?php
				if ( have_posts() ) :
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

		<?php
		get_sidebar( 'left' );
		get_sidebar();
		?>

	</div><!-- #content -->
<?php get_footer();