<?php

function getTitle() {
    global $title, $titleSuffix;
    return $title . $titleSuffix;
}

function writeReview(int $productid, int $categoryid, string $firstname, string $lastname, string $description, int $stars):string {
    global $pdo;
    $reviewcount = $pdo->query('SELECT `id` FROM `reviews`')->fetchAll(PDO::FETCH_CLASS, 'OnlyID');
    $reviewcount = count($reviewcount);
    $name = $firstname.' '.$lastname;
    $review = $pdo->prepare('INSERT INTO `reviews`(`id`, `product_id`, `category_id`, `name`, `description`, `date`, `stars`) VALUES (:id, :pid, :cid, :nm, :desc, :date, :stars)');
    $review->bindParam('id', $reviewcount);
    $review->bindParam('pid', $productid);
    $review->bindParam('cid', $categoryid);
    $review->bindParam('nm', $name);
    $review->bindParam('desc', $description);
    $date = date('d/m/Y');
    $review->bindParam('date', $date);
    $review->bindParam('stars', $stars);
    $review->execute();
    return 'done';
}

function changeDetails(int $id, string $firstname, string $lastname, string $email):array {
    global $pdo;
    $update = $pdo->prepare('UPDATE users SET email=:email, first_name=:firstname, last_name=:lastname WHERE id=:id');
    $email = urlencode($email);
    $update->bindParam('email', $email);
    $update->bindParam('firstname', $firstname);
    $update->bindParam('lastname', $lastname);
    $update->bindParam('id', $id);
    $update->execute();
    $newuserdata = $pdo->query("SELECT * FROM users WHERE id='".$id."'")->fetchAll(PDO::FETCH_CLASS, 'User');
    return $newuserdata;
}

function changePassword(int $id, string $newpassword):array {
    global $pdo;
    $update = $pdo->prepare('UPDATE users SET password=:password WHERE id=:id');
    $update->bindParam('password', $newpassword);
    $update->bindParam('id', $id);
    $update->execute();
    $newuserdata = $pdo->query("SELECT * FROM users WHERE id='".$id."'")->fetchAll(PDO::FETCH_CLASS, 'User');
    return $newuserdata;
}

function createProduct(string $name, string $description, string $img, int $category) {
    global $pdo;
    $ids = $pdo->query("SELECT id FROM products WHERE category=$category")->fetchAll(PDO::FETCH_CLASS, 'OnlyID');
    $id = count($ids);
    $newProducts = $pdo->prepare("INSERT INTO products (id, name, picture, description, category) VALUES (:id, :name, :picture, :description, :category)");
    $newProducts->bindParam('id', $id);
    $newProducts->bindParam('name', $name);
    $newProducts->bindParam('picture', $img);
    $newProducts->bindParam('description', $description);
    $newProducts->bindParam('category', $category);
    $newProducts->execute();
}

function updateProduct(string $name, string $description, int $id, int $category) {
    global $pdo;
    $update = $pdo->prepare('UPDATE products SET name=:name, description=:description WHERE category=:category AND id=:id');
    $update->bindParam('name', $name);
    $update->bindParam('description', $description);
    $update->bindParam('id', $id);
    $update->bindParam('category', $category);
    $update->execute();
}