<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
                    <h1 class="entry-title">
                        <?php _e('Store','mercantile')?>
                    </h1>
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
                <?php if ( have_posts() ) :
                    woocommerce_content();
                endif;
                ?>
            </main><!-- #main -->
        </div><!-- #primary -->
        <?php
        get_sidebar( 'left' );
        get_sidebar();
        ?>
    </div><!-- #content -->
<?php get_footer();