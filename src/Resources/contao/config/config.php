<?php
/**
 * @copyright  Georg Jaedicke
 * @author     Georg Jaedicke (hypergalaktisch)
 * @package    Parallax
 * @license    LGPL-3.0+
 * @see	       https://github.com/hypergalaktisch/contao-parallax
 */

$GLOBALS['TL_HOOKS']['compileArticle']['hypergalaktisch_parallax'] = ['hypergalaktisch_parallax.listener.hooks', 'compileArticle'];
$GLOBALS['TL_HOOKS']['parseTemplate']['hypergalaktisch_parallax'] = ['hypergalaktisch_parallax.listener.hooks', 'parseTemplate'];
