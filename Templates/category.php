<!DOCTYPE html>
<html>
<?php
include_once('defaults/head.php');
?>
<body>
    <div class="container">
        <?php
        include_once('defaults/header.php');
        include_once('defaults/menu.php');
        include_once('defaults/pictures.php');
        ?>
        <?php global $category ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item"><a href="/categories">Categories</a></li>
                <li class="breadcrumb-item"><a href="/category/<?= $category[0]->id ?>"><?= $category[0]->name ?></a></li>
            </ol>
        </nav>
        <?php global $product ?>
        <div class="row gx-3">
        <?php foreach ($product as $item): ?>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <a href="/category/<?= $item->category ?>/<?= $item->id ?>">
                            <img class="product-img img-responsive center-block" src="/img/products/<?= $item->picture ?>">
                        </a>
                        <div class="card-title mb-3"><?= $item->name ?></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
        <?php
        include_once('defaults/footer.php');

        ?>
    </div>
</body>
</html>