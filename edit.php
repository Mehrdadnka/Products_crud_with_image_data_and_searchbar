<?php
    /** @var $pdo \PDO */

    require_once "sys/connection.php";
    include_once "sys/function.php";

    $id = $_GET['id'] ?? null;

    if(!$id)
    {
        header('LOCATION: index.php');
        exit;
    }



    $query = $pdo->prepare('SELECT * FROM product WHERE id = :id');
    $query->bindValue(':id', $id);
    $query->execute();
    $product = $query->fetch(PDO::FETCH_ASSOC);


    $errors = [];
    $title = $product['title'];
    $price = $product['price'];
    $description = $product['description'];
    $imagePath = '';


    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        require_once "../../sys/validate_product.php";

        if(empty($errors)) {

            $stmt = $pdo->prepare("
                                    UPDATE product SET title = :title,
                                                       image = :image,
                                                       description= :description,
                                                       price= :price
                                                       WHERE id = :id
                                ");
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':image', $imagePath);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':price', $price);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            header('LOCATION: index.php');
        }
    }
?>



<?php
    include_once "view/partials/header.php";
?>
    <h1 class="title">Edit Product</h1>
    <?php
        include_once "view/products/form.php";
    ?>
            <button type="submit" class="btn edit-btn">Edit Product</button>
        </form>
   </div>
</body>
</html>