<?php
/* Smarty version 4.3.0, created on 2023-01-23 10:11:36
  from 'C:\Users\Yusuf S\PhpstormProjects\shopixmvc\shopixmvc\template\ProductView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_63ce5d584eab66_02624224',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8de5ac9615ebed186516727124c22c99d763b880' => 
    array (
      0 => 'C:\\Users\\Yusuf S\\PhpstormProjects\\shopixmvc\\shopixmvc\\template\\ProductView.tpl',
      1 => 1674468694,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63ce5d584eab66_02624224 (Smarty_Internal_Template $_smarty_tpl) {
?><html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Shopix - MVC</title>

    <link rel="stylesheet" type="text/css" href="/src/View/style/custom.css">

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

    <h2>Name:<br><?php echo $_smarty_tpl->tpl_vars['product']->value->getName();?>
 </h2><br /><h2>Beschreibung:<br><?php echo $_smarty_tpl->tpl_vars['product']->value->getDescription();?>
</h2> <br><h2>Preis: <?php echo $_smarty_tpl->tpl_vars['product']->value->getPrice();?>
 <br></h2>";

        <div class="space"></div>
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
