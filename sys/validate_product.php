<?php
    $errors = [];
    $title = $_POST['product-title'];
    $description = $_POST['product-description'];
    $price = $_POST['product-price'];

    if(!$title){
        $errors[] = 'title is empty';
    }
    if(!$price){
        $errors[] = 'price is empty';
    }
    if(!is_dir('images'))
    {
        mkdir('images');
    }

    if(empty($errors)) {
        $image = $_FILES['image'] ?? null;
        $imagePath = $product['image'];

        if($image && $image["tmp_name"]) 
        {
            if($product['image'])
            {
                unlink($product['image']);
            }
            
            $imagePath = 'images/'.randomString(8).'/'.$image['name'];
            mkdir(dirname($imagePath));
            move_uploaded_file($image["tmp_name"], $imagePath);
        }
    }
