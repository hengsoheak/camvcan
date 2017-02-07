<?php
/**
 * Template part for displaying recent posts from widgets.
 *
 * @package Acme Themes
 * @subpackage Mercantile
 */
global  $mercantile_read_more_text;
      
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="content-wrapper">
        <?php
        if( has_post_thumbnail() ){
          ?>
            <a href="<?php the_permalink(); ?>" class="full-image">
                <?php
                the_post_thumbnail( 'large', array( 'class' => 'aligncenter' ) );
                ?>
            </a>
        <?php
        }
        ?>
        <header class="entry-header">
            <?php
            the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
            if ( 'post' === get_post_type() ) : ?>
                <div class="entry-meta">
                    <?php mercantile_posted_on(); ?>
                </div><!-- .entry-meta -->
                <?php
            endif; ?>
        </header><!-- .entry-header -->
        <div class="entry-content">
            <?php
            the_excerpt();
            ?>
        </div><!-- .entry-content -->
        <div class="clearfix"></div>
        <?php
        if( !empty( $mercantile_read_more_text ) ){
            ?>
            <a class="read-more" href="<?php the_permalink(); ?> "><?php echo esc_html( $mercantile_read_more_text ); ?></a>
            <?php
        }
        ?>
    </div>

</article><!-- #post-## -->