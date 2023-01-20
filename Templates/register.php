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
    <form action="/register" method="POST">
        <div class="row">
            <div class="form-group col-12 col-md-6">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Enter email" required>
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="password">Password</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Enter password" required>
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="firstName">First Name</label>
                <input name="firstname" type="text" class="form-control" id="firstName" placeholder="Enter first name" required>
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="lastName">Last Name</label>
                <input name="lastname" type="text" class="form-control" id="lastName" placeholder="Enter last name" required>
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