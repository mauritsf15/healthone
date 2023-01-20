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
        <h2>Verander wachtwoord</h2>
        <form action="/member/changepassword" method="POST">
            <div class="form-group">
                <label for="current-password">Wachtwoord nu</label>
                <input name="current_password" type="password" class="form-control" id="current-password" placeholder="********" required>
            </div>
            <div class="form-group">
                <label for="new-password">Nieuw wachtwoord</label>
                <input name="newpassword" type="password" class="form-control" id="new-password" placeholder="********" required>
            </div>
            <div class="form-group">
                <label for="confirm-new-password">Bevestig nieuw wachtwoord</label>
                <input name="confirm_newpassword" type="password" class="form-control" id="confirm-new-password" placeholder="********" required>
            </div><br>
            <button name="submit" type="submit" class="btn btn-primary">Verander wachtwoord</button>
        </form>
    </div>
    <?php
    include_once ('defaults/footer.php');
    ?>
</div>
</body>
</html>
