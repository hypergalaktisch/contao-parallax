<?php

$GLOBALS['TL_HOOKS']['compileArticle'][] = array('Parallax', 'addParallaxImage');
$GLOBALS['TL_HOOKS']['parseTemplate'][] = array('Parallax', 'setParallaxTemplate');