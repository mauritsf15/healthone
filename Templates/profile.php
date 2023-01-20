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
                <h1>Profiel</h1>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <img src="https://via.placeholder.com/150" class="img-thumbnail rounded-circle" alt="Profile Picture">
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4>Naam:</h4>
                                <p><?= $_SESSION['user']->first_name.' '.$_SESSION['user']->last_name ?></p>
                            </div>
                            <div class="col-sm-6">
                                <h4>Email-adres:</h4>
                                <p><?= urldecode($_SESSION['user']->email) ?></p>
                            </div>
                        </div>
                        <a href="/member/editprofile" class="btn btn-primary mt-3">Pas gegevens aan</a>&nbsp;<a href="/member/changepassword" class="btn btn-primary mt-3">Verander wachtwoord</a>
                    </div>
                </div>
            </div>
            <?php
            include_once ('defaults/footer.php');
            ?>
        </div>
    </body>
</html>
