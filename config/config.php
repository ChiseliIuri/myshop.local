<?php

/**
 *
 * FILE DE SETARI
 *
*/

//>Constante pentru apelarea controlerilor
const PathPrefix = '../controllers/';
define('PathPostfix', 'Controller.php');
//<

//> sablonul folosit
$template = 'default';

// Constante ce definesc suf si pref a Paths spre file-urile sablonurilor(*.tpl)
define('TEMPLATE_PREFIX',"../views/{$template}/");
define('TEMPLATE_POSTFIX','.tpl');

//paths spre file-urile sablonurilor in webspace
define('TEMPLATE_WEB_PATH',"/myshop.local/www/templates/{$template}");
//<

//>Initializarea sablonului Smarty
//put full path to Smarty.class.php
require('../library/Smarty/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir(TEMPLATE_PREFIX);
$smarty->setCompileDir('../tmp/smarty/templates_c');
$smarty->setCacheDir('../tmp/smarty/cache');
$smarty->setConfigDir('../library/Smarty/configs');

$smarty->assign('templateWebPath',TEMPLATE_WEB_PATH);














