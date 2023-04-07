    <p>
        <a class="btn btn-success" href="index.php">Back</a>
    </p>
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $error): ?>
                <div class="alert alert-danger"><?php echo $error ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
   <div class="container">
        <form class="product-form" action="" method="POST" enctype="multipart/form-data">

            
            <?php if($product["image"]): ?>
                
                        <img class="product_img" src="<?=$product['image']; ?>">
                
            <?php endif;?>
            <div class="form-group">
                <label for="image">Product Image:</label>
                <input type="file" name="image" class="input input-image">
            </div>
            <div class="form-group">
                <label for="product-title">Product Title:</label>
                <input type="text" value="<?= $title; ?>" name="product-title" class="input input-title">
            </div>
            <div class="form-group">
                <label for="product-description">Product Description:</label>
                <textarea name="product-description" class="input input-description" rows="4"><?= $description; ?></textarea>
            </div>
            <div class="form-group">
                <label for="product-price">Product Price:</label>
                <input type="number" value="<?= $price; ?>" step="0.01" name="product-price" class="input input-price" >
            </div>