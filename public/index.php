<?php
require '../Modules/categories.php';
require '../Modules/login.php';
require '../Modules/logout.php';
require '../Modules/database.php';
require '../Modules/common.php';

session_start();
//var_dump($_SESSION);
//var_dump($_POST);
$message="";

$request = $_SERVER['REQUEST_URI'];

$params = explode("/", $request);
$sparams = explode("/", $request, 2);
//print_r($request);
$title = "HealthOne";
$titleSuffix = "";

//$params[1] is de action
//$params[2] is een extra getal die de action nodig heeft om zijn taak uit te

//var_dump($params);
$oldParams = explode('?', $params[1], 2);
$newParams = explode('?', $sparams[1], 2);
if (count($newParams) == 2) {
    $param2 = explode('=', $newParams[1], 2);
    if ($param2[0] == 'error') {
        if ($param2[1] == 'invalid_email') {
            $message = 'Je email klopt niet. Probeer het opnieuw';
        } else if ($param2[1] == 'bad_password') {
            $message = 'Je wachtwoord moet minimaal 6 tekens hebben, waaronder minimaal 1 kleine letter, 1 grote letter en 1 cijfer';
        } else if ($param2[1] == 'email_in_use') {
            $message = 'Dit email-adres wordt al gebruikt!';
        } else if ($param2[1] == 'invalid_credentials') {
            $message = 'Je email en wachtwoord komen niet overeen.';
        } else if ($param2[1] == 'wrong_method') {
            $message = 'De methode waarop je op de pagina kwam was niet correct. Probeer opnieuw.';
        } else if ($param2[1] == 'pass_no_match') {
            $message = 'Je wachtwoorden komen niet overeen.';
        } else if ($param2[1] == 'upload_failed') {
            $message = 'De upload was niet goed gegaan Probeer het opnieuw.';
        } else {
            $message = 'Er is iets fout gegaan. Error code: '.$param2[1];
        }
    } else if ($param2[0] == 'success') {
        if ($param2[1] == 'account_made') {
            $success = 'Je account is aangemaakt! Je kan nu inloggen.';
        } else if ($param2[1] == 'logged_in') {
            $success = 'Je bent ingelogd!';
        } else if ($param2[1] == 'logged_out') {
            $success = 'Je bent uitgelogd!';
        } else if ($param2[1] == 'review_made') {
            $success = 'Je review is aangemaakt!';
        } else if ($param2[1] == 'edited_details') {
            $success = 'Je gegevens zijn aangepast!';
        } else if ($param2[1] == 'product_made') {
            $success = 'Het product is aangemaakt!';
        } else if ($param2[1] == 'product_updated') {
            $success = 'Het product is geüpdatet!';
        } else {
            $success = 'Er is iets goed gegaan maar we weten niet wat... Interessant! De code is: '.$param2[1];
        }
    }
}

switch ($oldParams[0]) {

    case 'categories':
        $titleSuffix = ' | Categories';
        $categories = getCategories();
        //var_dump($categories);die;
        include_once "../Templates/categories.php";
        break;

    case 'category':
        if (isset($params[3])) {
            $category = getCategory($params[2]);
            $product = getProduct($category[0]->id, explode('?', $params[3])[0]);
            $reviews = getReviews($category[0]->id, explode('?', $params[3])[0]);
            $titleSuffix = ' | ' . $product[0]->name;
            include_once "../Templates/product.php";
        } else if ($params[2] == '0' || $params[2] == '1' || $params[2] == '2' || $params[2] == '3') {
            $category = getCategory($params[2]);
            $product = getProduct($params[2]);
            $titleSuffix = ' | ' . $category[0]->name;
            include_once "../Templates/category.php";
        } else {
            header('Location: /categories');
        }
        break;

//    case 'product':
//        break;

    case 'login':
        $titleSuffix = ' | Login';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['submit'])) {
                $login = checkLogin($_POST['email'], $_POST['password']);
                if ($login == 'done') {
                    header('Location: home?success=logged_in');
                } else {
                    header('Location: /login?error='.$login);
                }
            } else {
                header ('Location /login?error=wrong_method');
            }
        }
        include_once "../Templates/login.php";
        break;

    case 'logout':
        logout();
        header('Location: /home?success=logged_out');
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $titleSuffix = ' | Register';
            include_once "../Templates/register.php";
            break;
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['submit'])) {
                if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
                    $req = makeRegistration($_POST['email'], $_POST['password'], $_POST['firstname'], $_POST['lastname']);
                    if ($req == 'done') {
                        header('Location: /login?success=account_made');
                    } else {
                        header('Location: /register?error='.$req);
                    }
                    break;
                } else {
                    header('Location: /register?error=invalid_email');
                    break;
                }
            } else {
                header('Location: /home');
                break;
            }
        } else {
            header('Location: /home');
            break;
        }

    case 'contact':
        $titleSuffix = ' | Contact';
        include_once "../Templates/contact.php";
        break;

    case 'admin':
        include_once ('admin.php');
        break;

    case 'member':
        include_once ('member.php');
        break;

    default:
        $titleSuffix = ' | Home';
        include_once "../Templates/home.php";
}
