<?php
    $id = trim($_GET['id']);

    $pdo = new PDO('mysql:host=MySQL-8.2;dbname=e-shop.online', 'root', '');
    $sql = 'SELECT * FROM products WHERE id = ?';
    $query = $pdo->prepare($sql);
    $query->execute([$id]);

    $product = $query->fetch(PDO::FETCH_ASSOC);
    $id = $product['id'];
    $count = $product['count']; 
    $price = $product['price'];
    $title = $product['title'];

    if($count) {
        $count = 'in-stock';
    } else {
        $count = 'out-of-stock';
    }

    require_once('blocks/header.php')
?>
<h1 id="<?=$count?>"><?=$title?></h1>
<h2>цена: <?=$price?>$</h2>
<p></p>
<?php
    require_once('blocks/footer.php')
?>
