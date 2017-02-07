<?php

/**
 *
 * Customizer
 *
 */

/**
 * Register settings and controls for customize
 *
 * @since  1.0.0
 */ 
function shop_isle_customize_register( $wp_customize ) {

	class ShopIsle_Contact_Page_Instructions extends WP_Customize_Control {
		public function render_content() {
			echo __( 'To customize the Contact Page you need to first select the template "Contact page" for the page you want to use for this purpose. Then open that page in the browser and press "Customize" in the top bar.','shop-isle' ).'<br><br>'. __( 'Need further assistance? Check out this','shop-isle' ).' <a href="http://docs.themeisle.com/article/211-shopisle-customizing-the-contact-and-about-us-page" target="_blank">'.__( 'doc','shop-isle' ).'</a>';
		}
	}
	class ShopIsle_Front_Page_Instructions extends WP_Customize_Control {
		public function render_content() {

			printf(
				__( 'To customize the Frontpage sections please create a page and select the template "Frontpage" for that page. After that, go to %1$s and under "Front page displays" select "A static page". Finally, for "Front page" choose the page you previously created.', 'shop-isle' ),
				sprintf( '<a class="shop_isle_go_to_section" href="accordion-section-shop_isle_general_section">%s</a>', esc_html__( 'Advanced options', 'shop-isle' ) )
			);

			echo '<br><br>';

			printf(
				__( 'Need further informations? Check this %1$s', 'shop-isle' ),
				sprintf( '<a href="http://docs.themeisle.com/article/236-how-to-set-up-the-home-page-for-llorix-one" target="_blank">%s</a>', esc_html__( 'doc', 'shop-isle' ) )
			);

		}
	}

	class ShopIsle_Theme_Info extends WP_Customize_Control {
		public $type = 'info';
		public $label = '';
		public function render_content() {
			echo '<div class="shopisle-theme-info">';
			echo sprintf( '<a href="http://docs.themeisle.com/article/421-shop-isle-documentation-wordpress-org" target="_blank">%s</a>', esc_html__( 'View Documentation', 'shop-isle' ) );
			echo '<hr/>';
			echo sprintf( '<a href="http://themeisle.com/demo/?theme=ShopIsle" target="_blank">%s</a>', esc_html__( 'View Demo', 'shop-isle' ) );
			echo '<hr/>';
			echo sprintf( '<a href="http://docs.themeisle.com/article/472-what-is-the-difference-between-shop-isle-and-shopisle-pro/" target="_blank">%s</a>', esc_html__( 'Free VS Pro', 'shop-isle' ) );
			echo '<hr/>';
			echo sprintf( '<a href="https://wordpress.org/support/theme/shop-isle/reviews/#new-post/" target="_blank">%s</a>', esc_html__( 'Leave a review', 'shop-isle' ) );
			echo '</div>';
		}
	}

	class ShopIsle_Colors_Notice extends WP_Customize_Control {
		public $type = 'info';
		public $label = '';
		public function render_content() {
			echo '<div class="shopisle-theme-info"><p>' . esc_html__( 'Get full color schemes support for your site. ', 'shop-isle' );
			echo sprintf( '<a href="http://themeisle.com/themes/shop-isle-pro/" target="_blank">%s</a>', esc_html__( 'View PRO version', 'shop-isle' ) );
			echo '<span class="dashicons dashicons-admin-customizer"></span>' . '</p></div>';
		}
	}

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';

	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/******************************/
	/**********  Header ***********/
	/******************************/

	$wp_customize->add_section( 'shop_isle_header_section', array(
        'title'    => __( 'Header', 'shop-isle' ),
        'priority' => 40
    ) );

	/* Logo */
	$custom_logo = $wp_customize->get_control( 'custom_logo' );
	if( empty( $custom_logo ) ) {

		$wp_customize->add_setting( 'shop_isle_logo', array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url'
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'shop_isle_logo', array(
			'label'    => __( 'Logo', 'shop-isle' ),
			'section'  => 'shop_isle_header_section',
			'priority' => 1,
		) ) );

	}

	$wp_customize->get_control( 'header_image' )->section = 'shop_isle_header_section' ;
	$wp_customize->get_control( 'header_image' )->priority = '2';

	/* Blog Header title */
	$wp_customize->add_setting( 'shop_isle_blog_header_title', array(
		'default' 			=> __( 'Blog','shop-isle' ),
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'transport' 		=> 'postMessage'
	));
	$wp_customize->add_control( 'shop_isle_blog_header_title', array(
		'label'    			=> esc_html__( 'Blog header title', 'shop-isle' ),
		'section'  			=> 'shop_isle_header_section',
		'priority'    		=> 3
	));

	/* Blog Header subtitle */
	$wp_customize->add_setting( 'shop_isle_blog_header_subtitle', array(
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'transport' 		=> 'postMessage'
	));
	$wp_customize->add_control( 'shop_isle_blog_header_subtitle', array(
		'label'    			=> esc_html__( 'Blog header subtitle', 'shop-isle' ),
		'section'  			=> 'shop_isle_header_section',
		'priority'    		=> 4
	));

	/***********************************************************************************/
	/******  Frontpage - instructions for users when not on Frontpage template *********/
	/***********************************************************************************/

	$wp_customize->add_section( 'shop_isle_front_page_instructions', array(
		'title'    => __( 'Frontpage settings', 'shop-isle' ),
		'active_callback' => 'shop_isle_is_not_frontpage',
		'priority' => 20
	) );

	$wp_customize->add_setting( 'shop_isle_front_page_instructions', array(
		'sanitize_callback' => 'shop_isle_sanitize_text'
	) );

	$wp_customize->add_control( new ShopIsle_Front_Page_Instructions( $wp_customize, 'shop_isle_front_page_instructions', array(
		'section' => 'shop_isle_front_page_instructions'
	)));

	/****************************************************************/
	/******************  	FRONTPAGE SECTIONS    *******************/
	/****************************************************************/

	$wp_customize->add_panel( 'shop_isle_front_page_sections', array(
		'title'    => __( 'Frontpage sections', 'shop-isle' ),
		'priority' => 42
	) );

	/*******************************/
	/****   Big title section ******/
	/*******************************/

	$wp_customize->add_section( 'shop_isle_big_title_section' , array(
		'title'       => __( 'Big title section', 'shop-isle' ),
		'priority'    => 41,
		'panel' => 'shop_isle_front_page_sections'
	));

	/* Hide big title section */
	$wp_customize->add_setting( 'shop_isle_big_title_hide', array(
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'transport' => 'postMessage'
	));

	$wp_customize->add_control(
		'shop_isle_big_title_hide',
		array(
			'type' => 'checkbox',
			'label' => __('Hide big title section?','shop-isle'),
			'description' => __('If you check this box, the Big title section will disappear from homepage.','shop-isle'),
			'section' => 'shop_isle_big_title_section',
			'priority'    => 1,
		)
	);

	/* Image */
	$wp_customize->add_setting( 'shop_isle_big_title_image', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => get_template_directory_uri().'/assets/images/slide1.jpg'
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'shop_isle_big_title_image', array(
		'label' => __( 'Image', 'shop-isle' ),
		'section' => 'shop_isle_big_title_section',
		'priority' => 2,
	)));

	/* Title */
	$wp_customize->add_setting( 'shop_isle_big_title_title', array(
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'default'    => 'ShopIsle'
	));

	$wp_customize->add_control( 'shop_isle_big_title_title', array(
		'label' => __( 'Title','shop-isle' ),
		'section'  => 'shop_isle_big_title_section',
		'priority'    => 3
	));

	/* Subtitle */
	$wp_customize->add_setting( 'shop_isle_big_title_subtitle', array(
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'default'    => __( 'WooCommerce Theme', 'shop-isle' )
	));

	$wp_customize->add_control( 'shop_isle_big_title_subtitle', array(
		'label' => __( 'Subtitle', 'shop-isle' ),
		'section'  => 'shop_isle_big_title_section',
		'priority'    => 4
	));

	/* Button label */
	$wp_customize->add_setting( 'shop_isle_big_title_button_label', array(
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'default'    => __( 'Find out more', 'shop-isle' )
	));

	$wp_customize->add_control( 'shop_isle_big_title_button_label', array(
		'label' => __( 'Button label','shop-isle' ),
		'section'  => 'shop_isle_big_title_section',
		'priority'    => 5
	));

	/* Button link */
	$wp_customize->add_setting( 'shop_isle_big_title_button_link', array(
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'default'    => __( '#', 'shop-isle' )
	));

	$wp_customize->add_control( 'shop_isle_big_title_button_link', array(
		'label' => __( 'Button link', 'shop-isle' ),
		'section'  => 'shop_isle_big_title_section',
		'priority'    => 6,
	));

	/********************************/
    /*********	Banners section *****/
	/********************************/

	$wp_customize->add_section( 'shop_isle_banners_section' , array(
		'title'       => __( 'Banners section', 'shop-isle' ),
		'priority'    => 42,
		'panel' => 'shop_isle_front_page_sections'
	));

	/* Hide banner */
	$wp_customize->add_setting( 'shop_isle_banners_hide', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));

	$wp_customize->add_control(
		'shop_isle_banners_hide',
		array(
			'type' => 'checkbox',
			'label' => __('Hide banners section?','shop-isle'),
			'description' => __('If you check this box, the Banners section will disappear from homepage.','shop-isle'),
			'section' => 'shop_isle_banners_section',
			'priority'    => 1,
		)
	);

	$wp_customize->add_setting( 'shop_isle_banners_title', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));

	$wp_customize->add_control( 'shop_isle_banners_title', array(
		'label' => __( 'Section title', 'shop-isle' ),
		'section' => 'shop_isle_banners_section',
		'priority' => 2,
	));

	/* Banner */
	$wp_customize->add_setting( 'shop_isle_banners', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_repeater',
		'default' => json_encode(array( array('image_url' => get_template_directory_uri().'/assets/images/banner1.jpg' ,'link' => '#' ),array('image_url' => get_template_directory_uri().'/assets/images/banner2.jpg' ,'link' => '#'),array('image_url' => get_template_directory_uri().'/assets/images/banner3.jpg' ,'link' => '#') ))
	));
	$wp_customize->add_control( new Shop_Isle_Repeater_Controler( $wp_customize, 'shop_isle_banners', array(
		'label'   => __('Add new banner','shop-isle'),
		'section' => 'shop_isle_banners_section',
		'priority' => 3,
        'shop_isle_image_control' => true,
        'shop_isle_link_control' => true,
        'shop_isle_text_control' => false,
		'shop_isle_subtext_control' => false,
		'shop_isle_label_control' => false,
		'shop_isle_icon_control' => false,
		'shop_isle_description_control' => false,
		'shop_isle_box_label' => __('Banner','shop-isle'),
		'shop_isle_box_add_label' => __('Add new banner','shop-isle')
	) ) );


	/*********************************/
    /*******  Products section *******/
	/********************************/

	$shop_isle_require_woo = '';
	if( !class_exists( 'WooCommerce' ) ) {
		$shop_isle_require_woo = '<div class="shop-isle-require-woo"><p>'.sprintf( __( 'To use this section, you are required to first install the  %1$s plugin', 'shop-isle' ), sprintf( '<a href="'.esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ) ).'">%s</a>', esc_html__( 'WooCommerce', 'shop-isle' ) ) ).'</p></div>';
	}

	$wp_customize->add_section( 'shop_isle_products_section' , array(
		'title'       => __( 'Products section', 'shop-isle' ),
		'description' => $shop_isle_require_woo,
		'priority'    => 43,
		'panel' => 'shop_isle_front_page_sections'
	));

	/* Hide products */
	$wp_customize->add_setting( 'shop_isle_products_hide', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));

	$wp_customize->add_control( 'shop_isle_products_hide', array(
		'type' => 'checkbox',
		'label' => __('Hide products section?','shop-isle'),
		'description' => __('If you check this box, the Products section will disappear from homepage.','shop-isle'),
		'section' => 'shop_isle_products_section',
		'priority'    => 1,
	));

	/* Title */
	$wp_customize->add_setting( 'shop_isle_products_title', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'default' => __( 'Latest products', 'shop-isle' )
	));

	$wp_customize->add_control( 'shop_isle_products_title', array(
		'label'    => __( 'Section title', 'shop-isle' ),
		'section'  => 'shop_isle_products_section',
		'priority'    => 2,
	));

	/* Shortcode */
	$wp_customize->add_setting( 'shop_isle_products_shortcode', array(
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));

	$wp_customize->add_control( 'shop_isle_products_shortcode', array(
		'label'    => __( 'WooCommerce shortcode', 'shop-isle' ),
		'section'  => 'shop_isle_products_section',
		'description'  => __( 'Insert a WooCommerce shortcode', 'shop-isle' ),
		'priority'    => 3,
	));

	$shop_isle_prod_categories_array = array('-' => __('Select category','shop-isle'));

	$shop_isle_prod_categories = get_categories( array('taxonomy' => 'product_cat', 'hide_empty' => 0, 'title_li' => '') );

	if( !empty($shop_isle_prod_categories) ):
		foreach ($shop_isle_prod_categories as $shop_isle_prod_cat):

			if( !empty($shop_isle_prod_cat->term_id) && !empty($shop_isle_prod_cat->name) ):
				$shop_isle_prod_categories_array[$shop_isle_prod_cat->term_id] = $shop_isle_prod_cat->name;
			endif;

		endforeach;
	endif;

	/* Category */
	$wp_customize->add_setting( 'shop_isle_products_category', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));
	$wp_customize->add_control( 'shop_isle_products_category', array(
		'type' 		   => 'select',
		'label' 	   => __( 'Products category', 'shop-isle' ),
		'description'  => __( 'OR pick a product category. If no shortcode or no category is selected , WooCommerce latest products are displaying.', 'shop-isle' ),
		'section' 	   => 'shop_isle_products_section',
		'choices'      => $shop_isle_prod_categories_array,
		'priority' 	   => 4,
	));

	/****************************************/
	/*********** Video section **************/
	/****************************************/

	$wp_customize->add_section( 'shop_isle_video_section' , array(
		'title'       => __( 'Video section', 'shop-isle' ),
		'priority'    => 44,
		'panel' => 'shop_isle_front_page_sections'
	));

	/* Hide video */
	$wp_customize->add_setting( 'shop_isle_video_hide', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));

	$wp_customize->add_control( 'shop_isle_video_hide', array(
		'type' => 'checkbox',
		'label' => __('Hide video section?','shop-isle'),
		'description' => __('If you check this box, the Video section will disappear from homepage.','shop-isle'),
		'section' => 'shop_isle_video_section',
		'priority'    => 1,
	));

	/* Title */
	$wp_customize->add_setting( 'shop_isle_video_title', array(
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'transport' => 'postMessage'
	));

	$wp_customize->add_control( 'shop_isle_video_title', array(
		'label'    => __( 'Title', 'shop-isle' ),
		'section'  => 'shop_isle_video_section',
		'priority'    => 2,
	));

	/* Youtube link */
	$wp_customize->add_setting( 'shop_isle_yt_link', array(
		'sanitize_callback' => 'esc_url'
	));

	$wp_customize->add_control( 'shop_isle_yt_link', array(
		'label'    => __( 'Youtube link', 'shop-isle' ),
		'section'  => 'shop_isle_video_section',
		'priority'    => 3,
	));

	/* Thumbnail */
	$wp_customize->add_setting( 'shop_isle_yt_thumbnail', array(
		'sanitize_callback' => 'esc_url'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'shop_isle_yt_thumbnail', array(
		'label'    	=> 'Video thumbnail',
		'description' => 'This image will appear while the video is downloading. If this is not included, the first frame of the video will be used instead.',
		'section'  	=> 'shop_isle_video_section',
		'priority'	=> 4,
	) ) );

	/****************************************/
    /*******  Products slider section *******/
	/****************************************/

	$wp_customize->add_section( 'shop_isle_products_slider_section' , array(
		'title'       => __( 'Products slider section', 'shop-isle' ),
		'description' => $shop_isle_require_woo,
		'priority'    => 45,
		'panel' => 'shop_isle_front_page_sections'
	));

	/* Hide products slider on frontpage */
	$wp_customize->add_setting( 'shop_isle_products_slider_hide', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));

	$wp_customize->add_control(
		'shop_isle_products_slider_hide',
		array(
			'type' => 'checkbox',
			'label' => __('Hide products slider section on frontpage?','shop-isle'),
			'description' => __('If you check this box, the Products slider section will disappear from homepage.','shop-isle'),
			'section' => 'shop_isle_products_slider_section',
			'priority'    => 1,
		)
	);

	/* Hide products slider on single product page */
	$wp_customize->add_setting( 'shop_isle_products_slider_single_hide', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));

	$wp_customize->add_control(
		'shop_isle_products_slider_single_hide',
		array(
			'type' => 'checkbox',
			'label' => __('Hide products slider section on single product page?','shop-isle'),
			'description' => __('If you check this box, the Products slider section will disappear from each single product page.','shop-isle'),
			'section' => 'shop_isle_products_slider_section',
			'priority'    => 2,
		)
	);

	/* Title */
	$wp_customize->add_setting( 'shop_isle_products_slider_title', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'default' => __( 'Exclusive products', 'shop-isle' )
		)
	);

	$wp_customize->add_control( 'shop_isle_products_slider_title', array(
		'label'    => __( 'Section title', 'shop-isle' ),
		'section'  => 'shop_isle_products_slider_section',
		'priority'    => 3,
	));

	/* Subtitle */
	$wp_customize->add_setting( 'shop_isle_products_slider_subtitle', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'default' => __( 'Special category of products', 'shop-isle' )
	));

	$wp_customize->add_control( 'shop_isle_products_slider_subtitle', array(
		'label'    => __( 'Section subtitle', 'shop-isle' ),
		'section'  => 'shop_isle_products_slider_section',
		'priority'    => 4,
	));

	/* Category */
	$wp_customize->add_setting( 'shop_isle_products_slider_category', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));
	$wp_customize->add_control(
		'shop_isle_products_slider_category',
		array(
			'type' 		   => 'select',
			'label' 	   => __( 'Products category', 'shop-isle' ),
			'section' 	   => 'shop_isle_products_slider_section',
			'choices'      => $shop_isle_prod_categories_array,
			'priority' 	   => 5,
			'description' => __( 'If no category is selected , WooCommerce products from the first category found are displaying.', 'shop-isle' )
		)
	);

	/*******************************/
    /***********  Footer ***********/
	/*******************************/

	$wp_customize->add_section( 'shop_isle_footer_section', array(
        'title'    => __( 'Footer', 'shop-isle' ),
        'priority' => 50
    ) );

	/* Copyright */
	$wp_customize->add_setting( 'shop_isle_copyright', array(
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'transport' => 'postMessage'
	));

	$wp_customize->add_control( 'shop_isle_copyright', array(
		'label'    => __( 'Copyright', 'shop-isle' ),
		'section'  => 'shop_isle_footer_section',
		'priority'    => 1,
	));

	/* Hide site info */
	$wp_customize->add_setting( 'shop_isle_site_info_hide', array(
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));

	$wp_customize->add_control(
		'shop_isle_site_info_hide',
		array(
			'type' => 'checkbox',
			'label' => __('Hide site info?','shop-isle'),
			'description' => __('If you check this box, the Site info will disappear from footer.','shop-isle'),
			'section' => 'shop_isle_footer_section',
			'priority' => 2,
		)
	);

	/* socials */
	$wp_customize->add_setting( 'shop_isle_socials', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_repeater'
	));
	$wp_customize->add_control( new Shop_Isle_Repeater_Controler( $wp_customize, 'shop_isle_socials', array(
		'label'   => __('Add new social','shop-isle'),
		'section' => 'shop_isle_footer_section',
		'priority' => 3,
        'shop_isle_image_control' => false,
        'shop_isle_link_control' => true,
        'shop_isle_text_control' => false,
		'shop_isle_subtext_control' => false,
		'shop_isle_label_control' => false,
		'shop_isle_icon_control' => true,
		'shop_isle_description_control' => false,
		'shop_isle_box_label' => __('Social','shop-isle'),
		'shop_isle_box_add_label' => __('Add new social','shop-isle')
	) ) );

	/*********************************/
	/******  Contact page  ***********/
	/*********************************/

	$wp_customize->add_section( 'shop_isle_contact_page_section', array(
        'title'    => __( 'Contact page', 'shop-isle' ),
        'priority' => 99,
    ) );

	/* Contact Form  */
	$wp_customize->add_setting( 'shop_isle_contact_page_form_shortcode', array(
		'sanitize_callback' => 'shop_isle_sanitize_text',
	));

	$wp_customize->add_control( 'shop_isle_contact_page_form_shortcode', array(
		'label'    => __( 'Contact form shortcode', 'shop-isle' ),
		'description' => sprintf(
							__( 'Create a form, copy the shortcode generated and paste it here. We recommend %1$s but you can use any plugin you like.', 'shop-isle' ),
							sprintf( '<a href="'.esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=pirate-forms' ), 'install-plugin_pirate-forms' ) ).'">%s</a>', 'Simple Contact Form Plugin - PirateForms' )
						),
		'section'  => 'shop_isle_contact_page_section',
		'active_callback' => 'shop_isle_is_contact_page',
		'priority'    => 1
	));

	/* Map ShortCode  */
	$wp_customize->add_setting( 'shop_isle_contact_page_map_shortcode', array(
		'sanitize_callback' => 'shop_isle_sanitize_text',
	));

	$wp_customize->add_control( 'shop_isle_contact_page_map_shortcode', array(
		'label'    => __( 'Map shortcode', 'shop-isle' ),
		'description' => sprintf(
							__( 'To use this section please install %1$s plugin then use it to create a map and paste here the shortcode generated', 'shop-isle' ),
							sprintf( '<a href="'.esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=intergeo-maps' ), 'install-plugin_intergeo-maps' ) ).'">%s</a>', esc_html__( 'Intergeo Maps', 'shop-isle' ) )
						),
		'section'  => 'shop_isle_contact_page_section',
		'active_callback' => 'shop_isle_is_contact_page',
		'priority'    => 2
	));

	/***********************************************************************************/
	/******  Contact page - instructions for users when not on Contact page  ***********/
	/***********************************************************************************/

	$wp_customize->add_section( 'shop_isle_contact_page_instructions', array(
        'title'    => __( 'Contact page', 'shop-isle' ),
        'priority' => 99
    ) );

	$wp_customize->add_setting( 'shop_isle_contact_page_instructions', array(
		'sanitize_callback' => 'shop_isle_sanitize_text',
	));

	$wp_customize->add_control( new ShopIsle_Contact_Page_Instructions( $wp_customize, 'shop_isle_contact_page_instructions', array(
	    'section' => 'shop_isle_contact_page_instructions',
		'active_callback' => 'shop_isle_is_not_contact_page',
	)));

	
	/********************************************************/
	/************** ADVANCED OPTIONS  ***********************/
	/********************************************************/

	$wp_customize->add_section( 'shop_isle_general_section' , array(
		'title'       => __( 'Advanced options', 'shop-isle' ),
      	'priority'    => 55,
	));

	$wp_customize->remove_control('display_header_text');

	$nav_menu_locations_primary = $wp_customize->get_control('nav_menu_locations[primary]');
	if(!empty($nav_menu_locations_primary)){
		$nav_menu_locations_primary->section = 'shop_isle_general_section';
		$nav_menu_locations_primary->priority = 6;
	}

	/* Disable preloader */
	$wp_customize->add_setting( 'shop_isle_disable_preloader', array(
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'transport' => 'postMessage'
	));

	$wp_customize->add_control( 'shop_isle_disable_preloader', array(
		'type' => 'checkbox',
		'label' => __('Disable preloader?','shop-isle'),
		'description' => __('If this box is checked, the preloader will be disabled from homepage.','shop-isle'),
		'section' => 'shop_isle_general_section',
		'priority'    => 7,
	));


	/* Body font size */
	$wp_customize->add_setting( 'shop_isle_font_size', array(
		'default' => '13px',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));

	$wp_customize->add_control(
		'shop_isle_font_size',
		array(
			'type' 		=> 'select',
			'label' 	=> 'Select font size:',
			'section' 	=> 'shop_isle_general_section',
			'choices' 	=> array(
				'12px' => '12px',
				'13px' => '13px',
				'14px' => '14px',
				'15px' => '15px',
				'16px' => '16px',
			),
		)
	);

	/*********************************/
	/**********  404 page  ***********/
	/*********************************/

	/* Background */
	$wp_customize->add_setting( 'shop_isle_404_background', array(
		'default' => get_template_directory_uri().'/assets/images/404.jpg',
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url'
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'shop_isle_404_background', array(
		'label'    => '404 '.__( 'Background image', 'shop-isle' ),
		'section'  => 'shop_isle_general_section',
		'priority'    => 11,
	)));

	/* Title */
	$wp_customize->add_setting( 'shop_isle_404_title', array(
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'default' => __( 'Error 404', 'shop-isle'),
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'shop_isle_404_title', array(
		'label'    => '404 '.__( 'Title', 'shop-isle' ),
		'section'  => 'shop_isle_general_section',
		'priority'    => 12,
	));

	/* Text */
	$wp_customize->add_setting( 'shop_isle_404_text', array(
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'default' => __( 'The requested URL was not found on this server.<br> That is all we know.', 'shop-isle'),
		'transport' => 'postMessage'
	));

	$wp_customize->add_control( 'shop_isle_404_text', array(
		'type' 		   => 'textarea',
		'label'    => '404 '.__( 'Text', 'shop-isle' ),
		'section'  => 'shop_isle_general_section',
		'priority'    => 13,
	));

	/* Button link */
	$wp_customize->add_setting( 'shop_isle_404_link', array(
		'sanitize_callback' => 'esc_url',
		'default' => '#',
		'transport' => 'postMessage'
	));

	$wp_customize->add_control( 'shop_isle_404_link', array(
		'label'    => '404 '.__( 'Button link', 'shop-isle' ),
		'section'  => 'shop_isle_general_section',
		'priority'    => 14,
	));

	/* Button label */
	$wp_customize->add_setting( 'shop_isle_404_label', array(
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'default' => __( 'Back to home page', 'shop-isle'),
		'transport' => 'postMessage'
	));

	$wp_customize->add_control( 'shop_isle_404_label', array(
		'label'    => '404 '.__( 'Button label', 'shop-isle' ),
		'section'  => 'shop_isle_general_section',
		'priority'    => 15,
	));


	/*********************************/
	/*********  Theme Info  **********/
	/*********************************/
	$wp_customize->add_section('shop_isle_theme_info', array(
			'title' => __('Theme info', 'shop-isle'),
			'priority' => 0,
		)
	);
	$wp_customize->add_setting('shop_isle_theme_info', array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'shop_isle_sanitize_text'
		)
	);
	$wp_customize->add_control( new ShopIsle_Theme_Info( $wp_customize, 'shop_isle_theme_info', array(
			'section' => 'shop_isle_theme_info',
			'priority' => 10
		) )
	);



	/*********************************/
	/*******  Colors Notice  *********/
	/*********************************/

	$wp_customize->add_setting('shop_isle_color_notice', array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'shop_isle_sanitize_text'
		)
	);
	$wp_customize->add_control( new ShopIsle_Colors_Notice( $wp_customize, 'shop_isle_color_notice', array(
			'section' => 'colors',
			'priority' => 10
		) )
	);
}

/**
 * Check if isn't contact page.
 *
 * @return bool
 */
function shop_isle_is_contact_page() { 
	return is_page_template('template-contact.php');
};

/**
 * Check if isn't contact page.
 *
 * @return bool
 */
function shop_isle_is_not_contact_page() { 
	return !is_page_template('template-contact.php');
};

/**
 * Check if isn't frontpage.
 *
 * @return bool
 */
function shop_isle_is_not_frontpage() {
	return !(is_front_page() && is_page_template('template-frontpage.php'));
};

/**
 * Repeater sanitization.
 *
 * @param $input
 *
 * @return mixed|string|void
 */
function shop_isle_sanitize_repeater($input){
	  
	$input_decoded = json_decode($input,true);
	$allowed_html = array(
								'br' => array(),
								'em' => array(),
								'strong' => array(),
								'a' => array(
									'href' => array(),
									'class' => array(),
									'id' => array(),
									'target' => array()
								),
								'button' => array(
									'class' => array(),
									'id' => array()
								)
							);
	
	
	if(!empty($input_decoded)) {
		foreach ($input_decoded as $boxk => $box ){
			foreach ($box as $key => $value){
				if ($key == 'text'){
					$value = html_entity_decode($value);
					$input_decoded[$boxk][$key] = wp_kses( $value, $allowed_html);
				} else {
					$input_decoded[$boxk][$key] = wp_kses_post( force_balance_tags( $value ) );
				}

			}
		}

		return json_encode($input_decoded);
	}
	
	return $input;
}

function shop_isle_wp_themeisle_customize_preview_js() {
	wp_enqueue_script( 'wp_themeisle_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'shop_isle_wp_themeisle_customize_preview_js' );