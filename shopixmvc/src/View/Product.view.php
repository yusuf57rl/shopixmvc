<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Shopix - MVC</title>

    <link rel="stylesheet" type="text/css" href="/src/View/style/custom.css">

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
            <?php

if(isset($product)) {
    echo "<h2>Name:<br>" . $product["name"] . "</h2><br /><h2>Beschreibung:<br>" . $product["description"] . "</h2> <br><h2>Preis: &nbsp;" . $product["price"] . " <br></h2>";
} else {
    echo "Dieses Produkt existiert nicht!";
}
            ?>
        <div class="space"></div>
        <a href="index.php"><button class="button-3"><h2>Zurück</h2></button></a>


    </div>
</section>
<div class="cursor"></div>
<div class="cursor2"></div>


</body>
<script src="/src/View/style/mouse.js"></script>

</html>
