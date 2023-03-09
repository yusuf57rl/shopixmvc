<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ShopixMVC - Admin</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/album.css" rel="stylesheet">
</head>

<body>

<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">ShopixMVC - Admin</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                <strong>Shop</strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>

<main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">ShopixMVC - Admin</h1>
            <p class="lead text-muted">Adminbereich des Shopsystems by Y.S</p>
            <p>
                <a href="#" onclick="window.location.reload()" class="btn btn-primary my-2">Refresh</a>
                <a href="#" onclick="history.back()" class="btn btn-secondary my-2">Back</a>
            </p>
        </div>
    </section>
    <div class="album py-5 bg-light">
        <div class="container">
            <form method="post" action="?page=admin&action=editproduct&id={$product->getId()}">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{$product->getName()}">
                </div>
    <div class="form-group">
        <label for="description">Beschreibung:</label>
        <textarea class="form-control" id="description" name="description">{$product->getDescription()}</textarea>
    </div>
    <div class="form-group">
        <label for="price">Preis:</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{$product->getPrice()}">
    </div>
    <div class="form-group">
        <label for="category_id">Kategorie:</label>
        <select class="form-control" id="category_id" name="category_id">
            {foreach $categories as $category}
                <option value="{$category->getId()}"{if $category->getId() == $product->getCategoryId()} selected{/if}>{$category->getName()}</option>
            {/foreach}
        </select>
    </div>
                <input type="submit" name="update" value="Speichern">
    </form>
    </div>
    </div>
</main>
</body>
</html>