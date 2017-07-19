/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.mathJaxClass = 'my-math-box';
//	config.mathJaxLib = 'Public/static/mathJax/MathJax.js?config=TeX-AMS_HTML';
	config.mathJaxLib = 'Public/static/mathJax/MathJax.js?config=TeX-AMS_HTML';
	config.height = 450;
	config.extraPlugins = 'question';
};


