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
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Beschreibung</th>
            <th scope="col">Preis</th>
            <th scope="col">Aktionen</th>
        </tr>
        </thead>
        <tbody>
        {foreach $products as $product}
            <tr>
                <th scope="row">{$product->getId()}</th>
                <td>{$product->getName()}</td>
                <td>{$product->getDescription()}</td>
                <td>{$product->getPrice()}</td>
                <td>
                    <a href="?page=admin&action=edit_product&id={$product->getId()}" class="btn btn-primary">Bearbeiten</a>
                    <a href="?page=admin&action=delete_product&id={$product->getId()}" class="btn btn-danger">Löschen</a>
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>
    <div class="text-right">
        <a href="?page=admin&action=add_product" class="btn btn-primary">Produkt hinzufügen</a>
        <a href="?page=admin" class="btn btn-secondary">Zurück zur Übersicht</a>
    </div>
</main>
</body>
</html>