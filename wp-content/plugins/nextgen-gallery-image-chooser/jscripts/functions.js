/*
    NextGEN Gallery Image Chooser
    Version 1.1.0

    Author: Ulrich Mertin
    
    This plugin is based on g2image by Kirk Steffensen,
    see http://g2image.steffensenfamily.com/ for further contributors.

    Released under the GPL version 2.
    A copy of the license is in the root folder of this plugin.
*/

function activateInsertButton() {
	var obj = document.forms[0];
	var checked = 0;

	if (obj.images.length) {
		loop = obj.images.length;
		for (var i=0;i<loop;i++) {
			if (obj.images[i].checked) {
				checked++;
			}
		}
	}
	else {
		if (obj.images.checked) {
			checked = 1;
		}
	}
	if (checked) {
		document.forms[0].insert_button.disabled = false;
	}
	else {
		document.forms[0].insert_button.disabled = true;
	}
}

function checkAllImages() {
	var obj = document.forms[0];

	if (obj.images.length) {
		loop = obj.images.length;
		for (var i=0;i<loop;i++) {
			obj.images[i].checked = true;
		}
	}
	else {
		obj.images.checked = true;
	}
	document.forms[0].insert_button.disabled = false;
}

function uncheckAllImages() {
	var obj = document.forms[0];

	if (obj.images.length) {
		loop = obj.images.length;
		for (var i=0;i<loop;i++) {
			obj.images[i].checked = false;
		}
	}
	else {
		obj.images.checked = false;
	}
	document.forms[0].insert_button.disabled = true;
}

function toggleTextboxes() {
	var obj = document.forms[0];

	if (obj.imginsert.value == 'thumbnail_custom_url')
		document.getElementsByName('custom_url_textbox')[0].className = 'displayed_textbox';
	else
		document.getElementsByName('custom_url_textbox')[0].className = 'hidden_textbox';

	if (obj.imginsert.value == 'link_image')
		document.getElementsByName('link_text_textbox')[0].className = 'displayed_textbox';
	else
		document.getElementsByName('link_text_textbox')[0].className = 'hidden_textbox';

	if (obj.imginsert.value == 'ngg_singlepic') {
		document.getElementsByName('ngg_tag_size_textbox')[0].className = 'displayed_textbox';
		document.getElementsByName('ngg_tag_align_select')[0].className = 'displayed_textbox';
		document.getElementsByName('ngg_tag_mode_select')[0].className = 'displayed_textbox';
	}
	else {
		document.getElementsByName('ngg_tag_size_textbox')[0].className = 'hidden_textbox';
		document.getElementsByName('ngg_tag_align_select')[0].className = 'hidden_textbox';
		document.getElementsByName('ngg_tag_mode_select')[0].className = 'hidden_textbox';
	}
}

function insertAtCursor(myField, myValue) {
	//IE support
	if (document.selection && !window.opera) {
		myField.focus();
		sel = window.opener.document.selection.createRange();
		sel.text = myValue;
	}
	//MOZILLA/NETSCAPE/OPERA support
	else if (myField.selectionStart || myField.selectionStart == '0') {
		var startPos = myField.selectionStart;
		var endPos = myField.selectionEnd;
		myField.value = myField.value.substring(0, startPos)
		+ myValue
		+ myField.value.substring(endPos, myField.value.length);
	}
	else {
		myField.value += myValue;
	}
}

function showFileNames(){
	divs = document.getElementsByTagName('div');
	for (var i = 0; i < divs.length; i++) {
		if (divs[i].className == 'hidden_title')
			divs[i].className = 'displayed_title';
		else if (divs[i].className == 'thumbnail_imageblock')
			divs[i].className = 'title_imageblock';
		else if (divs[i].className == 'inactive_placeholder')
			divs[i].className = 'active_placeholder';
	}
}

function showThumbnails(){
	divs = document.getElementsByTagName('div');
	for (var i = 0; i < divs.length; i++) {
		if (divs[i].className == 'displayed_title')
			divs[i].className = 'hidden_title';
		else if (divs[i].className == 'title_imageblock')
			divs[i].className = 'thumbnail_imageblock';
		else if (divs[i].className == 'active_placeholder')
			divs[i].className = 'inactive_placeholder';
	}
}

function insertHtml(html,form) {
	nggic_form=form.nggic_form.value;
	nggic_field=form.nggic_field.value;

	if(window.tinyMCE) {
		tinyMCE.execCommand("mceInsertContent",true,html);
		tinyMCEPopup.close();
	}
	else if (window.opener.FCK) {
		window.opener.FCK.InsertHtml(html);
		window.close();
	}
	else {
		insertAtCursor(window.opener.document.forms[nggic_form].elements[nggic_field],html);
		window.close();
	}
}

function insertItems(){
	var obj = document.forms[0];
	var htmlCode = '';
	var imgtitle = '';
	var imgalt = '';
	var loop = '';
	var item_summary = new Array();
	var item_title = new Array();
	var item_description = new Array();
	var image_url = new Array();
	var thumbnail_src = new Array();
	var fullsize_img = new Array();
	var thumbw = new Array();
	var thumbh = new Array();
	var image_id = new Array();

	//hack required for when there is only one image

	if (obj.images.length) {
		loop = obj.images.length;
		for (var i=0;i<loop;i++) {
			image_id[i] = obj.image_id[i].value;
			item_title[i] = obj.item_title[i].value;
			item_summary[i] = obj.item_summary[i].value;
			item_description[i] = obj.item_description[i].value
			image_url[i] = obj.image_url[i].value;
			fullsize_img[i] = obj.fullsize_img[i].value;
			thumbnail_src[i] = obj.thumbnail_src[i].value;
			thumbw[i] = obj.thumbw[i].value;
			thumbh[i] = obj.thumbh[i].value;
		}
	}
	else {
		loop = 1;
		image_id[0] = obj.image_id.value;
		item_title[0] = obj.item_title.value;
		item_summary[0] = obj.item_summary.value;
		item_description[0] = obj.item_description.value
		image_url[0] = obj.image_url.value;
		thumbnail_src[0] = obj.thumbnail_src.value;
		fullsize_img[0] = obj.fullsize_img.value;
		thumbw[0] = obj.thumbw.value;
		thumbh[0] = obj.thumbh.value;
	}

	//let's generate HTML code according to selected insert option
  if (obj.imginsert.value == 'ngg_thumb_multi') {
		imgtitle = ' title="' + item_summary[0] + '"';
    		thumbsrc = thumbnail_src[0];

		var ids = '';
		for (var i=0;i<loop;i++) {
			if ((loop == 1) || obj.images[i].checked) {
				ids = ids + ',' + image_id[i];	
			}
		}
		
		htmlCode += '<img src="' + thumbsrc
		+ '" alt="' + ids.substr(1);
		if (obj.ngg_tag_template.value != ''){
			htmlCode += ' template=&quot;' + obj.ngg_tag_template.value + '&quot;';
		}
		htmlCode += '" title="' + ids.substr(1);
		htmlCode += '" '
		+ 'class="mceItem" id="mce_plugin_nggic_ngg_thumb" />';
 }
  else {
  	for (var i=0;i<loop;i++) {
  		if ((loop == 1) || obj.images[i].checked) {
  
  			imgtitle = ' title="' + item_summary[i] + '"';
  			imgalt = ' alt="' + item_title[i] + '"';
  			thumbw[i] = 'width="' + thumbw[i] + '" ';
  			thumbh[i] = 'height="' + thumbh[i] + '" ';
  
  			switch(obj.imginsert.value){
  				case 'thumbnail_image':
  					if ((obj.alignment.value != 'none') && (obj.class_mode.value == 'div')){
  						htmlCode += '<div class="' + obj.alignment.value + '">';
  					}
  					htmlCode += '<a href="' + image_url[i]
  					+ '"><img src="'+ thumbnail_src[i] + '" ' + thumbw[i]
  					+ ' ' + thumbh[i] + imgalt + imgtitle;
  					if ((obj.alignment.value != 'none') && (obj.class_mode.value == 'img')){
  						htmlCode += ' class="' + obj.alignment.value + '"';
  					}
  					htmlCode += ' /></a>';
  					if ((obj.alignment.value != 'none') && (obj.class_mode.value == 'div')){
  						htmlCode += '</div>';
  					}
  				break;
  				case 'thumbnail_custom_url':
  					if ((obj.alignment.value != 'none') && (obj.class_mode.value == 'div')){
  						htmlCode += '<div class="' + obj.alignment.value + '">';
  					}
  					htmlCode += '<a href="' + obj.custom_url.value
  					+ '"><img src="'+thumbnail_src[i] + '" ' + thumbw[i]
  					+ ' ' + thumbh[i] + imgalt + imgtitle;
  					if ((obj.alignment.value != 'none') && (obj.class_mode.value == 'img')){
  						htmlCode += ' class="' + obj.alignment.value + '"';
  					}
  					htmlCode += ' /></a>';
  					if ((obj.alignment.value != 'none') && (obj.class_mode.value == 'div')){
  						htmlCode += '</div>';
  					}
  				break;
  				case 'thumbnail_only':
  					if ((obj.alignment.value != 'none') && (obj.class_mode.value == 'div')){
  						htmlCode += '<div class="' + obj.alignment.value + '">';
  					}
  					htmlCode += '<img src="'+thumbnail_src[i] + '" ' + thumbw[i]
  					+ ' ' + thumbh[i] + imgalt + imgtitle;
  					if ((obj.alignment.value != 'none') && (obj.class_mode.value == 'img')){
  						htmlCode += ' class="' + obj.alignment.value + '"';
  					}
  					htmlCode += ' />';
  					if ((obj.alignment.value != 'none') && (obj.class_mode.value == 'div')){
  						htmlCode += '</div>';
  					}
  				break;
  				case 'fullsize_only':
  					if ((obj.alignment.value != 'none') && (obj.class_mode.value == 'div')){
  						htmlCode += '<div class="' + obj.alignment.value + '">';
  					}
  					htmlCode += '<img src="'+fullsize_img[i] + '" ' + imgalt + imgtitle;
  					if ((obj.alignment.value != 'none') && (obj.class_mode.value == 'img')){
  						htmlCode += ' class="' + obj.alignment.value + '"';
  					}
  					htmlCode += ' />';
  					if ((obj.alignment.value != 'none') && (obj.class_mode.value == 'div')){
  						htmlCode += '</div>';
  					}
  				break;
  				case 'ngg_singlepic':
  					htmlCode += '<img src="' + thumbnail_src[i]
  					+ '" alt="' + image_id[i];
  					if (obj.alignment.value != 'none'){
  						htmlCode += ' float=&quot;' + obj.alignment.value + '&quot;';
  					}
  					if (obj.ngg_tag_width.value != ''){
  						htmlCode += ' w=&quot;' + obj.ngg_tag_width.value + '&quot;';
  					}
  					if (obj.ngg_tag_height.value != ''){
  						htmlCode += ' h=&quot;' + obj.ngg_tag_height.value + '&quot;';
  					}
  					if (obj.ngg_tag_template.value != ''){
  						htmlCode += ' template=&quot;' + obj.ngg_tag_template.value + '&quot;';
  					}
  					if (obj.ngg_tag_link.value != ''){
  						htmlCode += ' link=&quot;' + obj.ngg_tag_link.value + '&quot;';
  					}
  					if (obj.ngg_tag_mode_select.value != 'none'){
  						htmlCode += ' mode=&quot;' + obj.ngg_tag_mode_select.value + '&quot;';
  					}
  					htmlCode += '" title="' + image_id[i]
  					+ '" class="mceItem" id="mce_plugin_nggic_ngg_image" />';
  				break;
  				case 'ngg_thumb':
  					htmlCode += '<img src="' + thumbnail_src[i]
  					+ '" alt="' + image_id[i];
  					if (obj.ngg_tag_template.value != ''){
  						htmlCode += ' template=&quot;' + obj.ngg_tag_template.value + '&quot;';
  					}
  					htmlCode += '" title="' + image_id[i]
  					+ '" class="mceItem" id="mce_plugin_nggic_ngg_thumb" />';
  				break;
  				case 'link_image':
  					htmlCode += '<a href="' + image_url[i] + '">' + obj.link_text.value + '</a>';
  				break;
  				default:
  					htmlCode += 'Error';
  				break;
  			}
  		}
  	}
  }
	insertHtml(htmlCode,obj);
}

String.prototype.startsWith = function(str) {return (this.match("^"+str)==str)}

function insertNggTag(){

	var obj = document.forms[0];
	var htmlCode = '';

	htmlCode += '<img src="' + obj.ngg_thumbnail.value;
	if (obj.ngg_id.value.startsWith('a')) {
		htmlCode += '" alt="' + obj.ngg_id.value.substr(1);
		if (obj.ngg_tag_template.value != ''){
			htmlCode += ' template=&quot;' + obj.ngg_tag_template.value + '&quot;';
		}
		htmlCode += '" title="' + obj.ngg_id.value.substr(1)
		+ '" class="mceItem" id="mce_plugin_nggic_ngg_album" />';
	}
	else {
		htmlCode += '" alt="' + obj.ngg_id.value;
		if (obj.ngg_tag_template.value != ''){
			htmlCode += ' template=&quot;' + obj.ngg_tag_template.value + '&quot;';
		}
		htmlCode += '" title="' + obj.ngg_id.value;
		if (obj.ngg_tag_imagebrowser.checked == true) {
			htmlCode += '" class="mceItem" id="mce_plugin_nggic_ngg_imgbrowser" />';
		}
		else {
			htmlCode += '" class="mceItem" id="mce_plugin_nggic_ngg_gallery" />';
		}
	}

	insertHtml(htmlCode,obj);
}
