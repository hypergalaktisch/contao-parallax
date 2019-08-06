<?php
/**
 * @copyright  Georg Jaedicke
 * @author     Georg Jaedicke (hypergalaktisch)
 * @package    Parallax
 * @license    LGPL-3.0+
 * @see	       https://github.com/hypergalaktisch/contao-parallax
 */

System::loadLanguageFile('tl_content');

/**
* Extend default palette
*/
Contao\CoreBundle\DataContainer\PaletteManipulator::create()
   ->addLegend('xlParallax_legend', 'syndication_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE, true)
   ->addField('xlParallaxAddImage', 'xlParallax_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
   ->applyToPalette('default', 'tl_article')
;
Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addField('xlParallaxAddImage', 'protected', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_AFTER)
    ->applyToPalette('__selector__', 'tl_article');
;

$GLOBALS['TL_DCA']['tl_article']['subpalettes']['xlParallaxAddImage'] = 'xlParallaxSingleSRC,xlParallaxSize,xlParallaxPosition,xlParallaxBleed';

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
$GLOBALS['TL_DCA']['tl_article']['fields']['xlParallaxSize'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['size'],
    'exclude'                 => true,
    'inputType'               => 'imageSize',
    'reference'               => &$GLOBALS['TL_LANG']['MSC'],
    'eval'                    => array('rgxp'=>'natural', 'includeBlankOption'=>true, 'nospace'=>true, 'helpwizard'=>true, 'tl_class'=>'w50'),
    'options_callback' => function ()
    {
      return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
    },
    'sql'                     => "varchar(64) NOT NULL default ''"
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
