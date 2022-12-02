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
    <h1>Shopix</h1>

    <div class="space"></div>
    <div class="space"></div>
    <div class="buttonzsm">

            {foreach $categories as $category}
                 <a href="?page=category&id={$category['id']}"> <button class="button-3"><h2> {$category['name']} </h2></a></button> <div class="space"></div>
            {/foreach}


        <div class="space"></div>



    </div>

</section>


<p class="copyright"><strong>&nbsp; &copy; Y.Senel &nbsp; - &nbsp;</strong> <a href="#">Impressum &nbsp;</a> | <a
            href="#">&nbsp; Datenschutzerklärung</a> | <a href="#">&nbsp; AGB</a></p>

<div class="cursor"></div>
<div class="cursor2"></div>


</body>
<script src="/src/View/style/mouse.js"></script>

</html>
