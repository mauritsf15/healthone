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
    <?php if(!empty($message)): ?>
        <div class="alert alert-danger" role="alert">
            <?=$message?>
        </div>
    <?php endif;?>
    <?php if(!empty($success)): ?>
        <div class="alert alert-success" role="alert">
            <?=$success?>
        </div>
    <?php endif;?>
    <form method="POST" action="/login">
        <div class="row">
            <div class="form-group">
                <label for="email">Email-adres</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We zullen nooit je email delen met anderen.</small>
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input name="password" type="password" class="form-control" id="password">
            </div>
            <br><br><br>
            <div class="col-1 col-md-4"></div>
            <button type="submit" name="submit" class="btn btn-primary col-10 col-md-4">Submit</button>
        </div>
    </form>
    <?php
    include_once('defaults/footer.php');
    ?>
</div>
</body>
</html>