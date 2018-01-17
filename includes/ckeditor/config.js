/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.height = 500;
	config.language = 'el';
	config.filebrowserBrowseUrl = 'includes/filemanager/'
	config.contentsCss = ['javascripts/bootstrap/css/bootstrap.css', 'stylesheets/calendar.css'];
	config.resize_enabled = false;
	config.filebrowserWindowHeight = '60%';
	config.filebrowserWindowWidth = '60%';
	config.htmlEncodeOutput = false;
	config.entities_greek = false;
	config.allowedContent = true;
	config.extraPlugins = 'wordcount,notification';
	
config.toolbar_Basic =
[
    { name: 'document',    items : [ 'Preview','Print','Source' ] },
    { name: 'clipboard',   items : [ 'PasteFromWord','Undo','Redo' ] },
    { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
    { name: 'paragraph',   items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
    { name: 'insert',      items : [ 'Image','Table','HorizontalRule','SpecialChar','PageBreak' ] },
    { name: 'styles',      items : [ 'Format','Font','FontSize' ] },
    { name: 'colors',      items : [ 'TextColor','BGColor' ] },
    { name: 'tools',       items : [ 'Maximize', '-','About' ] }
];	
config.toolbar = 'Basic';
config.skin = 'bootstrapck';
};
