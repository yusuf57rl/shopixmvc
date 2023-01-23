<?php
/* Smarty version 4.3.0, created on 2023-01-23 10:10:19
  from 'C:\Users\Yusuf S\PhpstormProjects\shopixmvc\shopixmvc\template\CategoryView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_63ce5d0b99e0a7_99921238',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '106ec837e704937f5e5cc93612a64f80f169b889' => 
    array (
      0 => 'C:\\Users\\Yusuf S\\PhpstormProjects\\shopixmvc\\shopixmvc\\template\\CategoryView.tpl',
      1 => 1674468619,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63ce5d0b99e0a7_99921238 (Smarty_Internal_Template $_smarty_tpl) {
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
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
            <a href="?page=product&id=<?php echo $_smarty_tpl->tpl_vars['product']->value->getId();?>
"> <button class="button-3"><h2> <?php echo $_smarty_tpl->tpl_vars['product']->value->getName();?>
 </h2></a></button> <div class="space"></div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>


        <a href="index.php"><button class="button-3"><h2>Zurück</h2></button></a>

    </div>


</section>
<div class="cursor"></div>
<div class="cursor2"></div>


</body>
<?php echo '<script'; ?>
 src="/src/View/style/mouse.js"><?php echo '</script'; ?>
>

</html>
<?php }
}
