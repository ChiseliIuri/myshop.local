<?php

/**
 *
 * FILE DE SETARI
 *
*/
$smarty = new Smarty();
$smarty->setTemplateDir(ConstConfig::TEMPLATE_PREFIX_FLEX);
$smarty->setCompileDir('../tmp/smarty/templates_c');
$smarty->setCacheDir('../tmp/smarty/cache');
$smarty->setConfigDir('../library/Smarty/configs');
$smarty->assign('templateWebPath',ConstConfig::TEMPLATE_WEB_PATH_FLEX);














