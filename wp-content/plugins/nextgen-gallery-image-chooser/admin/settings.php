<?php  
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

	function nggic_admin_options()  {
	
	global $wpdb, $nggic_options;	

	// get the options
	$nggic_options = get_option('nggic_options');

	if (!isset($nggic_options['sortby'])) {
		include_once (dirname (__FILE__). '/../init.php');
	}

	// same as $_SERVER['REQUEST_URI'], but should work under IIS 6.0
	$filepath    = admin_url() . 'admin.php?page=' . $_GET['page'];

	$border  = '';
    
	if ( isset($_POST['updateoption']) ) {	
		check_admin_referer('nggic_settings');
		// get the hidden option fields, taken from WP core
		if ( $_POST['page_options'] )	
			$options = explode(',', stripslashes($_POST['page_options']));
			
		if ($options) {
			foreach ($options as $option) {
				$option = trim($option);
				$value = isset($_POST[$option]) ? trim($_POST[$option]) : false;
				$nggic_options[$option] = $value;
			}
		}
		
		// Save options
		update_option('nggic_options', $nggic_options);
	 	nggicAdminPanel::render_message(__('Update successful','nggic'));
	}
	
	?>
	<script type="text/javascript">
		jQuery(function() {
			jQuery('#slider').tabs({ fxFade: true, fxSpeed: 'fast' });
		});
		function setcolor(fileid,color) {
			jQuery(fileid).css("background", color );
		};
	</script>
	
	<div id="slider" class="wrap">
	
		<!-- General Options -->

		<div id="generaloptions">
			<h2><?php _e('NextGEN Gallery Image Chooser Options','nggic'); ?></h2>
			<form name="generaloptions" method="post">
			<?php wp_nonce_field('nggic_settings') ?>
			<input type="hidden" name="page_options" value="sortby,default_action,tag_width,tag_height,images_per_page,default_alignment,default_mode,display_filenames" />
				<table class="form-table">
					<tr>
						<th><?php _e('Image sort order','nggic') ?></th>
						<td>
						<select size="1" name="sortby">
							<option value="gallery_order" <?php selected("gallery_order" , $nggic_options['sortby']); ?> ><?php _e('NextGEN Gallery order', 'nggic') ;?></option>
							<option value="title_asc" <?php selected("title_asc" , $nggic_options['sortby']); ?> ><?php _e('NextGEN Gallery Title (A-z)', 'nggic') ;?></option>
							<option value="title_desc" <?php selected("title_desc" , $nggic_options['sortby']); ?> ><?php _e('NextGEN Gallery Title (z-A)', 'nggic') ;?></option>
							<option value="orig_time_desc" <?php selected("orig_time_desc" , $nggic_options['sortby']); ?> ><?php _e('Origination Time (Newest First)', 'nggic') ;?></option>
							<option value="orig_time_asc" <?php selected("orig_time_asc" , $nggic_options['sortby']); ?> ><?php _e('Origination Time (Oldest First)', 'nggic') ;?></option>
						</select>
            </td>
					</tr>
					<tr>
						<th><?php _e('How to Insert Image','nggic') ?></th>
						<td>
						<select size="1" name="default_action">
							<option value="ngg_singlepic" <?php selected("ngg_singlepic" , $nggic_options['default_action']); ?> ><?php _e('NGG tag of image', 'nggic') ;?></option>
							<option value="ngg_thumb" <?php selected("ngg_thumb" , $nggic_options['default_action']); ?> ><?php _e('NGG tag of thumbnail', 'nggic') ;?></option>
							<option value="ngg_thumb_multi" <?php selected("ngg_thumb_multi" , $nggic_options['default_action']); ?> ><?php _e('NGG tag of multiple thumbnails', 'nggic') ;?></option>
							<option value="thumbnail_image" <?php selected("thumbnail_image" , $nggic_options['default_action']); ?> ><?php _e('Thumbnail with link to image', 'nggic') ;?></option>
							<option value="thumbnail_custom_url" <?php selected("thumbnail_custom_url" , $nggic_options['default_action']); ?> ><?php _e('Thumbnail with link to custom URL', 'nggic') ;?></option>
							<option value="thumbnail_only" <?php selected("thumbnail_only" , $nggic_options['default_action']); ?> ><?php _e('Thumbnail only - no link', 'nggic') ;?></option>
							<option value="fullsize_only" <?php selected("fullsize_only" , $nggic_options['default_action']); ?> ><?php _e('Fullsized image only - no link', 'nggic') ;?></option>
							<option value="link_image" <?php selected("link_image" , $nggic_options['default_action']); ?> ><?php _e('Text link to image', 'nggic') ;?></option>
						</select>
            </td>
					</tr>
					<tr>
						<th><?php _e('Default image size (W x H)','nggic') ?></th>
						<td><input type="text" size="3" maxlength="4" name="tag_width" value="<?php echo $nggic_options['tag_width'] ?>" /> x
						<input type="text" size="3" maxlength="4" name="tag_height" value="<?php echo $nggic_options['tag_height'] ?>" />
						<span class="description"><?php _e('Define width and/or height of the fullsized image. Leave blank for original size.','nggic') ?></span></td>
					</tr>	
					<tr>
						<th><?php _e('Images per page','nggic') ?></th>
						<td><input type="text" size="3" maxlength="4" name="images_per_page" value="<?php echo $nggic_options['images_per_page'] ?>" />
						<span class="description"><?php _e('Define how many images should be displayed on one page.','nggic') ?></span></td>
					</tr>	
					<tr>
						<th><?php _e('NGG float class','nggic') ?></th>
						<td>
						<select size="1" name="default_alignment">
							<option value="none" <?php selected("none" , $nggic_options['default_alignment']); ?> ><?php _e('None', 'nggic') ;?></option>
							<option value="left" <?php selected("left" , $nggic_options['default_alignment']); ?> ><?php _e('Float Left', 'nggic') ;?></option>
							<option value="right" <?php selected("right" , $nggic_options['default_alignment']); ?> ><?php _e('Float Right', 'nggic') ;?></option>
						</select>
						<span class="description"><?php _e('Define whether fullsized images should be floating.','nggic') ?></span></td>
					</tr>
					<tr>
						<th><?php _e('Mode','nggic') ?></th>
						<td>
						<select size="1" name="default_mode">
							<option value="none" <?php selected("default" , $nggic_options['default_mode']); ?> ><?php _e('Default', 'nggic') ;?></option>
							<option value="web20" <?php selected("web20" , $nggic_options['default_mode']); ?> ><?php _e('Web 2.0', 'nggic') ;?></option>
							<option value="watermark" <?php selected("watermark" , $nggic_options['default_mode']); ?> ><?php _e('Watermark', 'nggic') ;?></option>
						</select>
						<span class="description"><?php _e('Select the image display mode.','nggic') ?></span></td>
					</tr>
					<tr>
						<th><?php _e('Display image infomation','nggic') ?></th>
						<td><input name="display_filenames" type="checkbox" value="1" <?php checked(true , $nggic_options['display_filenames']); ?> />
						<span class="description"><?php _e('Enables displaying of image information together with thumbnails.','nggic') ?></span></td>
					</tr>
				</table>
			<div class="submit"><input class="button-primary" type="submit" name="updateoption" value="<?php _e('Update') ;?>"/></div>
			</form>	
		</div>
	</div>

	<?php
}

?>
