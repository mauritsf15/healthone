<!DOCTYPE html>
<html>
    <?php
    include_once('defaults/head.php');
    ?>
    <body>
        <div class="container">
            <?php
            include_once ('defaults/header.php');
            include_once ('defaults/menu.php');
            include_once ('defaults/pictures.php');
            ?>
            <?php if(!empty($success)): ?>
                <div class="alert alert-success" role="alert">
                    <?=$success?>
                </div>
            <?php endif;?>
            <?php if(!empty($message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?=$message?>
                </div>
            <?php endif;?>
            <h4>Welkom, <?= $_SESSION['user']->first_name.'!' ?></h4>
            <div class="container mt-5">
                <h1>Admin - Products</h1>
                <hr>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Categorie</th>
                        <th scope="col">ID</th>
                        <th scope="col">Naam</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Beschrijving</th>
                        <th scope="col">Acties</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    global $products;
                    foreach($products as $product):
                    ?>
                    <tr>
                        <th scope="row"><?= $product->category ?></th>
                        <td><?= $product->id ?></td>
                        <td><?= $product->name ?></td>
                        <td><a href="/img/products/<?= $product->picture ?>">Foto</a></td>
                        <td><?= substr($product->description, 0, 20) ?>...</td>
                        <td>
                            <a href="/category/<?= $product->category ?>/<?= $product->id ?>" class="btn btn-primary mr-2">View</a>
                            <a href="/admin/edit/<?= $product->category ?>/<?= $product->id ?>" class="btn btn-primary mr-2">Edit</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="/admin/add" class="btn btn-success mt-3">Add Product</a>
            </div>
            <?php
            include_once ('defaults/footer.php');
            ?>
        </div>
        <script src="/js/main.js"></script>
    </body>
</html>
