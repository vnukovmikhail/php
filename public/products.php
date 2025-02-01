<?php
    $title = 'Продукция';
    require_once('blocks/header.php')
?>
<h1>Продукция</h1>
<!-- <form action="product" method="get">
    <fieldset>
        <legend>Поиск-по-идентификатору:</legend>
        <input type="text" name="id" required>
        <input type="submit" value="Найти">
    </fieldset>
</form> -->
<section>
    <?php
        $pdo = new PDO('mysql:host=MySQL-8.2;dbname=e-shop.online', 'root', '');
        $sql = 'SELECT * FROM products';
        $query = $pdo->prepare($sql);
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($products as $product) {
            $productUrl = 'product/' . $product['id'];
            echo '<a href="'.$productUrl.'"><fieldset>';
            echo '<legend>Товар</legend>';
            echo '<p>'.$product['title'].'</p>';
            echo '<p>'.$product['price'].'$</p>';
            echo '</fieldset></a>';
        }
    ?>
</section>
<?php
    require_once('blocks/footer.php')
?>
