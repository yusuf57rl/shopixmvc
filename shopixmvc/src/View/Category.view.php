<?php

declare(strict_types=1);
require_once __DIR__.'/../Controller/GetController.php';
$get = new \App\Controller\GetController();
$getco = $get->geta($category);
?>

<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Shopix - MVC</title>

    <link rel="stylesheet" href="<?php echo __DIR__.'/style/custom.css'; ?>">

</head>
<body>
<canvas id="c"></canvas>
<script src="style/matrix.js"></script>

<!-- <div class="background"></div> -->

<section class="buttons">
    <br>
    <h1>&nbsp; Shopix</h1>

    <div class="space"></div>
    <div class="space"></div>
    <div class="buttonzsm">
        <a href="index.php?categoryid=1">
                <h2> Jacken &nbsp;</h2>
            </button></a>
            <div class="space"></div>
        <a href="index.php?categoryid=2">&nbsp;
        <button class="button-3">
                <h2> Hosen &nbsp;</h2>
            </button></a>
            <div class="space"></div>
        <a href="index.php?categoryid=3">&nbsp;
            <button class="button-3">
                <h2> T-Shirts &nbsp; </h2>
            </button></a>
            <div class="space"></div>


    </div>
</section>



<p class="copyright"><strong>&nbsp; &copy; Y. Senel &nbsp; - &nbsp;</strong> <a href="#">Impressum &nbsp;</a> | <a href="#">&nbsp; Datenschutzerklärung</a> | <a href="#">&nbsp; AGB</a> </p>

<div class="cursor"></div>
<div class="cursor2"></div>


</body>
<script src="style/mouse.js"></script>

</html>
