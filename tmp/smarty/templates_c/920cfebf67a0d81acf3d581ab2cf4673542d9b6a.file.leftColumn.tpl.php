<?php /* Smarty version Smarty-3.1.6, created on 2021-07-11 20:48:55
         compiled from "../views/default\leftColumn.tpl" */ ?>
<?php /*%%SmartyHeaderCode:263460eadea33730b8-35760733%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '920cfebf67a0d81acf3d581ab2cf4673542d9b6a' => 
    array (
      0 => '../views/default\\leftColumn.tpl',
      1 => 1626029296,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '263460eadea33730b8-35760733',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_60eadea3377f6',
  'variables' => 
  array (
    'rsCategories' => 0,
    'item' => 0,
    'itemChild' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_60eadea3377f6')) {function content_60eadea3377f6($_smarty_tpl) {?><div id="leftColumn">
    <div id="leftMenu">
        <div class="menuCaption">Menu:</div>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rsCategories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
            <a href="#"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a><br/>
            <?php if (isset($_smarty_tpl->tpl_vars['item']->value['children'])){?>
                <?php  $_smarty_tpl->tpl_vars['itemChild'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['itemChild']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['itemChild']->key => $_smarty_tpl->tpl_vars['itemChild']->value){
$_smarty_tpl->tpl_vars['itemChild']->_loop = true;
?>
                    --<a href="#"><?php echo $_smarty_tpl->tpl_vars['itemChild']->value['name'];?>
</a><br/>
                <?php } ?>
            <?php }?>
        <?php } ?>
    </div>
</div><?php }} ?>