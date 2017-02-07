/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description a' ).text( to );
		} );
	} );

	/****************************************/
	/********** Big title section ***********/
	/****************************************/
	wp.customize( 'shop_isle_big_title_hide', function( value ) {
		value.bind( function( to ) {

			if( to != '1' ) {
				$( '.home-section' ).removeClass( 'shop_isle_hidden_if_not_customizer' );
			}
			else {
				$( '.home-section' ).addClass( 'shop_isle_hidden_if_not_customizer' );
			}
			
		} );
	} );

	/******************************/
	/**********  Colors ***********/
	/******************************/

	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			$( '.shop_isle_header_title h1 a' ).css( {
				'color': to
			} );
			$( '.shop_isle_header_title h2 a' ).css( {
				'color': to
			} );
		} );
	} );
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( {
				'background': to
			} );
			if( $( '.front-page-main' ).length > 0 ) { 
				$( '.front-page-main' ).css( {
					'background': to
				} );
			}
		} );
	} );

	/******************************/
	/**********  Header ***********/
	/******************************/
	wp.customize( 'shop_isle_logo', function( value ) {
		value.bind( function( to ) {

			if( to != '' ) {
				$( '.shop_isle_header_title .logo-image' ).removeClass( 'shop_isle_hidden_if_not_customizer' );
				$( '.shop_isle_header_title h1' ).addClass( 'shop_isle_hidden_if_not_customizer' );
				$( '.shop_isle_header_title h2' ).addClass( 'shop_isle_hidden_if_not_customizer' );
			}
			else {
				$( '.shop_isle_header_title .logo-image' ).addClass( 'shop_isle_hidden_if_not_customizer' );
				$( '.shop_isle_header_title h1' ).removeClass( 'shop_isle_hidden_if_not_customizer' );
				$( '.shop_isle_header_title h2' ).removeClass( 'shop_isle_hidden_if_not_customizer' );
			}
			$( '.shop_isle_header_title img' ).attr( 'src', to );

		} );
	} );

	wp.customize( 'shop_isle_blog_header_title', function( value ) {
		value.bind( function( to ) {
			if( to != '' ) {
				$( '.shop-isle-blog-header-title' ).removeClass( 'shop_isle_hidden_if_not_customizer' );
			}
			else {
				$( '.shop-isle-blog-header-title' ).addClass( 'shop_isle_hidden_if_not_customizer' );
			}
			$( '.shop-isle-blog-header-title' ).html( to );
		} );
	} );

	wp.customize( 'shop_isle_blog_header_subtitle', function( value ) {
		value.bind( function( to ) {
			if( to != '' ) {
				$( '.shop-isle-blog-header-subtitle' ).removeClass( 'shop_isle_hidden_if_not_customizer' );
			}
			else {
				$( '.shop-isle-blog-header-subtitle' ).addClass( 'shop_isle_hidden_if_not_customizer' );
			}
			$( '.shop-isle-blog-header-subtitle' ).html( to );
		} );
	} );
	

	/********************************/
    /*********	Banners section *****/
	/********************************/
    wp.customize( 'shop_isle_banners_title', function( value ) {

		value.bind( function( to ) {
			if( to != '' ) {
				$( '.product-banners-title' ).removeClass( 'shop_isle_hidden_if_not_customizer' );
			}
			else {
				$( '.product-banners-title' ).addClass( 'shop_isle_hidden_if_not_customizer' );
			}
			$( '.product-banners-title' ).text( to );
		} );

    } );


	wp.customize( 'shop_isle_banners_hide', function( value ) {
		value.bind( function( to ) {
			if( to != '1' ) {
				$( '.home-banners' ).removeClass( 'shop_isle_hidden_if_not_customizer' );
			}
			else {
				$( '.home-banners' ).addClass( 'shop_isle_hidden_if_not_customizer' );
			}
		} );
	} );

	// Add new banner (Repeater)
	wp.customize( "shop_isle_banners", function( value ) {
		value.bind( function( to ) {
			var obj = JSON.parse( to );
			var result ="";
			obj.forEach(function(item) {
			result += '<div class="col-sm-4"><div class="content-box mt-0 mb-0"><div class="content-box-image"><a href="' + item.link + '"><img src="' + item.image_url + '"></a></div></div></div>';
			});
			$( '.shop_isle_bannerss_section' ).html( result );
		} );
	} );

	/*********************************/
    /*******  Products section *******/
	/********************************/
	wp.customize( 'shop_isle_products_hide', function( value ) {
		value.bind( function( to ) {
			if( to != '1' ) {
				$( '#latest' ).removeClass( 'shop_isle_hidden_if_not_customizer' );
			}
			else {
				$( '#latest' ).addClass( 'shop_isle_hidden_if_not_customizer' );
			}
		} );
	} );
	wp.customize( 'shop_isle_products_title', function( value ) {
		value.bind( function( to ) {
			$( '.product-hide-title' ).text( to );
		} );
	} );

	/****************************************/
	/*********** Video section **************/
	/****************************************/
	wp.customize( 'shop_isle_video_hide', function( value ) {
		value.bind( function( to ) {
			if( to != '1' ) {
				$( '.module-video' ).removeClass( 'shop_isle_hidden_if_not_customizer' );
			}
			else {
				$( '.module-video' ).addClass( 'shop_isle_hidden_if_not_customizer' );
			}
		} );
	} );
	wp.customize( 'shop_isle_video_title', function( value ) {
		value.bind( function( to ) {
			$( '.video-title' ).text( to );
		} );
	} );

	/****************************************/
    /*******  Products slider section *******/
	/****************************************/
	wp.customize( 'shop_isle_products_slider_hide', function( value ) {
		value.bind( function( to ) {
			if( to != '1' ) {
				$( '.home-product-slider' ).removeClass( 'shop_isle_hidden_if_not_customizer' );
			}
			else {
				$( '.home-product-slider' ).addClass( 'shop_isle_hidden_if_not_customizer' );
			}
		} );
	} );
	wp.customize( 'shop_isle_products_slider_single_hide', function( value ) {
		value.bind( function( to ) {
			if( to != '1' ) {
				$( '.module-small-bottom' ).removeClass( 'shop_isle_hidden_if_not_customizer' );
			}
			else {
				$( '.module-small-bottom' ).addClass( 'shop_isle_hidden_if_not_customizer' );
			}
		} );
	} );
	wp.customize( 'shop_isle_products_slider_title', function( value ) {
		value.bind( function( to ) {
			$( '.home-prod-title' ).text( to );
		} );
	} );
	wp.customize( 'shop_isle_products_slider_subtitle', function( value ) {
		value.bind( function( to ) {
			$( '.home-prod-subtitle' ).text( to );
		} );
	} );

	/*******************************/
    /***********  Footer ***********/
	/*******************************/
	wp.customize( 'shop_isle_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.copyright' ).text( to );
		} );
	} );


	/*******************************************/
	/******    Hide site info from footer ******/
	/*******************************************/
	wp.customize( 'shop_isle_site_info_hide', function( value ) {
		value.bind( function( to ) {
			if( to != '1' ) {
				$( '.shop-isle-poweredby-box' ).removeClass( 'shop_isle_hidden_if_not_customizer' );
			}
			else {
				$( '.shop-isle-poweredby-box' ).addClass( 'shop_isle_hidden_if_not_customizer' );
			}
		} );
	} );

	// socials (Repeater)
	wp.customize( "shop_isle_socials", function( value ) {
		value.bind( function( to ) {
			var obj = JSON.parse( to );
			var result ="";
			obj.forEach(function(item) {
				result+=  '<a href="' + item.link + '" class="social-icon"><i class="fa ' + item.icon_value + '"></i></a>';
			});
			$( '.footer-social-links' ).html( result );
		} );
	} );

	/*********************************/
	/******  About us page  **********/
	/*********************************/
	wp.customize( 'shop_isle_our_team_title', function( value ) {
		value.bind( function( to ) {
			$( '.meet-out-team-title' ).text( to );
		} );
	} );
	wp.customize( 'shop_isle_our_team_subtitle', function( value ) {
		value.bind( function( to ) {
			$( '.meet-out-team-subtitle' ).text( to );
		} );
	} );
	wp.customize( 'shop_isle_about_page_video_title', function( value ) {
		value.bind( function( to ) {
			$( '.video-title' ).text( to );
		} );
	} );
	wp.customize( 'shop_isle_about_page_video_subtitle', function( value ) {
		value.bind( function( to ) {
			$( '.video-subtitle' ).text( to );
		} );
	} );
	wp.customize( 'shop_isle_about_page_video_background', function( value ) {
		value.bind( function( to ) {
			$( '.about-page-video' ).css( 'background-image', 'url(' + to + ')' );
		} );
	} );
	wp.customize( 'shop_isle_about_page_video_link', function( value ) {
		value.bind( function( to ) {
			if( to != '' ) {
				$( '.video-box-icon' ).removeClass( 'shop_isle_hidden_if_not_customizer' );
			}
			else {
				$( '.video-box-icon' ).addClass( 'shop_isle_hidden_if_not_customizer' );
			}

		} );
	} );
	wp.customize( 'shop_isle_our_advantages_title', function( value ) {
		value.bind( function( to ) {
			$( '.our_advantages' ).text( to );
		} );
	} );
 
	/*********************************/
	/**********  404 page  ***********/
	/*********************************/
	wp.customize( 'shop_isle_404_background', function( value ) {
		value.bind( function( to ) {
			$( '.error-page-background' ).css( 'background-image', 'url(' + to + ')' );
		} );
	} );
	wp.customize( 'shop_isle_404_title', function( value ) {
		value.bind( function( to ) {
			$( '.error-page-title' ).html( to );
		} );
	} );
	wp.customize( 'shop_isle_404_text', function( value ) {
		value.bind( function( to ) {
			$( '.error-page-text' ).html( to );
		} );
	} );
	wp.customize( 'shop_isle_404_link', function( value ) {
		value.bind( function( to ) {
			$( '.error-page-button-text a' ).attr( 'href', to );
		} );
	} );
	wp.customize( 'shop_isle_404_label', function( value ) {
		value.bind( function( to ) {
			$( '.error-page-button-text a' ).text( to );
		} );
	} );

} )( jQuery );

