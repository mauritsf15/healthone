<?php

function checkLogin(string $email, string $password):string
{
    global $pdo;
    $login = $pdo->query("SELECT * FROM `users` WHERE `email` = '".urlencode($email)."' AND `password` = '".$password."'")->fetchAll(PDO::FETCH_CLASS, 'User');
    if (count($login) == 0) {
        return 'invalid_credentials';
    } else {
        $_SESSION['user'] = $login[0];
        return 'done';
    }
}

function isAdmin():bool
{
    //controleer of er ingelogd is en de user de rol admin heeft
    if(isset($_SESSION['user'])&&!empty($_SESSION['user']))
    {
        $user=$_SESSION['user'];
        if ($user->role == "admin")
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    return false;
}

function isMember():bool
{
    //controleer of er ingelogd is en de user de rol admin heeft
    if(isset($_SESSION['user'])&&!empty($_SESSION['user']))
    {
        $user=$_SESSION['user'];
        if ($user->role === false)
        {
            return true;
        }
        else
        {
            return false;
        }
    } else {
        return false;
    }
}

function makeRegistration(string $email, string $password, string $firstname, string $lastname):string
{
    global $pdo;
    if (strlen($password) < 6 || !preg_match('@[0-9]@', $password) || !preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password)) {
        return 'bad_password';
    } else {
        $email = urlencode($email);
        $emails = $pdo->query("SELECT id FROM users WHERE email = '".$email."'")->fetchAll(PDO::FETCH_CLASS, 'OnlyID');
        if (count($emails) > 0) {
            return 'email_in_use';
        }
        $ids = $pdo->query("SELECT id FROM users")->fetchAll(PDO::FETCH_CLASS, 'OnlyID');
        $id = count($ids);
        $reg = $pdo->prepare("INSERT INTO users (id, email, password, first_name, last_name, role) VALUES (:bid, :bemail, :bpassword, :bfirstname, :blastname, 0)");
        $reg->bindParam('bid', $id);

        $reg->bindParam('bemail', $email);
        $reg->bindParam('bpassword', $password);
        $reg->bindParam('bfirstname', $firstname);
        $reg->bindParam('blastname', $lastname);
        $reg->execute();
        return 'done';
    }
}