<?php
/**
 * @copyright  Georg Jaedicke
 * @author     Georg Jaedicke (hypergalaktisch)
 * @package    Parallax
 * @license    LGPL-3.0+
 * @see	       https://github.com/hypergalaktisch/contao-parallax
 */

namespace Hypergalaktisch\ParallaxBundle\EventListener;

use Contao\CoreBundle\Framework\ContaoFrameworkInterface;

class HookListener
{
    /**
     * @var ContaoFrameworkInterface
     */
    private $framework;

    /**
     * Constructor.
     *
     * @param ContaoFrameworkInterface $framework
     */
    public function __construct(ContaoFrameworkInterface $framework)
    {
        $this->framework = $framework;
    }

    public function compileArticle($objTemplate, $arrData, $objModule)
    {
        // Add an parallax background image
        if ($objTemplate->xlParallaxAddImage && $objTemplate->xlParallaxSingleSRC != '') {
            $objModel = \FilesModel::findByUuid($objTemplate->xlParallaxSingleSRC);

            if ($objModel !== null && is_file(TL_ROOT . '/' . $objModel->path)) {

                $objTemplate->parallaxSingleSRC = $objModel->path;

                // Override the default image size
                if ($objTemplate->xlParallaxSize != '') {
                    $size = \StringUtil::deserialize($objTemplate->xlParallaxSize);

                    if ($size[0] > 0 || $size[1] > 0 || is_numeric($size[2])) {
                        $objTemplate->parallaxSingleSRC = \Image::create($objModel->path, $size)->executeResize()->getResizedPath();
                    }
                }

                // Parallax Options
                $position = deserialize($arrData['xlParallaxPosition']);
                $objTemplate->parallaxPosition = array("x" => $position[0], "y" => $position[1]);
                $objTemplate->parallaxBleed = $arrData['xlParallaxBleed'];
            }
        }
    }

    public function parseTemplate($objTemplate)
    {
        if ($objTemplate->getName() == 'mod_article') {
            if (!empty($objTemplate->parallaxSingleSRC)) {
                $objTemplate->setName('xl_parallax_mod_article');
            }
        }
    }
}
