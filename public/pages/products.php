<?php
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'ASC';
    $pdo = new PDO('mysql:host=MySQL-8.2;dbname=e-shop.online', 'root', '');
    $sql = 'SELECT * FROM products ORDER BY price '.$sort;
    $query = $pdo->prepare($sql);
    $query->execute();
    $products = $query->fetchAll(PDO::FETCH_ASSOC);

    $title = 'Продукция';
    require_once('../blocks/header.php')
?>
<h1>Продукция</h1>
<form action="create" method="get">
    <fieldset>
        <legend>Создание-нового-продукта</legend>
        <input type="text" name="title" placeholder="название" required>
        <input type="number" name="price" placeholder="цена" required>
        <input type="number" name="count" placeholder="количество" required>
        <input type="submit" value="Создать">
    </fieldset>
</form>
<br><form method="get">
    <label for="sort">Сортировать по цене:</label>
    <select name="sort" id="sort" onchange="this.form.submit()">
        <option value="ASC" <?php if($sort == 'ASC') echo 'selected';?>>Возрастание</option>
        <option value="DESC" <?php if($sort == 'DESC') echo 'selected';?>>Убывание</option>
    </select>
</form><br>
<section>
    <?php
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
    require_once('../blocks/footer.php')
?>
