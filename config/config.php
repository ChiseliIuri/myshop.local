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
$templateFlex = 'main-flexbox';
$templateAdmin = 'admin';

// Constante ce definesc suf si pref a Paths spre file-urile sablonurilor(*.tpl)
define('TEMPLATE_PREFIX',"../views/{$template}/");
define('TEMPLATE_PREFIX_FLEX',"../views/{$templateFlex}/");
define('TEMPLATE_ADMIN_PREFIX',"../views/{$templateAdmin}/");
define('TEMPLATE_POSTFIX','.tpl');

//paths spre file-urile sablonurilor in webspace
define('TEMPLATE_WEB_PATH',"templates/{$template}");
define('TEMPLATE_WEB_PATH_FLEX',"templates/{$templateFlex}");
define('TEMPLATE_ADMIN_WEB_PATH',"templates/{$templateAdmin}");
//<

//>Initializarea sablonului Smarty
//put full path to Smarty.class.php
require('../library/Smarty/libs/Smarty.class.php');
$smarty = new Smarty();

//$smarty->setTemplateDir(TEMPLATE_PREFIX);
$smarty->setTemplateDir(TEMPLATE_PREFIX_FLEX);
$smarty->setCompileDir('../tmp/smarty/templates_c');
$smarty->setCacheDir('../tmp/smarty/cache');
$smarty->setConfigDir('../library/Smarty/configs');

//$smarty->assign('templateWebPath',TEMPLATE_WEB_PATH);
$smarty->assign('templateWebPath',TEMPLATE_WEB_PATH_FLEX);














