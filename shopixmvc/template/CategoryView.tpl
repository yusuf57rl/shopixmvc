<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Shopix - MVC</title>

    <link rel="stylesheet" href="/src/View/style/custom.css">

</head>
<body>
<canvas id="c"></canvas>
<script src="/src/View/style/matrix.js"></script>

<!-- <div class="background"></div> -->

<section class="buttons">
    <br>
    <h1>&nbsp; Shopix</h1>

    <div class="space"></div>
    <div class="space"></div>
    <div class="buttonzsm">

        {foreach item=product from=$products}
            <a href="?page=product&id={$product->getId()}"> <button class="button-3"><h2> {$product->getName()} </h2></a></button> <div class="space"></div>
        {/foreach}


        <a href="index.php"><button class="button-3"><h2>Zurück</h2></button></a>

    </div>


</section>
<div class="cursor"></div>
<div class="cursor2"></div>


</body>
<script src="/src/View/style/mouse.js"></script>

</html>
