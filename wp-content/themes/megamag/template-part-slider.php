<div id="carousel-home" class="flexslider">										   
  <ul class="slides">										        									     
    <?php $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => 10,
            'post_type'             => 'post',
            'category__in'          => get_theme_mod( 'featured-categories')
         ) );
         while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();         
    ?>                    	     
    <li class="col-md-12">                    	        
    <div class="flex-img">                    	           
      <a href="<?php the_permalink(); ?>">                                         
        <?php if ( has_post_thumbnail() ) { ?>        												           
          <div class="featured-thumbnail"><?php the_post_thumbnail('firstmag-carousel',array('itemprop'=>'image')); ?></div> 											         
        <?php } else { ?>                                       
          <div class="featured-thumbnail"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/noprew-carousel-home.jpg" alt="<?php the_title(); ?>"></div>    									               
        <?php } ?>                              
      </a>                                                                
    </div>                               
    <div class="flex-caption">		                     						         
      <div class="flex-title home-header">                      						                                                                                                     
        <header>
          <h2 class="page-header">                                
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
              <?php the_title(); ?>
            </a>                            
          </h2> 
        </header>                                                                                                                                                                                                                                                                   
        <div class="flex-meta row">
          <time class="posted-on published col-xs-12" ><i class="fa fa-clock-o"></i><?php the_time( get_option( 'date_format' ) ); ?></time>
          <div class="author-link col-xs-12"><i class="fa fa-user"></i><?php the_author_posts_link(); ?></div>
        </div> 
      </div>                                 
    </div>                            
    </li>  											     
    <?php endwhile; wp_reset_query(); ?>  										   
  </ul>									 
</div>
