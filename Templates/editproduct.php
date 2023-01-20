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
    global $edit;
    global $params;
    ?>
    <?php if(!empty($success)): ?>
        <div class="alert alert-success" role="alert">
            <?=$success?>
        </div>
    <?php endif; ?>
    <div class="container mt-5">
        <h1><?php if($edit) {echo 'Verander product';} else {echo 'Nieuw product';} ?></h1>
        <hr>
        <form action="/admin/<?php if($edit) {echo 'edit/'.$params[3].'/'.$params[4];} else {echo 'add';} ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" id="name" value="<?php if($edit) {echo $product[0]->name;} ?>" required>
            </div><br>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" rows="3" required><?php if($edit) {echo $product[0]->description;} ?></textarea>
            </div><br>
            <?php if(!$edit): ?>
            <div class="form-group">
                <label for="category">Categorie</label>
                <select name="category" id="category" class="form-select" aria-label="Select category" required>
                    <option value="0">Roetrainer</option>
                    <option value="1">Crosstrainer</option>
                    <option value="2">Hometrainer</option>
                    <option value="3">Loopband</option>
                </select>
            <br>
            <div class="form-group">
                <label for="picture">Foto:</label>
                <input name="picture" type="file" class="form-control-file" id="picture" required>
            </div>
            <?php endif; ?>
            <br><button name="submit" type="submit" class="btn btn-primary"><?php if($edit) {echo 'Sla veranderingen op';} else {echo 'Voeg nieuw product toe';} ?></button>
        </form>
    </div>
    <?php
    include_once('defaults/footer.php');
    ?>
</div>
</body>
</html>