<?php
    $title = $_GET['title'];
    $price = $_GET['price'];
    $count = $_GET['count'];

    $formattedTitle = mb_strtolower(str_replace(' ', '-', trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $title))));

    $pdo = new PDO('mysql:host=MySQL-8.2;dbname=e-shop.online', 'root', '');
    $sql = "INSERT INTO `products` (`id`, `count`, `price`, `title`) VALUES (?, ?, ?, ?)";
    $query = $pdo->prepare($sql);
    $query->execute([$formattedTitle, $count, $price, $title]);

    header("Location: /pages/products");
    exit();