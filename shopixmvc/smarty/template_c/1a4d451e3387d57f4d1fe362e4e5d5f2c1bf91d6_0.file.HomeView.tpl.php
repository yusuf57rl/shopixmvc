<?php
/* Smarty version 4.3.0, created on 2023-01-23 10:15:34
  from 'C:\Users\Yusuf S\PhpstormProjects\shopixmvc\shopixmvc\template\HomeView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_63ce5e467014b3_44726481',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1a4d451e3387d57f4d1fe362e4e5d5f2c1bf91d6' => 
    array (
      0 => 'C:\\Users\\Yusuf S\\PhpstormProjects\\shopixmvc\\shopixmvc\\template\\HomeView.tpl',
      1 => 1674468904,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63ce5e467014b3_44726481 (Smarty_Internal_Template $_smarty_tpl) {
?><html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Shopix - MVC</title>

    <link rel="stylesheet" href="/src/View/style/custom.css">

</head>
<body>
<canvas id="c"></canvas>
<?php echo '<script'; ?>
 src="/src/View/style/matrix.js"><?php echo '</script'; ?>
>

<!-- <div class="background"></div> -->


<section class="buttons">
    <br>
    <h1>&nbsp; Shopix</h1>

    <div class="space"></div>
    <div class="space"></div>
    <div class="buttonzsm">

        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'category');
$_smarty_tpl->tpl_vars['category']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->do_else = false;
?>
            <a href="?page=category&id=<?php echo $_smarty_tpl->tpl_vars['category']->value->getId();?>
"> <button class="button-3"><h2> <?php echo $_smarty_tpl->tpl_vars['category']->value->getName();?>
 </h2></a></button> <div class="space"></div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

        <div class="space"></div>



    </div>

</section>


<div class="cursor"></div>
<div class="cursor2"></div>


</body>

</html>
<?php }
}
