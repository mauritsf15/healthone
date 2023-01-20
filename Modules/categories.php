<?php

function getCategories():array
{
    global $pdo;
    $categories = $pdo->query('SELECT * FROM categories')->fetchAll(PDO::FETCH_CLASS, 'Category');
    return $categories;
}

function getCategoryName(int $id):string
{
    global $pdo;
    $categories = $pdo->query("SELECT * FROM categories WHERE id=$id")->fetchAll(PDO::FETCH_CLASS, 'Category');
    return $categories->name;
}

function getCategory(int $id):array
{
    global $pdo;
    $categories = $pdo->query("SELECT * FROM categories WHERE id=$id")->fetchAll(PDO::FETCH_CLASS, 'Category');
    return $categories;
}

function getProduct(int $cat_id, int $id = 999):array
{
    if ($id == 999) {
        global $pdo;
        $cat = $pdo->query("SELECT * FROM products WHERE category=$cat_id")->fetchAll(PDO::FETCH_CLASS, 'Product');
        return $cat;
    } else {
        global $pdo;
        $prod = $pdo->query("SELECT * FROM products WHERE category=$cat_id AND id=$id")->fetchAll(PDO::FETCH_CLASS, 'Product');
        return $prod;
    }
}

function getProducts():array
{
    global $pdo;
    $products = $pdo->query("SELECT * FROM products")->fetchAll(PDO::FETCH_CLASS, 'Product');
    return $products;
}

function getReviews(int $cat_id, int $id):array
{
    global $pdo;
    $reviews = $pdo->query("SELECT * FROM reviews WHERE category_id=$cat_id AND product_id=$id")->fetchAll(PDO::FETCH_CLASS, 'Review');
    return $reviews;
}