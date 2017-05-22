<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'Parallax' => 'system/modules/xl-parallax/classes/Parallax.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'xl_parallax_mod_article' => 'system/modules/xl-parallax/templates',
));
