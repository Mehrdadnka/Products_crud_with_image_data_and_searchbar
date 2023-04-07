<?php
    /** @var $pdo \PDO */

    require_once "sys/connection.php";
    include_once "sys/function.php";

    $errors = [];

    $title = '';
    $price = '';
    $description = '';
    $product = [
        'image' => ''
    ];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        require_once "sys/validate_product.php";

        if(empty($errors)) {

            $stmt = $pdo->prepare("
                                    INSERT INTO product (title, image, description, price, create_date) 
                                    VALUES (:title, :image, :description, :price, :date)
                                ");
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':image', $imagePath);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':price', $price);
            $stmt->bindValue(':date', date('Y-m-d H:i:s'));
            $stmt->execute();
            header('LOCATION: index.php');
        }
    }
?>

<?php
    include_once "view/partials/header.php";
?>
    <h1 class="title">Create New Product</h1>
    <?php
        include_once "view/products/form.php";
    ?>
            <button type="submit" class="btn edit-btn">Add Product</button>
        </form>
   </div>
</body>
</html>
