<?php
global $params;

$memberParams = explode('?', $params[2], 2);

$target_dir = 'img/products/';

//check if user has role admin
if (!isAdmin()) {
    logout();
    header ("location:/home");
} else {
/* $params[2] is de action
   $params[3] is een getal die de delete action nodig heeft
*/
    switch ($memberParams[0]) {

//        case 'home':
//            break;

        case 'products':
            $products = getProducts();
            include_once "../Templates/adminproducts.php";
            break;

        case 'edit':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                var_dump($params);
                if (isset($_POST['submit'])) {
                    updateProduct($_POST['name'], $_POST['description'], $params[4], $params[3]);
                    header ('Location: /admin/products?success=product_updated');
                } else {
                    header ('Location: /admin/products?error=wrong_method');
                    break;
                }
            } else {
                $product = getProduct($params[3], explode('?', $params[4])[0]);
                $edit = true;
                include_once "../Templates/editproduct.php";
                break;
            }

        case 'add':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['submit'])) {
                    $check = getimagesize($_FILES["picture"]["tmp_name"]);
                    $target_file = $target_dir.basename($_FILES['picture']['name']);
                    if($check !== false) {
                        if (!file_exists($target_file)) {
                            if (!move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                                header ('Location: /admin/products?error=upload_failed');
                                break;
                            }
                        }
                    }
                    //var_dump($_FILES['picture']);
                    createProduct($_POST['name'], $_POST['description'], $_FILES['picture']['name'], $_POST['category']);
                    header('Location: /admin/products?success=product_made');
                    break;
                } else {
                    header ('Location: /admin/products?error=wrong_method');
                    break;
                }
            } else {
                $edit = false;
                include_once "../Templates/editproduct.php";
                break;
            }

        default:
            header ('Location: /admin/products');
            break;
    }
}