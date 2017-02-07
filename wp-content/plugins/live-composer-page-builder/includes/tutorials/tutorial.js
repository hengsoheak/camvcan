/**
 * Used for the tutorial on the sandbox
 */

jQuery(window).load( function(){

	if ( jQuery('#dslc_tut_ch_three').data('post-id') == jQuery('#dslc_tut_settings').data('post-id') ) {			

		if ( jQuery(window).width() > 1650 ) { 
			// nadda
		} else if ( jQuery(window).width() > 1200 ) {
			
			dslc_scroller_next( jQuery('.dslca-modules .dslca-section-scroller') );
			dslc_scroller_next( jQuery('.dslca-modules .dslca-section-scroller') );
		
		} else {
		
			dslc_scroller_next( jQuery('.dslca-modules .dslca-section-scroller') );
			dslc_scroller_next( jQuery('.dslca-modules .dslca-section-scroller') );
			dslc_scroller_next( jQuery('.dslca-modules .dslca-section-scroller') );
		
		}

	}

});

jQuery(document).ready(function($){

	var dslcBubblePosCheck;

	$(document).on('click', '.dslc-tut-proceed-secondary', function(e) {

		e.preventDefault();

		$('.video-modal').fadeIn(500, function(){
			$('.videoThumb[href*="' + $('.video-modal').data('video-id') + '"]').click();
			$('.video-modal').fitVids();
			lc_calc_video_width();
		});

	});

	$(document).on('mousedown', '.dslc-tut-prevent, .dslca-action-disabled, .dslc-tut-panel-prevent', function(e) {
		$('.dslc-tut-bubble:not(:animated)').css({ marginTop : 5 });
		setTimeout( function(){
			$('.dslc-tut-bubble:not(:animated)').css({ marginTop : 10 });
			setTimeout( function(){
				$('.dslc-tut-bubble:not(:animated)').css({ marginTop : 5 });
				setTimeout( function(){
					$('.dslc-tut-bubble:not(:animated)').css({ marginTop : 0 });
				}, 20);
			}, 20);
		}, 20);
	});

	function dslc_tut_keep_up( dslcStep ) {

		dslcBubblePosCheck = setInterval( function(){			

			var dslcBubble, dslcOffset, dslcLeftOffset, dslcTopOffset, dslcArrOffsetLeft, dslcType, dslcAnimation, dslcBubbleHeight, dslcTut, dslcTutIDVar;

			dslcBubble = $('.dslc-tut-bubble');

			if ( $(dslcStep.dslc_target).is(':visible') ) {

				dslcOffset = $(dslcStep.dslc_target).offset();
				dslcLeftOffset = dslcOffset.left + ( $(dslcStep.dslc_target).outerWidth() / 2 - dslcBubble.outerWidth() / 2 )

				/**
				 * Stop from going outside ( left side )
				 */
				if ( dslcLeftOffset < 0 ) {
					dslcArrOffsetLeft = ( dslcBubble.width() / 2 ) + dslcLeftOffset + $(dslcStep.dslc_target).width() / 2 + 15 + 3 + 'px';
					dslcLeftOffset = 15;
				}

				/**
				 * Stop from going outise ( right side )
				 */
				if ( ( dslcBubble.outerWidth() + dslcLeftOffset ) > $(window).width() ) {

					dslcArrOffsetLeft = ( dslcBubble.outerWidth() - $(dslcStep.dslc_target).width() / 2 ) - ( $(window).width() - ( $(dslcStep.dslc_target).offset().left + $(dslcStep.dslc_target).width() ) )  + 'px';
					if ( parseInt( dslcArrOffsetLeft ) > ( dslcBubble.outerWidth() - 20 ) ) { 
						dslcArrOffsetLeft = dslcBubble.outerWidth() - 20 + 'px';
					}
					dslcLeftOffset = $(window).width() - dslcBubble.outerWidth() - 15;

				}

				/**
				 * Position - Action/Information
				 */
				if ( dslcStep.dslc_type == 'action' ) 
					dslcTopOffset = dslcOffset.top - dslcBubble.outerHeight() - 10;
				else
					dslcTopOffset = dslcBubbleOverlay.height() / 2 - dslcBubble.outerHeight() / 2 - 59;

				/**
				 * Offset fix when WP admin bar is active
				 */
				if ( $('#wpadminbar').length ) {
					dslcTopOffset -= $('#wpadminbar').outerHeight();
				}

				/**
				 * Position - Bellow
				 */
				if ( dslcStep[ 'dslc_pos' ] == 'bellow' ) {
					dslcTopOffset += $(dslcStep.dslc_target).outerHeight() + dslcBubble.outerHeight() + 20;
				}

				dslcBubble.stop().css({ top : dslcTopOffset, left : dslcLeftOffset });
				$("head").append($('<style>.dslc-tut-bubble:after, .dslc-tut-bubble:before { left: ' + dslcArrOffsetLeft + ' !important; }</style>'));

			}

		}, 200);

	}

	function dslc_tut_prevent( dslc_event, dslc_allow ) {

		false;

	}

	function dslc_tut_proceed() {

		var dslcBubble, dslcStepID, dslcStep, dslcOffset, dslcLeftOffset, dslcTopOffset, dslcArrOffsetLeft, dslcType, dslcAnimation, dslcBubbleHeight, dslcTut, dslcTutIDVar;

		dslcTut = dslcTuts[$('#dslc_tut_settings').data('post-id')];
		dslcBubble = $('.dslc-tut-bubble');
		dslcBubbleOverlay = $('.dslc-tut-bubble-overlay');
		dslcStepID = dslcBubble.data('step');
		dslcStep = dslcTut[ dslcStepID ];
		dslcType = dslcStep.dslc_type;
		dslcAnimation = dslcStep.dslc_animation;


		/* Function to call on start */

		if ( dslcStep[ 'dslc_func_start' ] !== undefined ) {
			dslcStep[ 'dslc_func_start']();
		}

		/* Position */

		if ( dslcStep[ 'dslc_pos' ] !== undefined ) {
			//nadda
		} else {
			dslcStep[ 'dslc_pos' ] = 'above';
		}

		/* Recalculate */

		if ( dslcStep[ 'dslc_keep_up' ] !== undefined ) {
			//nadda
		} else {
			dslcStep[ 'dslc_keep_up' ] = true;
		}

		if ( parseInt( dslcTut.length ) ==  ( dslcStepID + 0 ) ) {
			dslcBubble.hide();
		}

		if ( dslcStep[ 'dslc_parent_el' ] !== undefined ) {
			//nadda
		} else {
			dslcStep[ 'dslc_parent_el' ] = false;
		}

		// Increment the step
		dslcBubble.data( 'step', dslcStepID + 1 )

		// Add event for proceeding

		$(document).on( dslcStep.dslc_event, dslcStep.dslc_event_el, function(){

			// Remove this event ( no longer needed )
			$(document).off( dslcStep.dslc_event );

			if ( dslcStep[ 'dslc_func_end' ] !== undefined ) {
				dslcStep[ 'dslc_func_end']();
			}

			// Proceed to next step
			dslc_tut_proceed();

		});

		// Position the bubble

		var dslcStepCheck = setInterval( function(){

			if ( $(dslcStep.dslc_target).length 
				&& $(dslcStep.dslc_target).not(':animated') 
				&& ! $(dslcStep.dslc_target).is(':hidden')
				&& $(dslcStep.dslc_target).offset().left <= ( $(window).width() - $(dslcStep.dslc_target).outerWidth() )
				&& $(dslcStep.dslc_event_el).not(':animated') 
				&& ! $( 'body' ).hasClass('dslca-anim-in-progress')
				&& ( $('.dslca-container').length == 0 || $('.dslca-container').css('bottom') == '0px' )
				) {
				
				clearInterval( dslcBubblePosCheck );
				clearInterval( dslcStepCheck );

				// Limit to specific element
				if ( $( dslcStep.dslc_target ).css('position') == 'static' ) {
					$( dslcStep.dslc_target ).css('position', 'relative');
				}

				if ( $( dslcStep.dslc_event_el ).css('position') == 'static' ) {
					$( dslcStep.dslc_event_el ).css('position', 'relative');
				}

				$('.dslc-tut-revert-zindex').each(function(){
					$(this).css( 'z-index', $(this).data('orig-zindex') ).removeClass('dslc-tut-revert-zindex');				
				});

				if ( dslcStep.dslc_target != 'body' ) {
					$( dslcStep.dslc_target ).data('orig-zindex', $( dslcStep.dslc_target ).css('z-index') ).addClass('dslc-tut-revert-zindex').css({ 'z-index' : 9999997 });
				}

				if ( $( dslcStep.dslc_event_el ).hasClass('dslc-tut-revert-zindex') ) {
					// nadda
				} else {
					$( dslcStep.dslc_event_el ).data('orig-zindex', $( dslcStep.dslc_event_el ).css('z-index') ).css({ 'z-index' : 9999997 }).addClass('dslc-tut-revert-zindex');
				}

				if ( $( dslcStep.dslc_parent_el ).hasClass('dslc-tut-revert-zindex') ) {
					// nadda
				} else {
					$( dslcStep.dslc_parent_el ).data('orig-zindex', $( dslcStep.dslc_parent_el ).css('z-index') ).css({ 'z-index' : 9999997 }).addClass('dslc-tut-revert-zindex');
				}

				// Animation
				if ( dslcAnimation == 'fade' )
					dslcBubble.css({ opacity : 0 });

				// Add bubble text
				dslcBubble.html( dslcStep.dslc_label );				

				// Add type class
				dslcBubble.removeClass( 'dslc-tut-bubble-type-action dslc-tut-bubble-type-information' ).addClass( 'dslc-tut-bubble-type-' + dslcType );
				dslcBubble.removeClass( 'dslc-tut-bubble-pos-above dslc-tut-bubble-pos-bellow' ).addClass( 'dslc-tut-bubble-pos-' + dslcStep['dslc_pos'] );

				// If information show overlay
				if ( dslcType == 'information' )
					dslcBubbleOverlay.fadeIn(300);
				else
					dslcBubbleOverlay.fadeOut(200);

				dslcOffset = $(dslcStep.dslc_target).offset();
				dslcLeftOffset = dslcOffset.left + ( $(dslcStep.dslc_target).outerWidth() / 2 - dslcBubble.outerWidth() / 2 )

				var dslcArrOffsetLeft = '50%';

				/**
				 * Stop from going outside ( left side )
				 */
				if ( dslcLeftOffset < 0 ) {
					dslcArrOffsetLeft = ( dslcBubble.width() / 2 ) + dslcLeftOffset + $(dslcStep.dslc_target).width() / 2 + 15 + 3 + 'px';
					dslcLeftOffset = 15;
				}

				/**
				 * Stop from going outise ( right side )
				 */
				if ( ( dslcBubble.outerWidth() + dslcLeftOffset ) > $(window).width() ) {

					dslcArrOffsetLeft = ( dslcBubble.outerWidth() - $(dslcStep.dslc_target).width() / 2 ) - ( $(window).width() - ( $(dslcStep.dslc_target).offset().left + $(dslcStep.dslc_target).width() ) )  + 'px';
					dslcLeftOffset = $(window).width() - dslcBubble.outerWidth() - 15;

				}

				/**
				 * Position - Action/Information
				 */
				if ( dslcType == 'action' ) 
					dslcTopOffset = dslcOffset.top - dslcBubble.outerHeight() - 10;
				else
					dslcTopOffset = dslcBubbleOverlay.height() / 2 - dslcBubble.outerHeight() / 2 - 59;

				/**
				 * Position - Bellow
				 */
				if ( dslcStep[ 'dslc_pos' ] == 'bellow' ) {
					dslcTopOffset += $(dslcStep.dslc_target).outerHeight() + dslcBubble.outerHeight() + 20;
				}

				/**
				 * Animation - Fade/Slide
				 */
				if ( dslcAnimation == 'fade' ) {
					dslcBubble.stop().css({ top : dslcTopOffset + 20, left : dslcLeftOffset }).animate({ top : dslcTopOffset, opacity : 1 }, 400, function(){
						if ( dslcStep[ 'dslc_keep_up' ] && dslcStep['dslc_type'] == 'action' )
							dslc_tut_keep_up( dslcStep );
					});
				} else {
					dslcBubble.stop().css({ opacity : 1 }).animate({ top : dslcTopOffset, left : dslcLeftOffset }, 400, function(){
						if ( dslcStep[ 'dslc_keep_up' ] && dslcStep['dslc_type'] == 'action' )
							dslc_tut_keep_up( dslcStep );
					});
				}

				/**
				 * CSS Arrow
				 */
				$("head").append($('<style>.dslc-tut-bubble:after, .dslc-tut-bubble:before { left: ' + dslcArrOffsetLeft + ' !important; }</style>'));

			}

		}, 300);

	}

	// Add the tut bubble
	jQuery('body').append('<div class="dslc-tut-prevent"></div><div class="dslc-tut-bubble-overlay"></div><div class="dslc-tut-bubble" data-step="0"></div>');
	jQuery('.dslca-container').append('<div class="dslc-tut-panel-prevent"></div>');

	var dslcTutChOne = jQuery('#dslc_tut_ch_one').data('post-id'),
	dslcTutChTwo = jQuery('#dslc_tut_ch_two').data('post-id'),
	dslcTutChThree = jQuery('#dslc_tut_ch_three').data('post-id'),
	dslcTutChFour = jQuery('#dslc_tut_ch_four').data('post-id'),
	dslcTutChTwoLink = jQuery('#dslc_tut_ch_two_link').data('url'),
	dslcTutChThreeLink = jQuery('#dslc_tut_ch_three_link').data('url'),
	dslcTutChFourLink = jQuery('#dslc_tut_ch_four_link').data('url');

	var dslcTuts = [];

	dslcTuts[ dslcTutChOne ] = [
		{
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">Welcome</span>'
			+ '<div class="dslc-tut-bubble-content">'
				+ 'Welcome to the <strong style="color: #06b2ac;">Live Composer</strong> interactive <strong style="color: #9268a9;">tutorial</strong>.<br>'
				+ 'In this step by step guide, we will show you some of the core functionalities of this plugin.<br>'
			+ '</div>'
			+ '<a href="#" class="dslc-tut-proceed">Start <strong>CHAPTER ONE</strong><span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
		},
		{
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">1. Row</span>'
			+ '<span class="dslc-tut-bubble-descr">1/3 Adding a Row</span>'
			+ '<div class="dslc-tut-bubble-content">'
				+ 'Here is the structure of Live Composer: <strong style="color: #e5855f;">Rows</strong> > <strong style="color: #5890e5;">Module Areas</strong> > <strong style="color:#58bce5;">Modules</strong>.<br>Let\'s start by adding a <strong style="color: #e5855f;">row</strong>.</div>'
			+ '<a href="#" class="dslc-tut-proceed">continue<span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade'
		},
		{ /* bubble */
			'dslc_type' : 'action',
			'dslc_label' : 'Create your first <strong style="color: #e5855f;">row</strong>, it will be automatically populated with a <strong style="color: #5890e5;">modules area</strong>.',
			'dslc_target' : '.dslca-add-modules-section-hook',
			'dslc_event_el' : '.dslca-add-modules-section-hook',
			'dslc_event' : 'click.dslc_tut_add_row',
			'dslc_animation' : 'fade',
			'dslc_func_end' : function(){
				$('.dslca-add-modules-section-hook').addClass('dslca-action-disabled');
			}
		},
		{ /* info */
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">1. Row</span><span class="dslc-tut-bubble-descr">2/3 Row Options</span><div class="dslc-tut-bubble-content">Now that you have a <strong style="color: #e5855f;">row</strong> you could start adding <strong style="color: #5890e5;">module areas</strong> and <strong style="color:#58bce5;">modules</strong>.<br>But first, let\'s see what can be done with a <strong style="color: #e5855f;">row</strong>.</div><a href="#" class="dslc-tut-proceed">continue<span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
			'dslc_func_start' : function(){
				
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'When you rollover a <strong style="color: #e5855f;">row</strong> some options show up. Those are : <strong style="color: #06b2ac;">Edit</strong> - <strong style="color: #06b2ac;">Duplicate</strong> - <strong style="color: #06b2ac;">Move</strong> - <strong style="color: #06b2ac;">Delete</strong>. For now, let\'s click on the cog icon to edit this <strong style="color: #e5855f;">row</strong>',
			'dslc_target' : '.dslc-modules-section',
			'dslc_event_el' : '.dslc-modules-section',
			'dslc_event' : 'mouseenter.dslc_tut_add_row',
			'dslc_animation' : 'fade',
			'dslc_pos' : 'bellow',
			'dslc_func_start' : function() {
				$('.dslca-modules-area-manage').css({ 'visibility' : 'hidden' });
				$('.dslca-modules-section-manage .dslca-manage-action').addClass('dslca-action-disabled');
				$('.dslca-edit-modules-section-hook').removeClass('dslca-action-disabled');
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'When you rollover a <strong style="color: #e5855f;">row</strong> some options show up. Those are : <strong style="color: #06b2ac;">Edit</strong> - <strong style="color: #06b2ac;">Duplicate</strong> - <strong style="color: #06b2ac;">Move</strong> - <strong style="color: #06b2ac;">Delete</strong>. For now, let\'s click on the cog icon to edit this <strong style="color: #e5855f;">row</strong>',
			'dslc_target' : '.dslca-edit-modules-section-hook',
			'dslc_event_el' : '.dslca-edit-modules-section-hook',
			'dslc_parent_el' : '.dslc-modules-section',
			'dslc_event' : 'click.dslc_tut_add_row',
			'dslc_animation' : 'slide',
			'dslc_pos' : 'bellow',
			'dslc_func_end' : function(){
				$('.dslca-modules-section-manage .dslca-manage-action').removeClass('dslca-action-disabled');
			}
		},
		{ /* Make the options are visible */
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">1. Row</span><span class="dslc-tut-bubble-descr">3/3 Options Panel</span><div class="dslc-tut-bubble-content">'
			+ 'Every time you want to edit a <strong style="color: #e5855f;">row</strong> or a <strong style="color:#58bce5;">module</strong>, the <strong style="color: #9268a9;">Options Panel</strong> will appear.<br>' 
			+ 'There are multiple options, for now let\'s change the <strong>background color</strong> and the <strong>padding</strong> for this <strong style="color: #e5855f;">row</strong>.'
			+ '</div><a href="#" class="dslc-tut-proceed">continue<span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'First, let\'s change the <strong>background color</strong>, choose any color and <a class="dslc-tut-proceed-2" href="#"><strong>click here to continue</strong></a> once you are done.',
			'dslc_target' : '.dslca-modules-section-edit-option[data-id="bg_color"]',
			'dslc_event_el' : '.dslca-modules-section-edit-option[data-id="bg_color"] .sp-replacer',
			'dslc_event' : 'mouseup.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
			'dslc_parent_el' : '.dslca-container',
			'dslc_func_start' : function(){
				$('.dslc-tut-panel-prevent').show();
				$('.dslca-modules-section-edit-option[data-id="bg_color"]').css( 'z-index', 1000001 );
			},
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'First, let\'s change the <strong>background color</strong>, choose any color and <a class="dslc-tut-proceed-2" href="#"><strong>click here to continue</strong></a> once you are done.',
			'dslc_target' : '.sp-container:visible',
			'dslc_event_el' : '.dslc-tut-proceed-2',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_parent_el' : '.dslca-container',
			'dslc_animation' : 'slide',
			'dslc_func_end' : function(){
				$('.dslc-tut-panel-prevent').hide();
				$('.dslca-container').css( 'z-index', 99999 );
				$('.dslca-modules-section-edit-option[data-id="bg_color"]').css( 'z-index', 'auto' );
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Good, now you will need to <strong style="color: #9268a9;">drag</strong> this scrollbar to the right to access the <strong style="color:#06b2ac;">padding vertical</strong> options.',
			'dslc_target' : '.jspDrag',
			'dslc_event_el' : '.dslca-container',
			'dslc_event' : 'mouseup.dslc_tut_modules_info',
			'dslc_parent_el' : '.dslca-container',
			'dslc_animation' : 'slide',
			'dslc_keep_up' : false,
			'dslc_func_start' : function(){
				$('.dslc-tut-panel-prevent').show();
				$('.jspHorizontalBar').css( 'z-index', 1000001 );
			},
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Go ahead and change this <strong style="color:#06b2ac;">padding value</strong>, this will add space vertically on this whole <strong style="color: #e5855f;">row</strong>.',
			'dslc_target' : '.dslca-modules-section-edit-option[data-id="padding"]',
			'dslc_event_el' : '.dslca-modules-section-edit-option[data-id="padding"]',
			'dslc_parent_el' : '.dslca-container',
			'dslc_event' : 'mouseup.dslc_tut_modules_info',
			'dslc_animation' : 'slide',
			'dslc_func_start' : function(){
				$('.jspHorizontalBar').css( 'z-index', 'auto' );
				$('.dslca-modules-section-edit-option[data-id="padding"]').css( 'z-index', 1000001 );
			},
			'dslc_func_end' : function(){				
				$('.dslca-row-edit-save').css( 'z-index', 1000001 );
			},
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Everytime you are done editing an element, you have to <span style="color: #78ca4f; font-weight:bold;">confirm</span> or <span style="color: #e55f5f; font-weight:bold;">cancel</span> those changes. Let\'s <span style="color: #78ca4f; font-weight:bold;">confirm</span> these changes now.',
			'dslc_target' : '.dslca-row-edit-save',
			'dslc_event_el' : '.dslca-row-edit-save',
			'dslc_parent_el' : '.dslca-container',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
			'dslc_func_start' : function(){
			
			},
		},
		{
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">1. Row</span><span class="dslc-tut-bubble-descr">finished</span><div class="dslc-tut-bubble-content">'
			+ 'Congratulations on completing the first chapter of this <strong style="color: #9268a9;">tutorial</strong>.<br>' 
			+ 'Now that you know how to change options for a <strong style="color: #e5855f;">row</strong>, let\'s see what can be done with <strong style="color: #5890e5;">modules area</strong>.'
			+ '</div>'
			+ '<a href="' + dslcTutChTwoLink + '" class="dslc-tut-proceed dslca-link">start chapter two<span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
			'dslc_func_start' : function(){
				$('.dslc-tut-panel-prevent').hide();
				$('.dslca-module-edit-save').css( 'z-index', 'auto' );
			},
		},

	];

	dslcTuts[ dslcTutChTwo ] = [

		{
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">2. Modules Area</span>'
			+ '<span class="dslc-tut-bubble-descr">1/5 Column System</span>'
			+ '<div class="dslc-tut-bubble-content">'
				+ 'In this chapter, we will show you how to work with <strong style="color: #5890e5;">module areas</strong>.'
				+ '<br>First thing, let\'s see how you can build your own <strong style="color: #06b2ac;">layout</strong>.'
			+ '</div>'
			+ '<a href="#" class="dslc-tut-proceed">continue<span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
			'dslc_func_start' : function(){
				$('.dslca-modules-section-manage').css({ 'visibility' : 'hidden' });
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'When you rollover a <strong style="color: #5890e5;">modules area</strong> some options show up. Those are : <strong style="color: #06b2ac;">Duplicate</strong> - <strong style="color: #06b2ac;">Move</strong> - <strong style="color: #06b2ac;">Layout</strong> - <strong style="color: #06b2ac;">Delete</strong>.<br>For now, let\'s click on the <strong>layout icon</strong> to change the width of this <strong style="color: #5890e5;">modules area</strong>.',
			'dslc_target' : '.dslc-modules-area',
			'dslc_event_el' : '.dslc-modules-area',
			'dslc_event' : 'mouseenter.dslc_tut_add_row',
			'dslc_animation' : 'fade',
			'dslc_pos' : 'above'
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'When you rollover a <strong style="color: #5890e5;">modules area</strong> some options show up. Those are : <strong style="color: #06b2ac;">Duplicate</strong> - <strong style="color: #06b2ac;">Move</strong> - <strong style="color: #06b2ac;">Layout</strong> - <strong style="color: #06b2ac;">Delete</strong>.<br>For now, let\'s click on the <strong>layout icon</strong> to change the width of this <strong style="color: #5890e5;">modules area</strong>.',
			'dslc_target' : '.dslca-change-width-modules-area-hook .dslc-icon-columns',
			'dslc_event_el' : '.dslca-change-width-modules-area-hook',
			'dslc_event' : 'click.dslc_tut_add_row',
			'dslc_parent_el' : '.dslc-modules-area',
			'dslc_animation' : 'slide',
			'dslc_pos' : 'above',
			'dslc_func_start' : function(){
				$('.dslca-modules-area-manage').addClass('dslc-tut-force-show');
				$('.dslca-delete-modules-area-hook, .dslca-move-modules-area-hook, .dslca-copy-modules-area-hook').addClass('dslca-action-disabled');
			},
			'dslc_func_end' : function(){
				
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Click on this <strong>6/12</strong> layout option.',
			'dslc_target' : '.dslca-change-width-modules-area-options span[data-size="6"]',
			'dslc_event_el' : '.dslca-change-width-modules-area-options span[data-size="6"]',
			'dslc_event' : 'click.dslc_tut_add_row',
			'dslc_parent_el' : '.dslc-modules-section',
			'dslc_animation' : 'fade',
			'dslc_pos' : 'bellow',
			'dslc_func_start' : function(){
				$('.dslca-change-width-modules-area-options span, .dslca-change-width-modules-area-hook').addClass('dslca-action-disabled');
				$('.dslca-change-width-modules-area-options span[data-size="6"]').removeClass('dslca-action-disabled');
			}, 
			'dslc_func_end' : function(){
				$('.dslca-change-width-modules-area-options span, .dslca-change-width-modules-area-hook').removeClass('dslca-action-disabled');
				$('.dslca-delete-modules-area-hook, .dslca-move-modules-area-hook, .dslca-copy-modules-area-hook').removeClass('dslca-action-disabled');
			}
		},
		{
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">2. Modules Area</span>'
			+ '<span class="dslc-tut-bubble-descr">2/5 Duplicating</span>'
			+ '<div class="dslc-tut-bubble-content">'
				+ 'Now that you\'ve changed the <strong>layout</strong> of the <strong style="color: #5890e5;">modules area</strong>, let\'s <strong style="color:#06b2ac;">duplicate</strong> it.'
			+ '</div>'
			+ '<a href="#" class="dslc-tut-proceed">continue<span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
			'dslc_func_start' : function(){
				$('.dslca-modules-area-manage').removeClass('dslc-tut-force-show');
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : '<strong style="color: #9268a9;">Rollover</strong> the <strong style="color: #5890e5;">modules area</strong> to make the options appear.',
			'dslc_target' : '.dslc-modules-area',
			'dslc_event_el' : '.dslc-modules-area',
			'dslc_event' : 'mouseenter.dslc_tut_add_row',
			'dslc_parent_el' : '.dslc-modules-area',
			'dslc_animation' : 'fade',
			'dslc_pos' : 'above'
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Now click on the <strong style="color:#06b2ac;">duplicate</strong> icon.',
			'dslc_target' : '.dslca-copy-modules-area-hook',
			'dslc_event_el' : '.dslca-copy-modules-area-hook',
			'dslc_event' : 'click.dslc_tut_add_row',
			'dslc_parent_el' : '.dslc-modules-area',
			'dslc_animation' : 'slide',
			'dslc_pos' : 'bellow',
			'dslc_func_start' : function(){
				$('.dslca-modules-area-manage').addClass('dslc-tut-force-show');
			},
			'dslc_func_end' : function(){
				$('.dslca-copy-modules-area-hook').addClass('dslca-action-disabled');	
			}
		},
		{
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">2. Modules Area</span>'
			+ '<span class="dslc-tut-bubble-descr">3/5 Adding Area</span>'
			+ '<div class="dslc-tut-bubble-content">'
				+ 'It\'s time to add a new <strong style="color: #5890e5;">modules area</strong>.'
				+ '<br>Below are the available <strong style="color:#58bce5;">modules</strong>. For now, let\'s add a new <strong style="color: #5890e5;">modules area</strong>.'
			+ '</div>'
			+ '<a href="#" class="dslc-tut-proceed">continue<span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
			'dslc_func_start' : function(){
				$('.dslca-modules-area-manage').removeClass('dslc-tut-force-show');
				$('.dslc-modules-area').css( 'z-index', 'auto' );
				$('.dslca-copy-modules-area-hook').removeClass('dslca-action-disabled');	
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : '<strong style="color: #06b2ac;">Click &amp; Drag</strong> this item and release it over the <strong style="color: #e5855f;">row</strong>.',
			'dslc_target' : '.dslca-module[data-id="DSLC_M_A"]',
			'dslc_event_el' : '.dslca-module[data-id="DSLC_M_A"]',
			'dslc_event' : 'mousedown.dslc_tut_add_row',
			'dslc_parent_el' : '.dslca-container',
			'dslc_animation' : 'fade',
			'dslc_pos' : 'above',
			'dslc_func_start' : function(){
				$('.dslc-tut-panel-prevent').show();
				$('.dslca-module[data-id="DSLC_M_A"]').css( 'z-index', 1000001 );
			},
			'dslc_func_end' : function(){
				$('.dslc-tut-panel-prevent').hide();
				$('.dslca-container').css( 'z-index', 99999 );
				$('.dslca-module[data-id="DSLC_M_A"]').css( 'z-index', 'auto' );
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : '<strong style="color: #06b2ac;">Click &amp; Drag</strong> this item and release it over the <strong style="color: #e5855f;">row</strong>.',
			'dslc_target' : '.dslc-modules-section',
			'dslc_event_el' : $(document),
			'dslc_event' : 'mouseup.dslc_tut_add_row',
			'dslc_animation' : 'slide',
			'dslc_pos' : 'bellow',
			'dslc_func_end' : function(){
				if ( $('body').hasClass('dslca-anim-in-progress') ) {
					// nadda
				} else {
					$('.dslc-tut-bubble').data('step', 8);
				}
			}
		},
		{
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">2. Modules Area</span>'
			+ '<span class="dslc-tut-bubble-descr">4/5 Reordering</span>'
			+ '<div class="dslc-tut-bubble-content">'
				+ '<strong style="color: #5890e5;">Modules areas</strong>, like <strong style="color: #e5855f;">rows</strong>, can be <strong style="color: #9268a9;">moved</strong>. Let\'s <strong style="color: #9268a9;">move</strong> the <strong style="color: #5890e5;">modules area</strong> you just created.'
			+ '</div>'
			+ '<a href="#" class="dslc-tut-proceed">continue<span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : '<strong style="color: #9268a9;">Rollover</strong> the <strong style="color: #5890e5;">modules area</strong> to make the options appear.',
			'dslc_target' : '.dslc-modules-area.dslc-12-col',
			'dslc_event_el' : '.dslc-modules-area.dslc-12-col',
			'dslc_event' : 'mouseenter.dslc_tut_add_row',
			'dslc_parent_el' : '.dslc-modules-area.dslc-12-col',
			'dslc_animation' : 'fade',
			'dslc_pos' : 'above'
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Now <strong style="color: #06b2ac;">Click &amp; Drag</strong> the move icon to move the <strong style="color: #5890e5;">modules area</strong> on top of the 2 others.',
			'dslc_target' : '.dslc-modules-area.dslc-12-col .dslca-move-modules-area-hook',
			'dslc_event_el' : '.dslc-modules-area.dslc-12-col .dslca-move-modules-area-hook',
			'dslc_event' : 'mousedown.dslc_tut_add_row',
			'dslc_parent_el' : '.dslc-modules-area.dslc-12-col',
			'dslc_animation' : 'slide',
			'dslc_pos' : 'bellow',
			'dslc_func_start' : function(){
				$('.dslc-modules-area.dslc-12-col .dslca-modules-area-manage').addClass('dslc-tut-force-show');
				$('.dslc-modules-area.dslc-12-col .dslca-copy-modules-area-hook').addClass('dslca-action-disabled');
			},
			'dslc_func_end' : function(){
				$('.dslc-modules-area.dslc-12-col .dslca-copy-modules-area-hook').removeClass('dslca-action-disabled');
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Now <strong style="color: #06b2ac;">Click &amp; Drag</strong> the move icon to move the <strong style="color: #5890e5;">modules area</strong> on top of the 2 others.',
			'dslc_target' : '.dslc-modules-section',
			'dslc_event_el' : $(document),
			'dslc_event' : 'mouseup.dslc_tut_add_row',
			'dslc_parent_el' : '.dslc-modules-area',
			'dslc_animation' : 'slide',
			'dslc_pos' : 'above',
			'dslc_func_end' : function(){
				if ( $('.dslc-modules-area:first-child').hasClass('dslc-12-col') ) {
					// nadda
				} else {
					$('.dslc-tut-bubble').data('step', 12);
				}
			}
		},
		{
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">2. Modules Area</span>'
			+ '<span class="dslc-tut-bubble-descr">5/5 Deleting</span>'
			+ '<div class="dslc-tut-bubble-content">'
				+ 'The last thing that you can do with <strong style="color: #5890e5;">modules areas</strong> is to <strong style="color: #e55f5f;">delete</strong> them.'
			+ '</div>'
			+ '<a href="#" class="dslc-tut-proceed">continue<span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
			'dslc_func_start' : function(){
				$('.dslc-modules-area.dslc-12-col .dslca-modules-area-manage').removeClass('dslc-tut-force-show');
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : '<strong style="color: #9268a9;">Rollover</strong> the <strong style="color: #5890e5;">modules area</strong> to make the options appear.',
			'dslc_target' : '.dslc-modules-area.dslc-12-col',
			'dslc_event_el' : '.dslc-modules-area.dslc-12-col',
			'dslc_event' : 'mouseenter.dslc_tut_add_row',
			'dslc_parent_el' : '.dslc-modules-area',
			'dslc_animation' : 'fade',
			'dslc_pos' : 'above',
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Now click the <strong style="color: #e55f5f;">delete</strong> icon to delete the <strong style="color: #5890e5;">modules area</strong>.',
			'dslc_target' : '.dslc-modules-area.dslc-12-col .dslca-delete-modules-area-hook',
			'dslc_event_el' : '.dslc-modules-area.dslc-12-col .dslca-delete-modules-area-hook',
			'dslc_event' : 'click.dslc_tut_add_row',
			'dslc_parent_el' : '.dslc-modules-area.dslc-12-col',
			'dslc_animation' : 'slide',
			'dslc_pos' : 'bellow',
			'dslc_func_start' : function(){
				$('.dslc-modules-area.dslc-12-col .dslca-modules-area-manage').addClass('dslc-tut-force-show');
				$('.dslca-copy-modules-area-hook, .dslca-move-modules-area-hook, .dslca-change-width-modules-area-hook').addClass('dslca-action-disabled');
			},
			'dslc_func_end' : function(){
				$('.dslca-copy-modules-area-hook, .dslca-move-modules-area-hook, .dslca-change-width-modules-area-hook').removeClass('dslca-action-disabled');
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Click <strong>CONFIRM</strong> to confirm the deletion of the modules area..',
			'dslc_target' : '.dslca-prompt-modal-confirm-hook',
			'dslc_event_el' : '.dslca-prompt-modal-confirm-hook',
			'dslc_event' : 'click.dslc_tut_add_row',
			'dslc_parent_el' : '.dslca-prompt-modal',
			'dslc_animation' : 'slide',
			'dslc_pos' : 'bellow',
			'dslc_func_start' : function(){
				
			},
			'dslc_func_end' : function(){
				
			}
		},
		{
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">2. Modules Area</span>'
			+ '<span class="dslc-tut-bubble-descr">finished</span>'
			+ '<div class="dslc-tut-bubble-content">'
				+ 'Congrats on completing <strong>Chapter Two</strong> of this interactive <strong style="color: #9268a9;">tutorial</strong>.'
				+ '<br>Now that you know everything about <strong style="color: #e5855f;">rows</strong> and <strong style="color: #5890e5;">modules areas</strong>, it\'s time for you to learn how to use <strong style="color:#58bce5;">modules</strong>.'
			+ '</div>'
			+ '<a href="' + dslcTutChThreeLink + '" class="dslc-tut-proceed dslca-link">start chapter Three<span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
			'dslc_func_start' : function(){
				$('.dslc-modules-area.dslc-12-col .dslca-modules-area-manage').removeClass('dslc-tut-force-show');
			}
		},

	];

	dslcTuts[ dslcTutChThree ] = [

		{
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">3. Modules</span>'
			+ '<span class="dslc-tut-bubble-descr">1/3 Adding modules</span>'
			+ '<div class="dslc-tut-bubble-content">'
				+ 'In this chapter, we will show you how to use <strong style="color:#58bce5;">modules</strong>.'
				+ '<br>These are the most important part of the <strong style="color: #06b2ac;">Live Composer</strong> and they will allow you to display your content.'
				+ '<br>To start, let\'s add a <strong style="color:#58bce5;">module</strong>.'
			+ '</div>'
			+ '<a href="#" class="dslc-tut-proceed">continue<span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade'
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : '<strong style="color: #06b2ac;">Click &amp; Drag</strong> this item and release it over the <strong style="color: #5890e5;">modules area</strong>.',
			'dslc_target' : '.dslca-module[data-id="DSLC_Blog"]',
			'dslc_event_el' : '.dslca-module[data-id="DSLC_Blog"]',
			'dslc_event' : 'mousedown.dslc_tut_add_row',
			'dslc_parent_el' : '.dslca-container',
			'dslc_animation' : 'fade',
			'dslc_pos' : 'above',
			'dslc_func_start' : function(){
				$('.dslc-tut-panel-prevent').show();
				$('.dslca-module[data-id="DSLC_Blog"]').css( 'z-index', 1000001 );
			},
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : '<strong style="color: #06b2ac;">Click &amp; Drag</strong> this item and release it over the <strong style="color: #5890e5;">modules area</strong>.',
			'dslc_target' : '.dslc-modules-area',
			'dslc_event_el' : $(document),
			'dslc_event' : 'mouseup.dslc_tut_add_row',
			'dslc_animation' : 'slide',
			'dslc_pos' : 'above',
			'dslc_func_end' : function(){
				$('.dslc-tut-panel-prevent').hide();
				$('.dslca-module[data-id="DSLC_Blog"]').css( 'z-index', 'auto' );
				if ( $('body').hasClass('dslca-anim-in-progress') ) {
					// nadda
				} else {
					$('.dslc-tut-bubble').data('step', 1);
				}
			}
		},
		{
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">3. Modules</span>'
			+ '<div class="dslc-tut-bubble-content">'
				+ 'Some modules will take the content that you created in the WordPress admin.'
				+ '<br>This is the case for the <strong style="color:#58bce5;">blog module</strong>, it retreives the blog post that you have created.'
			+ '</div>'
			+ '<a href="#" class="dslc-tut-proceed">continue<span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade'
		},
		{
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">3. Modules</span>'
			+ '<span class="dslc-tut-bubble-descr">2/3 Functionality</span>'
			+ '<div class="dslc-tut-bubble-content">'
				+ 'Every module has it\'s own set of options. There are <strong style="color: #9268a9;">Functionality</strong> and <strong style="color: #06b2ac;">Styling</strong> options.'
				+ '<br>For now let\'s take a look at the <strong style="color: #9268a9;">Functionality</strong> options for the <strong style="color:#58bce5;">blog module</strong>.'
			+ '</div>'
			+ '<a href="#" class="dslc-tut-proceed">continue<span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade'
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : '<strong style="color: #9268a9;">Rollover</strong> the <strong style="color: #58bce5;">module</strong> to make the options appear and click on the <strong style="color:#06b2ac;">edit</strong> icon.',
			'dslc_target' : '.dslca-module-edit-hook',
			'dslc_event_el' : '.dslca-module-edit-hook',
			'dslc_event' : 'click.dslc_tut_add_row',
			'dslc_parent_el' : '.dslc-module-front',
			'dslc_animation' : 'slide',
			'dslc_pos' : 'above',
			'dslc_func_start' : function(){
				$('.dslc-module-front').trigger('mouseenter');
				$('.dslca-copy-module-hook, .dslca-move-module-hook, .dslca-delete-module-hook').addClass('dslca-action-disabled');
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Go ahead and change the <strong style="color:#06b2ac;">posts per row</strong> to <strong>2</strong>.',
			'dslc_target' : '.dslca-module-edit-option[data-id="columns"]',
			'dslc_event_el' : '.dslca-module-edit-option[data-id="columns"]',
			'dslc_event' : 'change.dslc_tut_modules_info',
			'dslc_parent_el' : '.dslca-container',
			'dslc_animation' : 'fade',
			'dslc_pos' : 'above',
			'dslc_func_start' : function(){
				$('.dslca-copy-module-hook, .dslca-move-module-hook, .dslca-delete-module-hook').removeClass('dslca-action-disabled');
				$('.dslc-tut-panel-prevent').show();
				$('.dslca-module-edit-option[data-id="columns"]').css( 'z-index', 1000001 );
			},
			'dslc_func_end' : function(){
				if ( $('.dslca-module-edit-field[data-id="columns"]').val() != 6 ) {
					$('.dslc-tut-bubble').data('step', 6);
				}
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'You can test any other option in this panel, once you are done <a class="dslc-tut-proceed-2" href="#"><strong>click here to continue</strong></a>.',
			'dslc_target' : '.dslca-module-edit-options',
			'dslc_event_el' : '.dslc-tut-proceed-2',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_parent_el' : '.dslca-container',
			'dslc_animation' : 'slide',
			'dslc_pos' : 'above',
			'dslc_func_start' : function(){
				$('.dslca-module-edit-option[data-id="columns"]').css( 'z-index', 'auto' );
				$('.dslca-module-edit-options-wrapper').css( 'z-index', 1000001 );
			}
		},
		{
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">3. Modules</span>'
			+ '<span class="dslc-tut-bubble-descr">3/3 Styling</span>'
			+ '<div class="dslc-tut-bubble-content">'
				+ 'There are also a lot of <strong style="color: #06b2ac;">styling</strong> options that you can change for every <strong style="color: #58bce5;">module</strong>, let\'s change a few now.'
			+ '</div>'
			+ '<a href="#" class="dslc-tut-proceed">continue<span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_parent_el' : '.dslca-container',
			'dslc_animation' : 'fade',
			'dslc_func_start' : function(){
				$('.dslca-module-edit-options-wrapper').css( 'z-index', 'auto' );
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Click on the <strong style="color: #06b2ac;">styling</strong> tab to show the <strong style="color: #06b2ac;">styling</strong> options.',
			'dslc_target' : '.dslca-options-filter-hook[data-section="styling"]',
			'dslc_event_el' : '.dslca-options-filter-hook[data-section="styling"]',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
			'dslc_parent_el' : '.dslca-container',
			'dslc_pos' : 'above',
			'dslc_func_start' : function(){
				$('.dslca-options-filter-hook[data-section="styling"]').css( 'z-index', 1000001 );
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'All the options are categorized by the element they affect. Click on any of the tabs to change the options available.',
			'dslc_target' : '.dslca-module-edit-options-tab-hook:nth-child(4)',
			'dslc_event_el' : '.dslca-module-edit-options-tab-hook',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
			'dslc_parent_el' : '.dslca-container',
			'dslc_pos' : 'above',
			'dslc_func_start' : function(){
				$('.dslca-options-filter-hook[data-section="styling"]').css( 'z-index', 'auto' );
				$('.dslca-module-edit-options-tab-hook').css( 'z-index', 1000001 );
			},
			'dslc_func_end' : function(){
				$('.dslca-module-edit-options-tab-hook').css( 'z-index', 'auto !important' );
				$('.dslca-module-edit-options-wrapper').css( 'z-index', '1000001 !important' );
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'There is a lot of <strong style="color: #06b2ac;">styling</strong> options. Go ahead and play with them and once you are done click on <span style="color: #78ca4f; font-weight:bold;">confirm</span>.',
			'dslc_target' : '.dslca-module-edit-save',
			'dslc_event_el' : '.dslca-module-edit-save',
			'dslc_event' : 'click.dslc_tut_modules_info_2',
			'dslc_animation' : 'slide',
			'dslc_parent_el' : '.dslca-container',
			'dslc_pos' : 'above',
			'dslc_func_start' : function(){
				$('.dslca-module-edit-options').css( 'z-index', 1000001 );
			}
		},
		{
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">3. Modules</span>'
			+ '<span class="dslc-tut-bubble-descr">finished</span>'
			+ '<div class="dslc-tut-bubble-content">'
				+ 'Congrats on completing <strong>Chapter Three</strong> of this interactive <strong style="color: #9268a9;">tutorial</strong>.'
				+ '<br>You can proceed to the fourth chapter, there you will learn how to use the <strong style="color: #d8827d;">templates system</strong>.'
			+ '</div>'
			+ '<a href="' + dslcTutChFourLink + '" class="dslc-tut-proceed dslca-link">start chapter four<span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
			'dslc_func_start' : function() {
				$('.dslc-tut-panel-prevent').hide();
				$('.dslca-module-edit-options-wrapper').css( 'z-index', 'auto' );
			}
		}

	];

	dslcTuts[ dslcTutChFour ] = [

		{
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">4. Templates System</span>'
			+ '<span class="dslc-tut-bubble-descr">1/2 Load</span>'
			+ '<div class="dslc-tut-bubble-content">'
				+ 'In this chapter, we will show you how to use the <strong style="color: #d8827d;">templates system</strong>.'
				+ '<br>The <strong style="color: #d8827d;">templates system</strong> consists of 4 main features: <strong>Save</strong>, <strong>Load</strong>, <strong>Export</strong> and <strong>Import</strong>.'
				+ '<br>Let\'s start of by <strong>loading</strong> an existing template.'
			+ '</div>'
			+ '<a href="#" class="dslc-tut-proceed">continue<span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
			'dslc_func_start' : function(){
				$('.dslca-section-title-filter-options a[data-origin="user"]').trigger('click');
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Click this tab to switch to the <strong style="color: #d8827d;">templates management</strong>.',
			'dslc_target' : '.dslca-go-to-section-templates',
			'dslc_event_el' : '.dslca-go-to-section-templates',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
			'dslc_parent_el' : '.dslca-container',
			'dslc_pos' : 'above',
			'dslc_func_start' : function() {
				$('.dslc-tut-panel-prevent').show();	
				
			},
			'dslc_func_end' : function() {
				
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Click <strong>Load</strong> to see the available <strong>templates</strong>.',
			'dslc_target' : '.dslca-go-to-section-hook[data-section=".dslca-templates-load"]',
			'dslc_event_el' : '.dslca-go-to-section-hook[data-section=".dslca-templates-load"]',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
			'dslc_parent_el' : '.dslca-container',
			'dslc_pos' : 'above',
			'dslc_func_start' : function() {
				//$('.dslca-go-to-section-hook[data-section=".dslca-templates-load"]').css( 'z-index', 1000001 );
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Click <strong>Blog Variation 3</strong> to load the <strong>template</strong>.',
			'dslc_target' : '.dslca-template[data-id="dslc-blog-ex-3"]',
			'dslc_event_el' : '.dslca-template[data-id="dslc-blog-ex-3"]',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
			'dslc_parent_el' : '.dslca-container',
			'dslc_pos' : 'above',
			'dslc_func_start' : function() {
				//$('.dslca-go-to-section-hook[data-section=".dslca-templates-load"]').css( 'z-index', 'auto' );
				//$('.dslca-template[data-id="chapter-four"]').css( 'z-index', 1000001 );
			}
		},
		{
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">4. Templates System</span>'
			+ '<div class="dslc-tut-bubble-content">'
				+ 'The <strong>template</strong> is now loaded. You can of course modify it as you wish.'
				+ '<br>Let\'s move the <strong>sidebar</strong> on the right of the <strong>blog</strong>.'
			+ '</div>'
			+ '<a href="#" class="dslc-tut-proceed">continue<span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade',
			'dslc_func_start' : function() {
				$('.dslc-tut-panel-prevent').hide();	
				$('.dslca-template[data-id="chapter-four"]').css( 'z-index', 'auto' );
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Let\'s move this <strong style="color: #5890e5;">modules area</strong> on the right of the blog.',
			'dslc_target' : '.dslc-modules-area.dslc-4-col',
			'dslc_event_el' : '.dslc-modules-area.dslc-4-col',
			'dslc_event' : 'mouseenter.dslc_tut_modules_info',
			'dslc_parent_el' : '.dslc-modules-area.dslc-4-col',
			'dslc_animation' : 'fade',
			'dslc_pos' : 'above',
			'dslc_func_start' : function() {
				$('.dslca-change-width-modules-area-hook, .dslca-delete-modules-area-hook, .dslca-copy-modules-area-hook').addClass('dslca-action-disabled');
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Let\'s move this <strong style="color: #5890e5;">modules area</strong> on the right of the blog.',
			'dslc_target' : '.dslc-modules-area.dslc-4-col .dslca-move-modules-area-hook',
			'dslc_event_el' : '.dslc-modules-area.dslc-4-col .dslca-move-modules-area-hook',
			'dslc_event' : 'mousedown.dslc_tut_modules_info',
			'dslc_parent_el' : '.dslc-modules-area.dslc-4-col',
			'dslc_animation' : 'slide',
			'dslc_pos' : 'above',
			'dslc_func_start' : function() {
				
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Drop the <strong style="color: #5890e5;">modules area</strong> bellow.',
			'dslc_target' : '.dslc-post.dslc-last-col',
			'dslc_event_el' : $(document),
			'dslc_event' : 'mouseup.dslc_tut_modules_info',
			'dslc_parent_el' : '.dslc-modules-area.dslc-4-col',
			'dslc_animation' : 'slide',
			'dslc_pos' : 'above',
			'dslc_keep_up' : false,
			'dslc_func_start' : function(){
				$('.dslca-change-width-modules-area-hook, .dslca-delete-modules-area-hook, .dslca-copy-modules-area-hook').removeClass('dslca-action-disabled');
			}
		},
		{
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">4. Templates System</span>'
			+ '<span class="dslc-tut-bubble-descr">2/2 Import</span>'
			+ '<div class="dslc-tut-bubble-content">'
				+ 'In the textarea bellow, you can see how an export looks like, let\'s import it. Select the "text" and copy it, when done click continue.<br>'
				+ '<br><textarea style="width: 100%; height:50px;">'
				+ '[dslc_modules_section type="wrapped" border_color="" border_width="0" border_style="" border="" bg_color="#f7f7f7" bg_image="" bg_video="" bg_video_overlay_color="" bg_video_overlay_opacity="" bg_image_repeat="no-repeat" bg_image_attachment="parallax" bg_image_position="center bottom" padding="49" padding_h="0" ] [dslc_modules_area last="yes" size="12"] [dslc_module]YToxNTc6e3M6NDoic2l6ZSI7czoyOiIxMiI7czo0OiJ0eXBlIjtzOjQ6ImdyaWQiO3M6MTE6Im9yaWVudGF0aW9uIjtzOjg6InZlcnRpY2FsIjtzOjY6ImFtb3VudCI7czoxOiI2IjtzOjE1OiJwYWdpbmF0aW9uX3R5cGUiO3M6ODoibnVtYmVyZWQiO3M6NzoiY29sdW1ucyI7czoxOiI0IjtzOjEwOiJjYXRlZ29yaWVzIjtzOjA6IiI7czo3OiJvcmRlcmJ5IjtzOjQ6ImRhdGUiO3M6NToib3JkZXIiO3M6NDoiREVTQyI7czo4OiJlbGVtZW50cyI7czoyMToibWFpbl9oZWFkaW5nIGZpbHRlcnMgIjtzOjEzOiJwb3N0X2VsZW1lbnRzIjtzOjMxOiJ0aHVtYm5haWwgdGl0bGUgZXhjZXJwdCBidXR0b24gIjtzOjE3OiJjYXJvdXNlbF9lbGVtZW50cyI7czoxNDoiYXJyb3dzIGNpcmNsZXMiO3M6MjA6ImNzc193cmFwcGVyX2JnX2NvbG9yIjtzOjA6IiI7czoyNDoiY3NzX3dyYXBwZXJfYm9yZGVyX2NvbG9yIjtzOjA6IiI7czoyNDoiY3NzX3dyYXBwZXJfYm9yZGVyX3dpZHRoIjtzOjE6IjAiO3M6MjM6ImNzc193cmFwcGVyX2JvcmRlcl90cmJsIjtzOjIxOiJ0b3AgcmlnaHQgYm90dG9tIGxlZnQiO3M6Mjk6ImNzc193cmFwcGVyX2JvcmRlcl9yYWRpdXNfdG9wIjtzOjE6IjAiO3M6MzI6ImNzc193cmFwcGVyX2JvcmRlcl9yYWRpdXNfYm90dG9tIjtzOjE6IjAiO3M6Mjg6ImNzc193cmFwcGVyX3BhZGRpbmdfdmVydGljYWwiO3M6MToiMCI7czozMDoiY3NzX3dyYXBwZXJfcGFkZGluZ19ob3Jpem9udGFsIjtzOjE6IjAiO3M6MjA6ImNzc19zZXBfYm9yZGVyX2NvbG9yIjtzOjc6IiNlZGVkZWQiO3M6MTQ6ImNzc19zZXBfaGVpZ2h0IjtzOjI6IjMwIjtzOjEzOiJjc3Nfc2VwX3N0eWxlIjtzOjU6InNvbGlkIjtzOjE4OiJjc3NfdGh1bWJfYmdfY29sb3IiO3M6MDoiIjtzOjI3OiJjc3NfdGh1bWJfYm9yZGVyX3JhZGl1c190b3AiO3M6MToiMCI7czozMDoiY3NzX3RodW1iX2JvcmRlcl9yYWRpdXNfYm90dG9tIjtzOjE6IjAiO3M6MTI6InRodW1iX21hcmdpbiI7czoxOiIwIjtzOjE4OiJ0aHVtYl9tYXJnaW5fcmlnaHQiO3M6MjoiMjAiO3M6MjY6ImNzc190aHVtYl9wYWRkaW5nX3ZlcnRpY2FsIjtzOjE6IjAiO3M6Mjg6ImNzc190aHVtYl9wYWRkaW5nX2hvcml6b250YWwiO3M6MToiMCI7czoxMToidGh1bWJfd2lkdGgiO3M6MzoiMTAwIjtzOjE3OiJjc3NfbWFpbl9iZ19jb2xvciI7czo3OiIjZTM2MzRkIjtzOjIxOiJjc3NfbWFpbl9ib3JkZXJfY29sb3IiO3M6MDoiIjtzOjIxOiJjc3NfbWFpbl9ib3JkZXJfd2lkdGgiO3M6MToiMCI7czoyMDoiY3NzX21haW5fYm9yZGVyX3RyYmwiO3M6MjI6InRvcCByaWdodCBib3R0b20gbGVmdCAiO3M6MjY6ImNzc19tYWluX2JvcmRlcl9yYWRpdXNfdG9wIjtzOjE6IjAiO3M6Mjk6ImNzc19tYWluX2JvcmRlcl9yYWRpdXNfYm90dG9tIjtzOjE6IjAiO3M6MjU6ImNzc19tYWluX3BhZGRpbmdfdmVydGljYWwiO3M6MjoiMzQiO3M6Mjc6ImNzc19tYWluX3BhZGRpbmdfaG9yaXpvbnRhbCI7czoyOiIzNyI7czoxOToiY3NzX21haW5fbWluX2hlaWdodCI7czoxOiIwIjtzOjE5OiJjc3NfbWFpbl90ZXh0X2FsaWduIjtzOjQ6ImxlZnQiO3M6MTE6InRpdGxlX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MTc6InRpdGxlX2NvbG9yX2hvdmVyIjtzOjA6IiI7czoxNToidGl0bGVfZm9udF9zaXplIjtzOjI6IjI1IjtzOjIxOiJjc3NfdGl0bGVfZm9udF93ZWlnaHQiO3M6MzoiNTAwIjtzOjIxOiJjc3NfdGl0bGVfZm9udF9mYW1pbHkiO3M6NzoiUmFsZXdheSI7czoxNzoidGl0bGVfbGluZV9oZWlnaHQiO3M6MjoiMzUiO3M6MTI6InRpdGxlX21hcmdpbiI7czoyOiIxNyI7czoyMToiY3NzX21ldGFfYm9yZGVyX2NvbG9yIjtzOjc6IiNlNWU1ZTUiO3M6MjE6ImNzc19tZXRhX2JvcmRlcl93aWR0aCI7czoxOiIxIjtzOjE0OiJjc3NfbWV0YV9jb2xvciI7czo3OiIjYThhOGE4IjtzOjE4OiJjc3NfbWV0YV9mb250X3NpemUiO3M6MjoiMTEiO3M6MjA6ImNzc19tZXRhX2ZvbnRfZmFtaWx5IjtzOjE3OiJMaWJyZSBCYXNrZXJ2aWxsZSI7czoyMDoiY3NzX21ldGFfZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjIyOiJjc3NfbWV0YV9tYXJnaW5fYm90dG9tIjtzOjI6IjE2IjtzOjI1OiJjc3NfbWV0YV9wYWRkaW5nX3ZlcnRpY2FsIjtzOjI6IjE2IjtzOjI3OiJjc3NfbWV0YV9wYWRkaW5nX2hvcml6b250YWwiO3M6MToiMCI7czoxOToiY3NzX21ldGFfbGlua19jb2xvciI7czo3OiIjNTg5MGU1IjtzOjI1OiJjc3NfbWV0YV9saW5rX2NvbG9yX2hvdmVyIjtzOjc6IiM1ODkwZTUiO3M6MTc6ImNzc19leGNlcnB0X2NvbG9yIjtzOjc6IiNmMGQ2ZDYiO3M6MjE6ImNzc19leGNlcnB0X2ZvbnRfc2l6ZSI7czoyOiIxNSI7czoyMzoiY3NzX2V4Y2VycHRfZm9udF93ZWlnaHQiO3M6MzoiNTAwIjtzOjIzOiJjc3NfZXhjZXJwdF9mb250X2ZhbWlseSI7czo0OiJMYXRvIjtzOjIzOiJjc3NfZXhjZXJwdF9saW5lX2hlaWdodCI7czoyOiIyNyI7czoxNDoiZXhjZXJwdF9tYXJnaW4iO3M6MjoiMjgiO3M6MTQ6ImV4Y2VycHRfbGVuZ3RoIjtzOjI6IjQwIjtzOjExOiJidXR0b25fdGV4dCI7czoxNjoiQ09OVElOVUUgUkVBRElORyI7czoxOToiY3NzX2J1dHRvbl9iZ19jb2xvciI7czo3OiIjYzI0ODM4IjtzOjI1OiJjc3NfYnV0dG9uX2JnX2NvbG9yX2hvdmVyIjtzOjc6IiNmZmZmZmYiO3M6MjM6ImNzc19idXR0b25fYm9yZGVyX3dpZHRoIjtzOjE6IjAiO3M6MjM6ImNzc19idXR0b25fYm9yZGVyX2NvbG9yIjtzOjc6IiMxNDBmMGYiO3M6Mjk6ImNzc19idXR0b25fYm9yZGVyX2NvbG9yX2hvdmVyIjtzOjc6IiM5ZTZkNmQiO3M6MjQ6ImNzc19idXR0b25fYm9yZGVyX3JhZGl1cyI7czoxOiIwIjtzOjE2OiJjc3NfYnV0dG9uX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjI6ImNzc19idXR0b25fY29sb3JfaG92ZXIiO3M6NzoiIzhmOGY4ZiI7czoyMDoiY3NzX2J1dHRvbl9mb250X3NpemUiO3M6MjoiMTIiO3M6MjI6ImNzc19idXR0b25fZm9udF93ZWlnaHQiO3M6MzoiODAwIjtzOjIyOiJjc3NfYnV0dG9uX2ZvbnRfZmFtaWx5IjtzOjQ6IkxhdG8iO3M6Mjc6ImNzc19idXR0b25fcGFkZGluZ192ZXJ0aWNhbCI7czoyOiIxNyI7czoyOToiY3NzX2J1dHRvbl9wYWRkaW5nX2hvcml6b250YWwiO3M6MjoiMTkiO3M6MTQ6ImJ1dHRvbl9pY29uX2lkIjtzOjk6InNoYXJlLWFsdCI7czoyMToiY3NzX2J1dHRvbl9pY29uX2NvbG9yIjtzOjc6IiNmMDdhNjgiO3M6Mjc6ImNzc19idXR0b25faWNvbl9jb2xvcl9ob3ZlciI7czo3OiIjZDFkMWQxIjtzOjIyOiJjc3NfYnV0dG9uX2ljb25fbWFyZ2luIjtzOjE6IjUiO3M6MTg6Im1haW5faGVhZGluZ190aXRsZSI7czoxNzoiTEFURVNUIEJMT0cgUE9TVFMiO3M6MjM6Im1haW5faGVhZGluZ19saW5rX3RpdGxlIjtzOjg6IlZJRVcgQUxMIjtzOjIyOiJjc3NfbWFpbl9oZWFkaW5nX2NvbG9yIjtzOjA6IiI7czoyNjoiY3NzX21haW5faGVhZGluZ19mb250X3NpemUiO3M6MjoiMTciO3M6Mjg6ImNzc19tYWluX2hlYWRpbmdfZm9udF93ZWlnaHQiO3M6MzoiNDAwIjtzOjI4OiJjc3NfbWFpbl9oZWFkaW5nX2ZvbnRfZmFtaWx5IjtzOjY6Ik9zd2FsZCI7czoyODoiY3NzX21haW5faGVhZGluZ19saW5lX2hlaWdodCI7czoyOiIzNSI7czoyNzoiY3NzX21haW5faGVhZGluZ19saW5rX2NvbG9yIjtzOjc6IiNlMzYzNGQiO3M6MzM6ImNzc19tYWluX2hlYWRpbmdfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjYzc1MDNlIjtzOjMxOiJjc3NfbWFpbl9oZWFkaW5nX2xpbmtfZm9udF9zaXplIjtzOjI6IjExIjtzOjMzOiJjc3NfbWFpbl9oZWFkaW5nX2xpbmtfZm9udF93ZWlnaHQiO3M6MzoiNjAwIjtzOjMzOiJjc3NfbWFpbl9oZWFkaW5nX2xpbmtfZm9udF9mYW1pbHkiO3M6OToiT3BlbiBTYW5zIjtzOjMzOiJjc3NfbWFpbl9oZWFkaW5nX2xpbmtfcGFkZGluZ192ZXIiO3M6MToiOSI7czoxMzoidmlld19hbGxfbGluayI7czoxOiIjIjtzOjI1OiJjc3NfaGVhZGluZ19tYXJnaW5fYm90dG9tIjtzOjI6IjI1IjtzOjE5OiJjc3NfZmlsdGVyX2JnX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjY6ImNzc19maWx0ZXJfYmdfY29sb3JfYWN0aXZlIjtzOjc6IiNlMzYzNGQiO3M6MjM6ImNzc19maWx0ZXJfYm9yZGVyX2NvbG9yIjtzOjc6IiNlOGU4ZTgiO3M6MzA6ImNzc19maWx0ZXJfYm9yZGVyX2NvbG9yX2FjdGl2ZSI7czo3OiIjZTM2MzRkIjtzOjIzOiJjc3NfZmlsdGVyX2JvcmRlcl93aWR0aCI7czoxOiIxIjtzOjIyOiJjc3NfZmlsdGVyX2JvcmRlcl90cmJsIjtzOjIxOiJ0b3AgcmlnaHQgYm90dG9tIGxlZnQiO3M6MjQ6ImNzc19maWx0ZXJfYm9yZGVyX3JhZGl1cyI7czoxOiIzIjtzOjE2OiJjc3NfZmlsdGVyX2NvbG9yIjtzOjc6IiM5Nzk3OTciO3M6MjM6ImNzc19maWx0ZXJfY29sb3JfYWN0aXZlIjtzOjc6IiNmZmZmZmYiO3M6MjA6ImNzc19maWx0ZXJfZm9udF9zaXplIjtzOjI6IjExIjtzOjIyOiJjc3NfZmlsdGVyX2ZvbnRfd2VpZ2h0IjtzOjM6IjcwMCI7czoyMjoiY3NzX2ZpbHRlcl9mb250X2ZhbWlseSI7czo5OiJPcGVuIFNhbnMiO3M6Mjc6ImNzc19maWx0ZXJfcGFkZGluZ192ZXJ0aWNhbCI7czoyOiIxMiI7czoyOToiY3NzX2ZpbHRlcl9wYWRkaW5nX2hvcml6b250YWwiO3M6MjoiMTIiO3M6MTk6ImNzc19maWx0ZXJfcG9zaXRpb24iO3M6NToicmlnaHQiO3M6MTg6ImNzc19maWx0ZXJfc3BhY2luZyI7czoxOiI5IjtzOjE5OiJjc3NfYXJyb3dzX2JnX2NvbG9yIjtzOjc6IiNjOWM5YzkiO3M6MjU6ImNzc19hcnJvd3NfYmdfY29sb3JfaG92ZXIiO3M6NzoiIzU4OTBlNSI7czoyMzoiY3NzX2Fycm93c19ib3JkZXJfY29sb3IiO3M6MDoiIjtzOjI5OiJjc3NfYXJyb3dzX2JvcmRlcl9jb2xvcl9ob3ZlciI7czowOiIiO3M6MjM6ImNzc19hcnJvd3NfYm9yZGVyX3dpZHRoIjtzOjE6IjAiO3M6MjQ6ImNzc19hcnJvd3NfYm9yZGVyX3JhZGl1cyI7czoxOiIzIjtzOjE2OiJjc3NfYXJyb3dzX2NvbG9yIjtzOjc6IiNmZmZmZmYiO3M6MjI6ImNzc19hcnJvd3NfY29sb3JfaG92ZXIiO3M6NzoiI2ZmZmZmZiI7czoyMToiY3NzX2Fycm93c19tYXJnaW5fdG9wIjtzOjE6IjYiO3M6MTU6ImNzc19hcnJvd3Nfc2l6ZSI7czoyOiIyMyI7czoyMToiY3NzX2Fycm93c19hcnJvd19zaXplIjtzOjI6IjEwIjtzOjE3OiJjc3NfY2lyY2xlc19jb2xvciI7czo3OiIjYjliOWI5IjtzOjI0OiJjc3NfY2lyY2xlc19jb2xvcl9hY3RpdmUiO3M6NzoiIzU4OTBlNSI7czoyMjoiY3NzX2NpcmNsZXNfbWFyZ2luX3RvcCI7czoyOiIyMCI7czoxNjoiY3NzX2NpcmNsZXNfc2l6ZSI7czoxOiI3IjtzOjE5OiJjc3NfY2lyY2xlc19zcGFjaW5nIjtzOjE6IjMiO3M6MTM6ImNzc19wYWdfYWxpZ24iO3M6NDoibGVmdCI7czoxNjoiY3NzX3BhZ19iZ19jb2xvciI7czowOiIiO3M6MjA6ImNzc19wYWdfYm9yZGVyX2NvbG9yIjtzOjA6IiI7czoyMDoiY3NzX3BhZ19ib3JkZXJfd2lkdGgiO3M6MToiMCI7czoxOToiY3NzX3BhZ19ib3JkZXJfdHJibCI7czoyMToidG9wIHJpZ2h0IGJvdHRvbSBsZWZ0IjtzOjIxOiJjc3NfcGFnX2JvcmRlcl9yYWRpdXMiO3M6MToiMCI7czoyNDoiY3NzX3BhZ19wYWRkaW5nX3ZlcnRpY2FsIjtzOjE6IjAiO3M6MjY6ImNzc19wYWdfcGFkZGluZ19ob3Jpem9udGFsIjtzOjE6IjAiO3M6MjE6ImNzc19wYWdfaXRlbV9iZ19jb2xvciI7czo3OiIjZmZmZmZmIjtzOjI4OiJjc3NfcGFnX2l0ZW1fYmdfY29sb3JfYWN0aXZlIjtzOjc6IiNlMzYzNGQiO3M6MjU6ImNzc19wYWdfaXRlbV9ib3JkZXJfY29sb3IiO3M6NzoiI2U4ZThlOCI7czozMjoiY3NzX3BhZ19pdGVtX2JvcmRlcl9jb2xvcl9hY3RpdmUiO3M6NzoiI2UzNjM0ZCI7czoyNToiY3NzX3BhZ19pdGVtX2JvcmRlcl93aWR0aCI7czoxOiIxIjtzOjMyOiJjc3NfcGFnX2l0ZW1fYm9yZGVyX3dpZHRoX2FjdGl2ZSI7czoxOiIxIjtzOjI0OiJjc3NfcGFnX2l0ZW1fYm9yZGVyX3RyYmwiO3M6MjE6InRvcCByaWdodCBib3R0b20gbGVmdCI7czoyNjoiY3NzX3BhZ19pdGVtX2JvcmRlcl9yYWRpdXMiO3M6MToiMyI7czoxODoiY3NzX3BhZ19pdGVtX2NvbG9yIjtzOjc6IiM5Nzk3OTciO3M6MjU6ImNzc19wYWdfaXRlbV9jb2xvcl9hY3RpdmUiO3M6NzoiI2ZmZmZmZiI7czoyMjoiY3NzX3BhZ19pdGVtX2ZvbnRfc2l6ZSI7czoyOiIxMSI7czoyNDoiY3NzX3BhZ19pdGVtX2ZvbnRfd2VpZ2h0IjtzOjM6IjcwMCI7czoyNDoiY3NzX3BhZ19pdGVtX2ZvbnRfZmFtaWx5IjtzOjk6Ik9wZW4gU2FucyI7czoyOToiY3NzX3BhZ19pdGVtX3BhZGRpbmdfdmVydGljYWwiO3M6MjoiMTIiO3M6MzE6ImNzc19wYWdfaXRlbV9wYWRkaW5nX2hvcml6b250YWwiO3M6MjoiMTIiO3M6MjA6ImNzc19wYWdfaXRlbV9zcGFjaW5nIjtzOjI6IjEwIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO3M6MzoiMzc3IjtzOjk6Im1vZHVsZV9pZCI7czo5OiJEU0xDX0Jsb2ciO30=[/dslc_module] [/dslc_modules_area] [/dslc_modules_section] '
				+ '</textarea>.'
			+ '</div>'
			+ '<a href="#" class="dslc-tut-proceed">continue<span class="dslc-tut-icon dslc-icon-chevron-right"></span></a>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade'
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Click this tab to switch to the main <strong style="color: #d8827d;">templates management</strong> section.',
			'dslc_target' : '.dslca-go-to-section-templates',
			'dslc_event_el' : '.dslca-go-to-section-templates',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_parent_el' : '.dslca-container',
			'dslc_animation' : 'fade',
			'dslc_pos' : 'above',
			'dslc_func_start' : function() {
				$('.dslc-tut-panel-prevent').show();	
			}
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Click <strong>Import</strong>, paste the code in the textarea and click the <strong>import</strong> button.',
			'dslc_target' : '.dslca-open-modal-hook[data-modal=".dslca-modal-templates-import"]',
			'dslc_event_el' : '.dslca-open-modal-hook[data-modal=".dslca-modal-templates-import"]',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_parent_el' : '.dslca-container',
			'dslc_animation' : 'fade',
			'dslc_pos' : 'above'
		},
		{
			'dslc_type' : 'action',
			'dslc_label' : 'Click <strong>Import</strong>, paste the code in the textarea and click the <strong>import</strong> button.',
			'dslc_target' : '.dslca-modal-templates-import',
			'dslc_event_el' : '.dslca-submit',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_parent_el' : '.dslca-container',
			'dslc_animation' : 'slide',
			'dslc_pos' : 'above',
			'dslc_func_start' : function(){
				$('.dslca-close-modal-hook').addClass('dslca-action-disabled');
			}
		},
		{
			'dslc_type' : 'information',
			'dslc_label' : '<span class="dslc-tut-bubble-title">4. Templates System</span>'
			+ '<span class="dslc-tut-bubble-descr">finished</span>'
			+ '<div class="dslc-tut-bubble-content">'
				+ 'Congrats on completing the <strong style="color: #9268a9;">Basics Tutorial</strong> for <strong style="color: #06b2ac;">Live Composer</strong>.'
			+ '</div>',
			'dslc_target' : 'body',
			'dslc_event_el' : '.dslc-tut-proceed',
			'dslc_event' : 'click.dslc_tut_modules_info',
			'dslc_animation' : 'fade'
		},
		
		

	];

	dslc_tut_proceed();

});

