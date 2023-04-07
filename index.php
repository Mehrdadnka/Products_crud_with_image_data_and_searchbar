<?php
    /** @var $pdo \PDO */

    require_once "sys/connection.php";

    $search = $_GET['search'] ?? '';
    if($search) 
    {
        $stmt = $pdo->prepare('SELECT * FROM product WHERE title LIKE :title ORDER BY create_date DESC');
        $stmt->bindValue(':title', "%$search%");
    }
    else
    {
        $stmt = $pdo->prepare('SELECT * FROM product ORDER BY create_date DESC');
    }
    
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
    include_once "view/partials/header.php";
?>
    <h1 class="title">Products CRUD</h1>
    <p>
        <a href="create.php" class="btn btn-success">Create Product</a>
    </p>
    <form action="" class="search-bar">
        <div class="form-group">
            <input type="search" value="<?=$search;?>" name="search" id="search" placeholder="Search products...">
            <button type="submit" class="btn btn-search">Search</button>
        </div>
    </form>
   <div class="container">

    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Price</th>
                <th scope="col">Create Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as $i => $product): ?>
            <tr>
                <th scope="row"><?php echo $i + 1; ?></th>
                <td>
                    <img class="product_img" src="<?= $product['image']; ?>">
                </td>
                <td><?php echo $product['title']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><?php echo $product['create_date']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $product['id'];?>" class="btn edit-btn">Edit</a>
                    <form style="display: inline-block;" method="POST" action="delete.php">
                        <input type="hidden" name="id" value="<?= $product['id'];?>">
                        <button type="submit" class="btn delete-btn">ِDelete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   </div>
</body>
</html>