/*
Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
For licensing, see license.txt or http://cksource.com/ckfinder/license
*/

CKFinder.customConfig = function( config )
{
	// Define changes to default configuration here.
	// For the list of available options, check:
	// http://docs.cksource.com/ckfinder_2.x_api/symbols/CKFinder.config.html

	// Sample configuration options:
	// config.uiColor = '#BDE31E';
	// config.language = 'fr';
	// config.removePlugins = 'basket';
    config.filebrowserBrowseUrl = '/app/webroot/js/kcfinder/browse.php?type=files';
    config.filebrowserImageBrowseUrl = '/app/webroot/js/kcfinder/browse.php?type=images';
    config.filebrowserFlashBrowseUrl = '/app/webroot/js/kcfinder/browse.php?type=flash';
    config.filebrowserUploadUrl = '/app/webroot/js/kcfinder/upload.php?type=files';
    config.filebrowserImageUploadUrl = '/app/webroot/js/kcfinder/upload.php?type=images';
    config.filebrowserFlashUploadUrl = '/app/webroot/js/kcfinder/upload.php?type=flash';

};
