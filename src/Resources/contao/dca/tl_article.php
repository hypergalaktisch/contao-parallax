<?php
/**
 * @copyright  Georg Jaedicke
 * @author     Georg Jaedicke (hypergalaktisch)
 * @package    Parallax
 * @license    LGPL-3.0+
 * @see	       https://github.com/hypergalaktisch/contao-parallax
 */

array_push($GLOBALS['TL_DCA']['tl_article']['palettes']['__selector__'], 'xlParallaxAddImage');
$GLOBALS['TL_DCA']['tl_article']['palettes']['default'] = str_replace(
    '{syndication_legend}',
    '{xlParallax_legend:hide},xlParallaxAddImage;{syndication_legend}',
    $GLOBALS['TL_DCA']['tl_article']['palettes']['default']
);
$GLOBALS['TL_DCA']['tl_article']['subpalettes']['xlParallaxAddImage'] = 'xlParallaxSingleSRC,xlParallaxPosition,xlParallaxBleed';

$GLOBALS['TL_DCA']['tl_article']['fields']['xlParallaxAddImage'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_article']['xlParallaxAddImage'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => array('submitOnChange' => true),
    'sql'       => "char(1) NOT NULL default ''",
);
$GLOBALS['TL_DCA']['tl_article']['fields']['xlParallaxSingleSRC'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_article']['xlParallaxSingleSRC'],
    'exclude'   => true,
    'inputType' => 'fileTree',
    'eval'      => array('filesOnly' => true, 'fieldType' => 'radio', 'mandatory' => true, 'tl_class' => 'clr'),
    'sql'       => "binary(16) NULL",
);
$GLOBALS['TL_DCA']['tl_article']['fields']['xlParallaxPosition'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_article']['xlParallaxPosition'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array('multiple' => true, 'size' => 2, 'rgxp' => 'alnum', 'nospace' => true, 'tl_class' => 'w50'),
    'sql'       => "varchar(64) NOT NULL default ''",
);
$GLOBALS['TL_DCA']['tl_article']['fields']['xlParallaxBleed'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_article']['xlParallaxBleed'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array('rgxp' => 'digit', 'tl_class' => 'w50'),
    'sql'       => "varchar(64) NOT NULL default ''",
);
