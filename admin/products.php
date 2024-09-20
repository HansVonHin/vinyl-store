<?php

include '../Vinyl-Store/components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

// Add a new product
if (isset($_POST['add_product'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_STRING);
    $details = filter_var($_POST['details'], FILTER_SANITIZE_STRING);
    $inventory = filter_var($_POST['inventory'], FILTER_SANITIZE_NUMBER_INT);
    $media_type_id = null; // Initialize
    $genre_id = null; // Initialize
    $category_id = null; // Initialize

    // Check product type
    $product_type = filter_var($_POST['product_type'], FILTER_SANITIZE_STRING);
    
    if ($product_type == 'media') {
        $media_type_id = filter_var($_POST['media_type_id'], FILTER_SANITIZE_NUMBER_INT);
        $genre_id = filter_var($_POST['genre_id'], FILTER_SANITIZE_NUMBER_INT);
    } else {
        $category_id = filter_var($_POST['category_id'], FILTER_SANITIZE_NUMBER_INT);
    }

    // Handle image uploads
    $image_01 = filter_var($_FILES['image_01']['name'], FILTER_SANITIZE_STRING);
    $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
    $image_folder_01 = '../Vinyl-Store/uploaded_img/' . $image_01;

    $image_02 = filter_var($_FILES['image_02']['name'], FILTER_SANITIZE_STRING);
    $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
    $image_folder_02 = '../Vinyl-Store/uploaded_img/' . $image_02;

    $image_03 = filter_var($_FILES['image_03']['name'], FILTER_SANITIZE_STRING);
    $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
    $image_folder_03 = '../Vinyl-Store/uploaded_img/' . $image_03;

    // Check if the product already exists
    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
    $select_products->execute([$name]);

    if ($select_products->rowCount() > 0) {
        $message[] = 'Product Name Already Exists!';
    } else {
        $insert_products = $conn->prepare("INSERT INTO `products` (name, details, price, genre_id, category_id, media_type_id, inventory_status, quantity, image_01, image_02, image_03)
                                            VALUES (?, ?, ?, ?, ?, ?, 'in stock', ?, ?, ?, ?)");
        $insert_products->execute([$name, $details, $price, $genre_id, $category_id, $media_type_id, $inventory, $image_01, $image_02, $image_03]);

        if ($insert_products) {
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $message[] = 'New Product Added!';
        }
    }
}

// Delete a product
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $delete_product_image->execute([$delete_id]);
    $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
    
    unlink('../Vinyl-Store/uploaded_img/'.$fetch_delete_image['image_01']);
    unlink('../Vinyl-Store/uploaded_img/'.$fetch_delete_image['image_02']);
    unlink('../Vinyl-Store/uploaded_img/'.$fetch_delete_image['image_03']);
    
    $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_product->execute([$delete_id]);
    header('location:products.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plaka Express - Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../Vinyl-Store/css/admin_style.css">
</head>
<body>

<?php include '../Vinyl-Store/components/admin_header.php'; ?>

<section class="add-products">

    <h1 class="heading">Add Product</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="flex">
            <div class="inputBox">
                <span>Product Name (Required)</span>
                <input type="text" class="box" required maxlength="100" placeholder="Enter product name" name="name">
            </div>
            <div class="inputBox">
                <span>Product Price (Required)</span>
                <input type="number" min="0" class="box" required max="9999999999" placeholder="Enter product price" name="price">
            </div>
            <div class="inputBox">
                <span>Product Genre (Required)</span>
                <input type="text" class="box" required maxlength="100" placeholder="Enter genre" name="genre">
            </div>
            <div class="inputBox">
                <span>Product Category (Required)</span>
                <input type="text" class="box" required maxlength="100" placeholder="Enter category" name="category">
            </div>
            <div class="inputBox">
                <span>Product Inventory (Required)</span>
                <input type="number" class="box" required placeholder="Enter stock quantity" name="inventory">
            </div>
            <div class="inputBox">
                <span>1st Image (Required)</span>
                <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            </div>
            <div class="inputBox">
                <span>2nd Image (Required)</span>
                <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            </div>
            <div class="inputBox">
                <span>3rd Image (Required)</span>
                <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            </div>
            <div class="inputBox">
                <span>Product Details (Required)</span>
                <textarea name="details" placeholder="Enter product details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
            </div>
        </div>
        <input type="submit" value="Add Product" class="btn" name="add_product">
    </form>

</section>

<section class="show-products">

    <h1 class="heading">Products Added</h1>

    <div class="box-container">
    <?php
        $select_products = $conn->prepare("SELECT * FROM `products`");
        $select_products->execute();
        if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div class="box">
        <img src="../Vinyl-Store/uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
        <div class="name"><?= $fetch_products['name']; ?></div>
        <div class="price">₱<span><?= $fetch_products['price']; ?></span>/-</div>
        <div class="genre"><span><?= $fetch_products['genre']; ?></span></div>
        <div class="category"><span><?= $fetch_products['category']; ?></span></div>
        <div class="inventory"><span>Stock: <?= $fetch_products['inventory']; ?></span></div>
        <div class="details"><span><?= $fetch_products['details']; ?></span></div>
        <div class="flex-btn">
            <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Update</a>
            <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Delete This Product?');">Delete</a>
        </div>
    </div>
    <?php
            }
        } else {
            echo '<p class="empty">No Products Added Yet!</p>';
        }
    ?>
    </div>

</section>

<script src="../Vinyl-Store/js/admin_script.js"></script>
   
</body>
</html>