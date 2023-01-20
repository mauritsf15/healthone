<?php
global $params;
//$params[2] is de action en $params[3] een getal die de action nodig heeft
//check if user has role admin
//require('../Modules/login.php');
//require('../Modules/logout.php');

$memberParams = explode('?', $params[2], 2);

if (!isMember() && !isAdmin()) {
    logout();
    header ("location:/home");
} else {
    switch ($memberParams[0]) {

//        case 'home':
//            break;

//        case 'products':
//            break;
        case 'profile':
            include_once "../Templates/profile.php";
            break;
        case 'editprofile':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['submit'])) {
                    $user = $_SESSION['user'];
                    $req = changeDetails($user->id, $_POST['firstname'], $_POST['lastname'], $_POST['email']);
                    $_SESSION['user'] = $req[0];
                    header ('Location: /member/profile?success=edited_details');
                } else {
                    header ('Location: /member/editprofile?error=wrong_method');
                }
            } else {
                include_once "../Templates/editprofile.php";
            }
            break;
        case 'changepassword':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['submit'])) {
                    $user = $_SESSION['user'];
                    if ($_POST['current_password'] == $user->password) {
                        if ($_POST['newpassword'] == $_POST['confirm_newpassword'] && strlen($_POST['newpassword']) < 6 || preg_match('@[0-9]@', $_POST['newpassword'])) {
                            $req = changePassword($user->id, $_POST['newpassword']);
                            $_SESSION['user'] = $req[0];
                            header ('Location: /member/profile?success=edited_details');
                        } else {
                            header ('Location: /member/changepassword?error=bad_password');
                        }
                    } else {
                        header ('Location: /member/changepassword?error=pass_no_match');
                    }
                } else {
                    header ('Location: /member/changepassword?error=wrong_method');
                }
            } else {
                include_once "../Templates/changepassword.php";
            }
            break;

//        case 'categories':
//            break;
//
//        case 'category':
//            break;
//
//        case 'product':
//            break;

        case 'review':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['submit'])) {
                    $ids = explode('/', $_SERVER['HTTP_REFERER']);
                    $category_id = $ids[4];
                    $product_id = $ids[5];
                    $firstname = $_SESSION['user']->first_name;
                    $lastname = $_SESSION['user']->last_name;
                    $description = $_POST['description'];
                    $stars = $_POST['stars'];
                    $resp = writeReview($product_id, $category_id, $firstname, $lastname, $description, $stars);
                    if ($resp == 'done') {
                        header('Location: /category/'.$category_id.'/'.$product_id.'?success=review_made');
                    }
                } else {
                    header ('Location /home?error=wrong_method');
                }
            } else {
                header('Location: /home?error=wrong_method');
            }
            break;
        default:
            header('Location: /member/profile');
            break;
    }
}