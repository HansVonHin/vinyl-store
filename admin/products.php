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
        // Only set media fields for media products
        $media_type_id = !empty($_POST['media_type_id']) ? filter_var($_POST['media_type_id'], FILTER_SANITIZE_NUMBER_INT) : null;
        $genre_id = !empty($_POST['genre_id']) ? filter_var($_POST['genre_id'], FILTER_SANITIZE_NUMBER_INT) : null;
    } else {
        // Only set category_id for non-media products
        $category_id = !empty($_POST['category_id']) ? filter_var($_POST['category_id'], FILTER_SANITIZE_NUMBER_INT) : null;
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
        // Insert product, allowing NULL values for certain fields
        $insert_products = $conn->prepare("INSERT INTO `products` 
            (name, details, price, genre_id, category_id, media_type_id, inventory_status, quantity, image_01, image_02, image_03)
            VALUES (?, ?, ?, ?, ?, ?, 'in stock', ?, ?, ?, ?)");

        $insert_products->execute([$name, $details, $price, $genre_id, $category_id, $media_type_id, $inventory, $image_01, $image_02, $image_03]);

        if ($insert_products) {
            // Move the uploaded images to the appropriate folders
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

// Fetch products for display
$products = $conn->query("SELECT * FROM `products` ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

$select_products = $conn->prepare("
    SELECT p.*, g.genre_name, c.category_name, mt.media_type_name, i.quantity, i.status as inventory_status 
    FROM `products` p
    LEFT JOIN `genres` g ON p.genre_id = g.id
    LEFT JOIN `categories` c ON p.category_id = c.id
    LEFT JOIN `media_types` mt ON p.media_type_id = mt.id
    LEFT JOIN `inventory` i ON p.id = i.product_id
");
$select_products->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="icon" href="images/favicon.ico" type="images/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../Vinyl-Store/css/admin_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<?php include '../Vinyl-Store/components/admin_header.php'; ?>

<div class="container">

    <!-- Section 1: Product Table with Sorting -->
    <section id="product_table_section">
        <h1>Product List</h1>
        <div class="sort-options">
            <label for="sort">Sort by: </label>
            <select id="sort" name="sort" onchange="sortProducts()">
                <option value="new">Newest</option>
                <option value="old">Oldest</option>
            </select>
        </div>
        <table class="products-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="product_list">
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['name']; ?></td>
                    <td>$<?= $product['price']; ?></td>
                    <td><?= $product['inventory_status']; ?></td>
                    <td>
                        <a href="update_product.php?update=<?= $product['id']; ?>" class="update-icon">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="products.php?delete=<?= $product['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');" class="delete-icon">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <!-- Section 2: Add Product Form -->
    <section id="add_product_section">
    <h1>Add New Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="flex">
            <div class="inputBox">
                <span>Select Product Type (Required)</span>
                <select name="product_type" id="product_type" onchange="toggleFields()" required>
                    <option value="media">Media (Vinyl, CD, etc.)</option>
                    <option value="non-media">Non-Media (Turntable, Accessories, etc.)</option>
                </select>
            </div>
            <div id="media_fields">
                <div class="inputBox">
                    <span>Media Type (Required)</span>
                    <select name="media_type_id" required>
                        <option value="1">Vinyl</option>
                        <option value="2">CD</option>
                        <option value="3">Cassette</option>
                        <option value="4">DVD</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>Genre (Required)</span>
                    <select name="genre_id" required>
                        <option value="1">Rock</option>
                        <option value="2">Pop</option>
                        <option value="3">Jazz</option>
                        <option value="4">Classical</option>
                        <option value="5">Hip-Hop</option>
                        <option value="6">Electronic</option>
                    </select>
                </div>
            </div>
            <div id="non_media_fields" style="display:none;">
                <div class="inputBox">
                    <span>Category (Required)</span>
                    <select name="category_id" required>
                        <option value="1">Turntable</option>
                        <option value="2">Vinyl Accessories</option>
                        <option value="3">CD Player</option>
                        <option value="4">Speakers</option>
                        <option value="5">Other</option>
                    </select>
                </div>
            </div>
            <!-- Other common product fields -->
            <div class="inputBox">
                <span>Product Name (Required)</span>
                <input type="text" class="box" required maxlength="100" placeholder="Enter product name" name="name">
            </div>
            <div class="inputBox">
                <span>Product Price (Required)</span>
                <input type="number" min="0" class="box" required max="9999999999" placeholder="Enter product price" name="price">
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

    <h1><!--class="heading"-->Products Added</h1>

    <div class="box-container">
    <?php
        if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div class="box">
        <img src="../Vinyl-Store/uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
        <div class="name"><?= $fetch_products['name']; ?></div>
        <div class="price">₱<span><?= $fetch_products['price']; ?></span>/-</div>

        <!-- Display genre if available -->
        <?php if (isset($fetch_products['genre_name'])): ?>
        <div class="genre">
            <span> Genre: <?= isset($fetch_products['genre_name']) ? $fetch_products['genre_name'] : 'No genre specified'; ?></span>
        </div>

        <!-- Display media type if available -->
        <?php elseif (isset($fetch_products['media_type_name'])): ?>
        <div class="media-type">
            <span>Media Type: <?= $fetch_products['media_type_name']; ?></span>
        </div>

        <!-- Display category if available (for non-media products) -->
        <?php elseif (isset($fetch_products['category_name'])): ?>
        <div class="category">
            <span><?= isset($fetch_products['category_name']) ? $fetch_products['category_name'] : 'No category specified'; ?></span>
        </div>
        <?php endif; ?>
        
        <!-- Display inventory status and quantity -->
        <div class="inventory">
            <span>Stock: <?= isset($fetch_products['quantity']) ? $fetch_products['quantity'] : 'N/A'; ?></span>
            <span>Status: <?= isset($fetch_products['inventory_status']) ? $fetch_products['inventory_status'] : 'Unknown'; ?></span>
        </div>

        <div class="details"><span><?= $fetch_products['details']; ?></span></div>
        <div class="flex-btn">
            <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Update</a>
            <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
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

<!-- Section 3: Product Statistics -->
<section id="product_statistics_section">
    <h1>Product Statistics</h1>
    <p>Total Products: <?= count($products); ?></p>
    <p>Products In Stock: <?= count(array_filter($products, function($product) {
        return $product['inventory_status'] === 'in stock';
    })); ?></p>
</section>
</div>

<script>
function toggleFields() {
    var productType = document.getElementById('product_type').value;
    document.getElementById('media_fields').style.display = productType === 'media' ? 'block' : 'none';
    document.getElementById('non_media_fields').style.display = productType === 'non-media' ? 'block' : 'none';
}
// Sort products based on selection
function sortProducts() {
    var sortType = document.getElementById('sort').value;
    var tbody = document.getElementById('product_list');
    var rows = Array.from(tbody.querySelectorAll('tr'));

    rows.sort(function(a, b) {
        var idA = parseInt(a.querySelector('a.update-icon').getAttribute('href').split('=')[1]);
        var idB = parseInt(b.querySelector('a.update-icon').getAttribute('href').split('=')[1]);

        return sortType === 'new' ? idB - idA : idA - idB;
    });

    // Re-append rows in sorted order
    rows.forEach(function(row) {
        tbody.appendChild(row);
    });
}
</script>

<script src="../Vinyl-Store/js/admin_script.js"></script>
   
</body>
</html>