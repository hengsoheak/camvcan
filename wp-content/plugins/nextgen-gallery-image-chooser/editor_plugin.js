/*
    NextGEN Gallery Image Chooser
    Version 1.1.0

    Author: Ulrich Mertin
    
    This plugin is based on g2image by Kirk Steffensen,
    see http://g2image.steffensenfamily.com/ for further contributors.

    Released under the GPL version 2.
    A copy of the license is in the root folder of this plugin.
*/

(function() {
		
	/** 
	 * Load plugin specific language pack
	 */
	tinymce.PluginManager.requireLangPack('nggic');

	tinymce.create('tinymce.plugins.nggicPlugin', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
		
			var t = this
		
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			ed.addCommand('mcenggic', function() {
				var focusElm = ed.selection.getNode();
				var focusElmId = ed.dom.getAttrib(focusElm, 'id', '');

				var flag = "";
				var template = new Array();
				var file_name  = "";

				template['file'] = url + '/nextgen-ic.php?nggic_tinymce=1'; // Relative to theme
				template['width'] = 800;
				template['height'] = 600;

				ed.windowManager.open({
					file : template['file'],
					width : template['width'],
					height : template['height'],
					resizable : "yes",
					scrollbars : "yes"
				}, {
					file_name : file_name,
					plugin_url : url
				});
			});

			// Register example button
			ed.addButton('nggic', {
				title : 'nggic.button_title',
				cmd : 'mcenggic',
				image : url + '/images/nggic.gif'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, node) {
				cm.setActive('nggic', false);
				do {
					if ((node.nodeName.toLowerCase() == "img") && ((ed.dom.getAttrib(node, 'id').indexOf('mce_plugin_nggic_wpg2') == 0) || (ed.dom.getAttrib(node, 'id').indexOf('mce_plugin_nggic_wpg2id') == 0)))
						cm.setActive('nggic', true);
				} while ((node = node.parentNode));
			});
			
			ed.onBeforeSetContent.add(function(ed, o) {
				o.content = t._nggtohtml(o.content, url);
			});

			ed.onPostProcess.add(function(ed, o) {
				if (o.set)
					o.content = t._nggtohtml(o.content, url);

				if (o.get)
					o.content = t._htmltongg(o.content, t);
			});
		},

		/**
		 * Creates control instances based in the incomming name. This method is normally not
		 * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
		 * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
		 * method can be used to create those.
		 *
		 * @param {String} n Name of the control to create.
		 * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
		 * @return {tinymce.ui.Control} New control instance or null if no control was created.
		 */
		createControl : function(n, cm) {
			return null;
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
				longname  : 'NGG Image plugin',
				author    : 'Ulrich Mertin',
				authorurl : 'http://www.ulrich-mertin.de',
				infourl   : 'http://www.ulrich-mertin.de/nggic/',
				version   : "1.0.0"
			};
		},
		
		// Private methods
		
		_nggtohtml : function(content, pluginURL) {
			// Parse all album tags and replace them with images
			var startPos = 0;

			while ((startPos = content.indexOf('[album id=', startPos)) != -1) {

				var endPos       = content.indexOf(']', startPos);
				var contentAfter = content.substring(endPos+1);

				var file_name   = content.substring(startPos + 10,endPos).replace(/"/g, '&quot;');

				var empty_image_path = pluginURL + '/images/ngg_placeholder_album.jpg';

				// Insert image
				content = content.substring(0, startPos);

				content += '<img src="' + empty_image_path + '" ';
				content += 'alt="'+file_name+'" title="'+file_name+'" class="mceItem" id="mce_plugin_nggic_ngg_album" />';

				content += contentAfter;
				
				startPos++;
			};

			// Parse all nggallery tags and replace them with images
			var startPos = 0;

			while ((startPos = content.indexOf('[nggallery id=', startPos)) != -1) {

				var endPos       = content.indexOf(']', startPos);
				var contentAfter = content.substring(endPos+1);

				var file_name   = content.substring(startPos + 14,endPos).replace(/"/g, '&quot;');

				var empty_image_path = pluginURL + '/images/ngg_placeholder_gallery.jpg';

				// Insert image
				content = content.substring(0, startPos);

				content += '<img src="' + empty_image_path + '" ';
				content += 'alt="'+file_name+'" title="'+file_name+'" class="mceItem" id="mce_plugin_nggic_ngg_gallery" />';

				content += contentAfter;
				
				startPos++;
			};

			// Parse all imagebrowser tags and replace them with images
			while ((startPos = content.indexOf('[imagebrowser id=', startPos)) != -1) {

				var endPos       = content.indexOf(']', startPos);
				var contentAfter = content.substring(endPos+1);

				var file_name   = content.substring(startPos + 17,endPos).replace(/"/g, '&quot;');

				var empty_image_path = pluginURL + '/images/ngg_placeholder_gallery.jpg';

				// Insert image
				content = content.substring(0, startPos);

				content += '<img src="' + empty_image_path + '" ';
				content += 'alt="'+file_name+'" title="'+file_name+'" class="mceItem" id="mce_plugin_nggic_ngg_imgbrowser" />';

				content += contentAfter;
				
				startPos++;
			};

			// Parse all singlepic tags and replace them with images
			var startPos = 0;

			while ((startPos = content.indexOf('[singlepic id=', startPos)) != -1) {

				var endPos       = content.indexOf(']', startPos);
				var contentAfter = content.substring(endPos+1);

				var file_name   = content.substring(startPos + 14,endPos).replace(/"/g, '&quot;');

				var empty_image_path = pluginURL + '/images/ngg_placeholder_image.jpg';

				// Insert image
				content = content.substring(0, startPos);

				content += '<img src="' + empty_image_path + '" ';
				content += 'alt="'+file_name+'" title="'+file_name+'" class="mceItem" id="mce_plugin_nggic_ngg_image" />';

				content += contentAfter;

				startPos++;
			};

			// Parse all thumb tags and replace them with images
			var startPos = 0;

			while ((startPos = content.indexOf('[thumb id=', startPos)) != -1) {

				var endPos       = content.indexOf(']', startPos);
				var contentAfter = content.substring(endPos+1);

				var file_name   = content.substring(startPos + 10,endPos).replace(/"/g, '&quot;');

				var empty_image_path = pluginURL + '/images/ngg_placeholder_image.jpg';

				// Insert image
				content = content.substring(0, startPos);

				content += '<img src="' + empty_image_path + '" ';
				content += 'alt="'+file_name+'" title="'+file_name+'" class="mceItem" id="mce_plugin_nggic_ngg_thumb" />';

				content += contentAfter;

				startPos++;
			};
			
			return content;
		},
	
		_htmltongg : function(content, t) {
			// Parse all NGG placeholder tags and replace them with NGG tags
			var startPos = -1;

			while ((startPos = content.indexOf('<img', startPos+1)) != -1) {

				var endPos = content.indexOf('/>', startPos);
				var attribs = t._parseAttributes(content.substring(startPos + 4, endPos));

				if (attribs['id'] == "mce_plugin_nggic_ngg_album") {

					endPos += 2;
					var embedHTML = '[album id=' + attribs['alt'].replace(/&quot;/g, '"') + ']';

					// Insert embed/object chunk
					chunkBefore = content.substring(0, startPos);
					chunkAfter  = content.substring(endPos);

					content = chunkBefore + embedHTML + chunkAfter;
				}
				else if (attribs['id'] == "mce_plugin_nggic_ngg_gallery") {

					endPos += 2;
					var embedHTML = '[nggallery id=' + attribs['alt'].replace(/&quot;/g, '"') + ']';

					// Insert embed/object chunk
					chunkBefore = content.substring(0, startPos);
					chunkAfter  = content.substring(endPos);

					content = chunkBefore + embedHTML + chunkAfter;
				}
				else if (attribs['id'] == "mce_plugin_nggic_ngg_imgbrowser") {

					endPos += 2;
					var embedHTML = '[imagebrowser id=' + attribs['alt'].replace(/&quot;/g, '"') + ']';

					// Insert embed/object chunk
					chunkBefore = content.substring(0, startPos);
					chunkAfter  = content.substring(endPos);

					content = chunkBefore + embedHTML + chunkAfter;
				}
				else if (attribs['id'] == "mce_plugin_nggic_ngg_image") {

					endPos += 2;
					var embedHTML = '[singlepic id=' + attribs['alt'].replace(/&quot;/g, '"') + ']';

					// Insert embed/object chunk
					chunkBefore = content.substring(0, startPos);
					chunkAfter  = content.substring(endPos);

					content = chunkBefore + embedHTML + chunkAfter;
				}
				else if (attribs['id'] == "mce_plugin_nggic_ngg_thumb") {

					endPos += 2;
					var embedHTML = '[thumb id=' + attribs['alt'].replace(/&quot;/g, '"') + ']';

					// Insert embed/object chunk
					chunkBefore = content.substring(0, startPos);
					chunkAfter  = content.substring(endPos);

					content = chunkBefore + embedHTML + chunkAfter;
				}
			}
	
			return content;
		},

		_parseAttributes : function(attribute_string) {
	
			var attributeName = "";
			var attributeValue = "";
			var withInName;
			var withInValue;
			var attributes = new Array();
			var whiteSpaceRegExp = new RegExp('^[ \n\r\t]+', 'g');
	
			if (attribute_string == null || attribute_string.length < 2)
				return null;
	
			withInName = withInValue = false;
	
			for (var i=0; i<attribute_string.length; i++) {
				var chr = attribute_string.charAt(i);
	
				if ((chr == '"' || chr == "'") && !withInValue)
					withInValue = true;
	
				else if ((chr == '"' || chr == "'") && withInValue) {
	
					withInValue = false;
	
					var pos = attributeName.lastIndexOf(' ');
					if (pos != -1)
						attributeName = attributeName.substring(pos+1);
	
					attributes[attributeName.toLowerCase()] = attributeValue.substring(1).toLowerCase();
	
					attributeName = "";
					attributeValue = "";
				}
				else if (!whiteSpaceRegExp.test(chr) && !withInName && !withInValue)
					withInName = true;
	
				if (chr == '=' && withInName)
					withInName = false;
	
				if (withInName)
					attributeName += chr;
	
				if (withInValue)
					attributeValue += chr;
			}
	
			return attributes;
		}
		
	});

	// Register plugin
	tinymce.PluginManager.add('nggic', tinymce.plugins.nggicPlugin);
})();