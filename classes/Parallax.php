<?php

class Parallax
{
    public function addParallaxImage($objTemplate, $arrData, $objModule)
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

    public function setParallaxTemplate($objTemplate)
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