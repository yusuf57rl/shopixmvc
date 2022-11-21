<?php
/* Smarty version 4.2.1, created on 2022-11-21 14:04:23
  from 'C:\Users\Yusuf S\PhpstormProjects\shopixmvc\shopixmvc\template\CategoryView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_637b856788af87_25959789',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '106ec837e704937f5e5cc93612a64f80f169b889' => 
    array (
      0 => 'C:\\Users\\Yusuf S\\PhpstormProjects\\shopixmvc\\shopixmvc\\template\\CategoryView.tpl',
      1 => 1669039420,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_637b856788af87_25959789 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'category');
$_smarty_tpl->tpl_vars['category']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->do_else = false;
?>
    <a href="?page=category&id=<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
"> <button class="button-3"><h2> <?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
 </h2></a></button> <div class="space"></div>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
