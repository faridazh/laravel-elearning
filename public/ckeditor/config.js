/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'document', groups: [ 'document', 'mode', 'doctools' ] },
		{ name: 'others', groups: [ 'others' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'about', groups: [ 'about' ] }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'About,Font,Source';

    config.format_pre = { element: 'code', attributes: { 'class': 'block p-2 bg-gray-100 text-sm rounded-lg' } };

	// Set the most common block elements.
	// config.format_tags = 'p;h1;h2;h3;pre';

    // Enable all default text formats:
    config.format_tags = 'p;h1;h2;h3;h4;h5;h6;pre;address;div';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

	config.height = eval(this.element.$.rows*40) + 'px';

	// Youtube Plugin - Configuration
	// Video width:
	config.youtube_width = '640';

	// Video height:
	config.youtube_height = '480';

	// Make responsive (ignore width and height, fit to width):
	config.youtube_responsive = true;

	// Show related videos:
	config.youtube_related = false;

	// Use old embed code:
	config.youtube_older = false;

	// Enable privacy-enhanced mode:
	config.youtube_privacy = false;

	// Start video automatically:
	config.youtube_autoplay = false;

	// Show player controls:
	config.youtube_controls = true;

	// Disable the change of settings. The elements on the list will be disabled (but still visible). See the available element list below.
	config.youtube_disabled_fields = [];

	// List of UI elements:
	//	txtEmbed
	//	txtUrl
	//	txtWidth
	//	txtHeight
	//	chkResponsive
	//	chkNoEmbed
	//	chkRelated
	//	chkOlderCode
	//	chkPrivacy
	//	chkAutoplay
	//	txtStartAt
	//	chkControls

};
