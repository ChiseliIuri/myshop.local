<?php /* Smarty version Smarty-3.1.6, created on 2021-09-14 10:20:38
         compiled from "../views/default\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:914160eadea332e3d7-78960529%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9797888b337e03f99b06385b60a372bbb52d5e02' => 
    array (
      0 => '../views/default\\header.tpl',
      1 => 1631522642,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '914160eadea332e3d7-78960529',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_60eadea33669b',
  'variables' => 
  array (
    'head' => 0,
    'templateWebPath' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_60eadea33669b')) {function content_60eadea33669b($_smarty_tpl) {?><html>
<head>
    <title><?php echo $_smarty_tpl->tpl_vars['head']->value;?>
</title>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
/css/main.css" type="text/css"/>

</head>

<body>
<div id="header">
    <h1>my shop- internet magazin</h1>
</div>

<?php echo $_smarty_tpl->getSubTemplate ('leftColumn.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div id="centerColumn">
    centerColumn<?php }} ?>