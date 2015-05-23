/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.plugins.add( 'about', {
	requires: 'dialog',
	// jscs:disable maximumLineLength
	lang: 'en,eu,uk,vi', // %REMOVE_LINE_CORE%
	// jscs:enable maximumLineLength
	icons: 'about', // %REMOVE_LINE_CORE%
	hidpi: true, // %REMOVE_LINE_CORE%
	init: function( editor ) {
		var command = editor.addCommand( 'about', new CKEDITOR.dialogCommand( 'about' ) );
		command.modes = { wysiwyg: 1, source: 1 };
		command.canUndo = false;
		command.readOnly = 1;

		editor.ui.addButton && editor.ui.addButton( 'About', {
			label: editor.lang.about.title,
			command: 'about',
			toolbar: 'about'
		} );

		CKEDITOR.dialog.add( 'about', this.path + 'dialogs/about.js' );
	}
} );
