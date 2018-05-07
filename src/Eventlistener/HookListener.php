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
        $addParallax = $arrData['xlParallaxAddImage'];
        $parallaxSRC = $arrData['xlParallaxSingleSRC'];
        if ($addParallax == 1) {
            if ($parallaxSRC == '') {
                return '';
            }

            $objFile = \FilesModel::findByUuid($parallaxSRC);

            if ($objFile === null) {
                if (!\Validator::isUuid($parallaxSRC)) {
                    return '<p class="error">' . $GLOBALS['TL_LANG']['ERR']['version2format'] . '</p>';
                }
                return '';
            }

            if (!is_file(TL_ROOT . '/' . $objFile->path)) {
                return '';
            }

            $parallaxSRC = $objFile->path;
            $objTemplate->parallaxSRC = $parallaxSRC;

            # Parallax Options
            $position = deserialize($arrData['xlParallaxPosition']);
            $objTemplate->parallaxPosition = array("x" => $position[0], "y" => $position[1]);
            $objTemplate->parallaxBleed = $arrData['xlParallaxBleed'];
        }
    }

    public function parseTemplate($objTemplate)
    {
        if ($objTemplate->getName() == 'mod_article')
        {
            $parallaxSRC = $objTemplate->__get('parallaxSRC');
            if (!empty($parallaxSRC)) {
                $objTemplate->setName('xl_parallax_mod_article');
            }
        }
    }
}
