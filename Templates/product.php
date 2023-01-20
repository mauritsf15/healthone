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
    global $product;
    global $category;
    ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/categories">Categories</a></li>
            <li class="breadcrumb-item"><a href="/category/<?= $category[0]->id ?>"><?= $category[0]->name ?></a></li>
            <li class="breadcrumb-item"><a href="/category/<?= $category[0]->id ?>/<?= $product[0]->id ?>"><?= $product[0]->name ?></a></li>
        </ol>
    </nav>
    <?php if(!empty($success)): ?>
        <div class="alert alert-success" role="alert">
            <?=$success?>
        </div>
    <?php endif;?>
    <div class="row g-3">
        <div class="col-12 col-md-6"><img class="product-img img-responsive center-block" src="/img/products/<?= $product[0]->picture ?>"></div>
        <div class="col-12 col-md-6">
            <h2><?= $product[0]->name ?></h2>
            <p class="text-body"><?= $product[0]->description ?></p>
            <?php if (isMember()): ?>
            <form action="/member/review" method="POST">
                <label for="review">Schrijf een recensie!</label>
                <textarea class="form-control" id="review" name="description" required></textarea><br>
                <label for="stars" class="form-label">Sterren</label>
                <select id="stars" name="stars" class="form-check" aria-label="Default select example" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select><br>
                <input type="submit" class="btn btn-primary form-control" name="submit" value="Posten">
            </form>
            <?php endif; ?>
        </div>
    </div>
    <br>
    <div class="row g-3">
        <?php global $reviews ?>
        <?php foreach ($reviews as $review): ?>
            <div class="col-12 col-md-6">
                <div class="review">
                    <div class="review-header">
                        <h4><?= $review->name ?></h4>
                        <i class="date"><?= $review->date ?> - <?= $review->stars ?> sterren</i>
                        <p><?= $review->description ?></p>
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