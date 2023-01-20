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
    <div class="container mt-5">
        <h2>Pas gegevens aan</h2>
        <hr>
        <form action="/member/editprofile" method="POST">
            <div class="form-group">
                <label for="name">Voornaam</label>
                <input name="firstname" type="text" class="form-control" id="name" value="<?= $_SESSION['user']->first_name ?>" required>
            </div>
            <div class="form-group">
                <label for="name">Achternaam</label>
                <input name="lastname" type="text" class="form-control" id="name" value="<?= $_SESSION['user']->last_name ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email-adres</label>
                <input name="email" type="email" class="form-control" id="email" value="<?= urldecode($_SESSION['user']->email) ?>" required>
            </div><br>
            <button name="submit" type="submit" class="btn btn-primary">Sla veranderingen op</button>
        </form>
    </div>
    <?php
    include_once ('defaults/footer.php');
    ?>
</div>
</body>
</html>
