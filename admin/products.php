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
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $details = filter_var($_POST['details'], FILTER_SANITIZE_STRING);
    $inventory = filter_var($_POST['inventory'], FILTER_SANITIZE_NUMBER_INT);

    $vinyl_size = null; // Initialize for vinyl-specific products
    $media_type_id = null; // Initialize for media type
    $genre_id = null; // Initialize for genre
    $category_id = null; // Initialize for non-media categories

    // Check product type (media or non-media)
    $product_type = filter_var($_POST['product_type'], FILTER_SANITIZE_STRING);

    if ($product_type == 'media') {
        // Only set media fields for media products
        $media_type_id = !empty($_POST['media_type_id']) ? filter_var($_POST['media_type_id'], FILTER_SANITIZE_NUMBER_INT) : null;
        $genre_id = !empty($_POST['genre_id']) ? filter_var($_POST['genre_id'], FILTER_SANITIZE_NUMBER_INT) : null;
        $vinyl_size = !empty($_POST['vinyl_size']) ? filter_var($_POST['vinyl_size'], FILTER_SANITIZE_NUMBER_INT) : null;
    } else {
        // Set category for non-media products
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
        // Insert product, allowing NULL values for optional fields
        $insert_products = $conn->prepare("INSERT INTO `products` 
            (name, details, price, vinyl_size, genre_id, category_id, media_type_id, inventory_status, quantity, image_01, image_02, image_03)
            VALUES (?, ?, ?, ?, ?, ?, ?, 'in stock', ?, ?, ?, ?)");

        $insert_products->execute([$name, $details, $price, $vinyl_size, $genre_id, $category_id, $media_type_id, $inventory, $image_01, $image_02, $image_03]);

        $product_id = $conn->lastInsertId(); // Get the ID of the inserted product

        if ($insert_products) {
            // Move the uploaded images to the appropriate folders
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $message[] = 'New Product Added!';
        }
    }
}

// Add a new artist
if (isset($_POST['add_artist'])) {
    $artist_name = filter_var($_POST['artist_name'], FILTER_SANITIZE_STRING);
    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);

    // Handle image uploads
    $image_url = filter_var($_FILES['image_url']['artist_name'], FILTER_SANITIZE_STRING);
    $image_tmp_artist_name = $_FILES['image_url']['tmp_artist_name'];
    $image_folder = '../Vinyl-Store/uploaded_img/' . $image_url;

    // Check if the artist already exists
    $select_artists = $conn->prepare("SELECT * FROM `artists` WHERE artist_name = ?");
    $select_artists->execute([$artist_name]);

    if ($select_artists->rowCount() > 0) {
        $message[] = 'Artist Already Exists!';
    } else {
        // Insert new artist
        $insert_artist = $conn->prepare("INSERT INTO `artists` (artist_name, bio, image_url) VALUES (?, ?, ?)");
        $insert_artist->execute([$artist_name, $bio, $image_url]);

        if ($insert_artist) {
            // Move the uploaded images to the appropriate folders
            move_uploaded_file($image_tmp_artist_name, $image_folder);
            $message[] = 'New Artist Added!';
        }
    }
}

// Add a new tracklist
if (isset($_POST['add_tracklist'])) {
    $tracklist_name = filter_var($_POST['tracklist_name'], FILTER_SANITIZE_STRING);
    $platform = filter_var($_POST['platform'], FILTER_SANITIZE_STRING);
    $tracklist_url = filter_var($_POST['tracklist_url'], FILTER_SANITIZE_URL);

    // Insert new tracklist
    $insert_tracklist = $conn->prepare("INSERT INTO `media_tracklists` (platform, tracklist_url, tracklist_name) VALUES (?, ?, ?)");
    $insert_tracklist->execute([$platform, $tracklist_url, $tracklist_name]);

    if ($insert_tracklist) {
        $message[] = 'New Tracklist Added!';
    }
}

// Add a new credit
if (isset($_POST['add_credits'])) {
    $credit_name = filter_var($_POST['credit_name'], FILTER_SANITIZE_STRING);
    $credit_type = filter_var($_POST['credit_type'], FILTER_SANITIZE_STRING);

    // Handle image uploads
    $image_url = filter_var($_FILES['image_url']['artist_name'], FILTER_SANITIZE_STRING);
    $image_tmp_name_01 = $_FILES['image_url']['tmp_name'];
    $image_folder_01 = '../Vinyl-Store/uploaded_img/' . $image_url;
    
    // Insert new credit
    $insert_credit = $conn->prepare("INSERT INTO `media_credits` (credit_name, credit_type, image_url) VALUES (?, ?, ?)");
    $insert_credit->execute([$credit_name, $credit_type, $image_url]);

    if ($insert_credit) {
        // Move the uploaded images to the appropriate folders
        move_uploaded_file($image_tmp_name_01, $image_folder_01);
        $message[] = 'New Credit Added!';
    }
}

// Assign an artist to a product
if (isset($_POST['assign_artist'])) {
    $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
    $artist_id = filter_var($_POST['artist_id'], FILTER_SANITIZE_NUMBER_INT);

    $assign_artist = $conn->prepare("INSERT INTO `product_artists` (product_id, artist_id) VALUES (?, ?)");
    $assign_artist->execute([$product_id, $artist_id]);
    $message[] = 'Artist Assigned to Product (New Entry)!';
}

// Assign a tracklist to a product
if (isset($_POST['assign_tracklist'])) {
    $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
    $tracklist_id = filter_var($_POST['tracklist_id'], FILTER_SANITIZE_NUMBER_INT);

    // Check if there is already a tracklist with NULL product_id
    $select_null_tracklist = $conn->prepare("SELECT * FROM `media_tracklists` WHERE tracklist_id = ? AND product_id IS NULL");
    $select_null_tracklist->execute([$tracklist_id]);

    if ($select_null_tracklist->rowCount() > 0) {
        // Update the row with the NULL product_id
        $update_tracklist = $conn->prepare("UPDATE `media_tracklists` SET product_id = ? WHERE tracklist_id = ? AND product_id IS NULL");
        $update_tracklist->execute([$product_id, $tracklist_id]);
        $message[] = 'Tracklist Assigned to Product (Updated NULL entry)!';
    } else {
        // Insert new if no existing NULL entry found
        $assign_tracklist = $conn->prepare("INSERT INTO `media_tracklists` (product_id, tracklist_id) VALUES (?, ?)");
        $assign_tracklist->execute([$product_id, $tracklist_id]);
        $message[] = 'Tracklist Assigned to Product (New Entry)!';
    }
}

// Assign a credit to a product
if (isset($_POST['assign_credit'])) {
    $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
    $credit_id = filter_var($_POST['credit_id'], FILTER_SANITIZE_NUMBER_INT);

    $assign_credit = $conn->prepare("INSERT INTO `product_credits` (product_id, credit_id) VALUES (?, ?)");
    $assign_credit->execute([$product_id, $credit_id]);
    $message[] = 'Credit Assigned to Product (New Entry)!';
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

// Fetch artists
$artists = $conn->query("SELECT * FROM `artists` ORDER BY artist_id ASC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch product_artists
$product_artists = $conn->query("SELECT * FROM `product_artists` ORDER BY artist_id ASC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch product_credits
$product_credits = $conn->query("SELECT * FROM `product_credits` ORDER BY credit_id ASC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch tracklists
$media_tracklists = $conn->query("SELECT * FROM `media_tracklists` ORDER BY tracklist_id ASC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch credits
$media_credits = $conn->query("
    SELECT media_credits.credit_id, products.id AS product_id, media_credits.credit_name, media_credits.credit_type, artists.artist_id AS artist_id, media_credits.image_url
    FROM `media_credits`
    LEFT JOIN `products` ON media_credits.product_id = products.id
    LEFT JOIN `artists` ON media_credits.artist_id = artists.artist_id
")->fetchAll(PDO::FETCH_ASSOC);

$select_products = $conn->prepare("
    SELECT p.*, g.genre_name, c.category_name, mt.media_type_name, i.quantity, i.status as inventory_status 
    FROM `products` p
    LEFT JOIN `genres` g ON p.genre_id = g.id
    LEFT JOIN `categories` c ON p.category_id = c.id
    LEFT JOIN `media_types` mt ON p.media_type_id = mt.id
    LEFT JOIN `inventory` i ON p.id = i.product_id
");
$select_products->execute();

$rows_per_page = isset($_GET['rows']) ? (int)$_GET['rows'] : 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $rows_per_page;

$artist_query = $conn->prepare("SELECT artist_id, artist_name, bio FROM artists LIMIT $offset, $rows_per_page");
$artist_query->execute();
$artist = $artist_query->fetchAll(PDO::FETCH_ASSOC);

$tracklist_query = $conn->prepare("SELECT tracklist_id, platform, tracklist_url FROM media_tracklists LIMIT $offset, $rows_per_page");
$tracklist_query->execute();
$tracklist = $tracklist_query->fetchAll(PDO::FETCH_ASSOC);

$credits_query = $conn->prepare("SELECT credit_id, credit_name, credit_type FROM media_credits LIMIT $offset, $rows_per_page");
$credits_query->execute();
$credits = $credits_query->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of credits for pagination controls
$total_artist_query = $conn->query("SELECT COUNT(*) FROM artists");
$total_artist = $total_artist_query->fetchColumn();
$total_pages = ceil($total_artist / $rows_per_page);

$total_tracklist_query = $conn->query("SELECT COUNT(*) FROM media_tracklists");
$total_tracklist = $total_tracklist_query->fetchColumn();
$total_pages = ceil($total_tracklist / $rows_per_page);

$total_credits_query = $conn->query("SELECT COUNT(*) FROM media_credits");
$total_credits = $total_credits_query->fetchColumn();
$total_pages = ceil($total_credits / $rows_per_page);

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
$order_by = '';

switch ($sort) {
    case 'newest':
        $order_by = 'artist_id DESC';
        break;
    case 'oldest':
        $order_by = 'artist_id ASC';
        break;
    case 'az':
        $order_by = 'artist_name ASC';
        break;
    case 'za':
        $order_by = 'artist_name DESC';
        break;
}

$credits_query = $conn->prepare("SELECT artist_id, artist_name, bio FROM artists ORDER BY $order_by LIMIT $offset, $rows_per_page");
$credits_query->execute();
$credits = $credits_query->fetchAll(PDO::FETCH_ASSOC);

switch ($sort) {
    case 'newest':
        $order_by = 'tracklist_id DESC';
        break;
    case 'oldest':
        $order_by = 'tracklist_id ASC';
        break;
    case 'az':
        $order_by = 'tracklist_name ASC';
        break;
    case 'za':
        $order_by = 'tracklist_name DESC';
        break;
}

$credits_query = $conn->prepare("SELECT tracklist_id, platform, tracklist_url FROM media_tracklists ORDER BY $order_by LIMIT $offset, $rows_per_page");
$credits_query->execute();
$credits = $credits_query->fetchAll(PDO::FETCH_ASSOC);

switch ($sort) {
    case 'newest':
        $order_by = 'credit_id DESC';
        break;
    case 'oldest':
        $order_by = 'credit_id ASC';
        break;
    case 'az':
        $order_by = 'credit_name ASC';
        break;
    case 'za':
        $order_by = 'credit_name DESC';
        break;
}

$credits_query = $conn->prepare("SELECT credit_id, credit_name, credit_type FROM media_credits ORDER BY $order_by LIMIT $offset, $rows_per_page");
$credits_query->execute();
$credits = $credits_query->fetchAll(PDO::FETCH_ASSOC);

$filtered_products = $conn->prepare("SELECT * FROM `products` WHERE `media_type_id` IS NOT NULL AND `genre_id` IS NOT NULL AND `category_id` IS NULL");
$filtered_products->execute();
$products_filtered = $filtered_products->fetchAll(PDO::FETCH_ASSOC);

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
        <h1 class="heading">Product List</h1>
        <div class="top-controls">
            <input type="text" id="searchBox" onkeyup="searchProducts()" placeholder="Search products...">
            <div class="sort-options">
                <label for="sort">Sort by: </label>
                <select id="sort" name="sort" onchange="sortProducts()">
                    <option value="new">Newest</option>
                    <option value="old">Oldest</option>
                    <option value="az">A-Z</option>
                    <option value="za">Z-A</option>
                </select>
            </div>
        </div>

        <table class="products-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="product_list">
                <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['name']; ?></td>
                    <td>₱<?= $product['price']; ?></td>
                    <td><?= $product['quantity']; ?></td>
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
            <?php else: ?>
                <tr><td colspan="3">No products found.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
        <div>
        <label for="rows">Show </label>
        <select id="rows" onchange="setRowsPerPage()">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
        rows per page
        </div>
        <div>
            <?php if ($page > 1): ?>
                <a href="?rows=<?= $rows_per_page ?>&page=<?= $page - 1 ?>">Previous</a>
            <?php endif; ?>
    
            <?php if ($page < $total_pages): ?>
                <a href="?rows=<?= $rows_per_page ?>&page=<?= $page + 1 ?>">Next</a>
            <?php endif; ?>
        </div>
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
            
            <!-- Media fields start -->
            <div id="media_fields">
                <div class="inputBox">
                    <span>Media Type (Required)</span>
                    <select name="media_type_id" required>
                        <option> -- </option>
                        <option value="1">Vinyl</option>
                        <option value="2">CD</option>
                        <option value="3">Cassette</option>
                        <option value="4">DVD</option>
                    </select>
                </div>
                
                <!-- Vinyl size dropdown (hidden by default) -->
                <div class="inputBox" id="vinyl_size_field" style="display: none;">
                    <span>Vinyl Size</span>
                    <select name="vinyl_size">
                        <option> -- </option>
                        <option value="7">7"</option>
                        <option value="10">10"</option>
                        <option value="12">12" (LP)</option>
                    </select>
                </div>

                <div class="inputBox">
                    <span>Genre (Required)</span>
                    <select name="genre_id" required>
                        <option> -- </option>
                        <option value="1">Rock</option>
                        <option value="2">Pop</option>
                        <option value="3">Jazz</option>
                        <option value="4">Classical</option>
                        <option value="5">Hip-Hop</option>
                        <option value="6">Electronic</option>
                    </select>
                </div>
            </div>
            <!-- Media fields end -->
            
            <!-- Non-media fields -->
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

<!-- Section 3: Artist Management -->
<div class="clearfix">
<section id="artist_section">
    <h1 class="heading">Manage Artists</h1>

<div class="top-controls">
    <input type="text" id="searchBox" onkeyup="searchArtists()" placeholder="Search artists...">
    <div class="sort-options">
    <label for="sort">Sort by: </label>
        <select id="sort" onchange="sortArtists()">
            <option value="newest">Newest</option>
            <option value="oldest">Oldest</option>
            <option value="az">A-Z</option>
            <option value="za">Z-A</option>
        </select>
    </div>
</div>

    <table class="artists-table">
        <thead>
            <tr>
                <th>Artist ID</th>
                <th>Artist Name</th>
                <th>Bio</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="artist_list">
        <?php if (!empty($artists)): ?>
            <?php foreach ($artists as $artist): ?>
            <tr>
                <td><?= $artist['artist_id']; ?></td>
                <td><?= $artist['artist_name']; ?></td>
                <td><?= $artist['bio']; ?></td>
                <td>
                    <a href="update_artists.php?update=<?= $artist['artist_id']; ?>" class="update-icon">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="artists.php?delete=<?= $artist['artist_id']; ?>" onclick="return confirm('Are you sure you want to delete this artist?');" class="delete-icon">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">No artists found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    <div class="bottom-controls">
        <label for="rows">Show </label>
        <select id="rows" onchange="setRowsPerPage()">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
        rows per page
    </div>
    <div>
        <?php if ($page > 1): ?>
            <a href="?rows=<?= $rows_per_page ?>&page=<?= $page - 1 ?>">Previous</a>
        <?php endif; ?>
    
        <?php if ($page < $total_pages): ?>
            <a href="?rows=<?= $rows_per_page ?>&page=<?= $page + 1 ?>">Next</a>
        <?php endif; ?>
    </div>

    <!-- Add artist to product form -->
    <button id="toggleArtistButton">Assign Artist to Product</button><button id="toggleNewArtistButton">Add New Artist</button>
    <div id="artistForm" class="form-container hidden">
        <form action="" method="POST" enctype="multipart/form-data">
        <label for="product">Select Product</label>
        <select id="product" name="product_id">
            <?php foreach ($products_filtered as $product): ?>
            <option value="<?= $product['id']; ?>"><?= $product['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="artist">Select Artist</label>
        <select id="artist" name="artist_id">
            <?php foreach ($artists as $artist): ?>
            <option value="<?= $artist['artist_id']; ?>"><?= $artist['artist_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <div class="btn-container">
            <input type="submit" class="btn" value="Confirm" name="assign_artist">
            <button id="toggleArtistButton" class="btn cancel">Close</button>
        </div>
        </form>
    </div>
    <div id="new_artistForm" class="form-container hidden">
        <form action="" method="POST">
            <div class="inputBox">
                <span>Artist Name (Required)</span>
                <input type="text" class="box" required maxlength="100" name="artist_name" placeholder="Enter artist name..." required>
            </div>
            <div class="inputBox">
                <span>Artist Bio (Required)</span>
                <textarea name="bio" placeholder="Enter artist bio..." required class="box" required maxlength="500" cols="30" rows="5"></textarea>
            </div>
            <div class="inputBox">
                <span>Image (Required)</span>
                <input type="file" name="image_url" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            </div>
            <?php if (isset($message)): ?>
                <p><?= implode(', ', $message); ?></p>
            <?php endif; ?>
            <div class="btn-container">
                    <input type="submit" class="btn" value="Add Artist" name="add_artist">
            <button id="toggleNewArtistButton" class="btn cancel">Close</button>
            </div>
        </form>
    </div>
</section>

<!-- Section 4: Tracklist Management -->
<section id="tracklist_section">
    <h1 class="heading">Manage Tracklist</h1>

<div class="top-controls">
    <input type="text" id="searchBox" onkeyup="searchTracklists()" placeholder="Search tracklists...">
    <div class="sort-options">
        <label for="sort">Sort by: </label>
        <select id="sort" onchange="sortTracklists()">
            <option value="newest">Newest</option>
            <option value="oldest">Oldest</option>
            <option value="az">A-Z</option>
            <option value="za">Z-A</option>
        </select>
    </div>
</div>
    
    <table class="tracklist-table">
        <thead>
            <tr>
                <th>Tracklist ID</th>
                <th>Tracklist Name</th>
                <th>Platform</th>
                <th>Tracklist URL</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="tracklist_list">
        <?php if (!empty($media_tracklists)): ?>
            <?php foreach ($media_tracklists as $tracklist): ?>
            <tr class="<?= strtolower($tracklist['platform']); ?>">
                <td><?= $tracklist['tracklist_id']; ?></td>
                <td><?= $tracklist['tracklist_name']; ?></td>
                <td><?= $tracklist['platform']; ?></td>
                <td><a href="<?= $tracklist['tracklist_url']; ?>" target="_blank"><?= $tracklist['tracklist_url']; ?></a></td>
                <td>
                    <a href="update_tracklists.php?update=<?= $tracklist['tracklist_id']; ?>" class="update-icon">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="tracklists.php?delete=<?= $tracklist['tracklist_id']; ?>" onclick="return confirm('Are you sure you want to delete this tracklist?');" class="delete-icon">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">No tracklists found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    <div class="bottom-controls">
        <label for="rows">Show </label>
        <select id="rows" onchange="setRowsPerPage()">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
        rows per page
    </div>
    <div>
        <?php if ($page > 1): ?>
            <a href="?rows=<?= $rows_per_page ?>&page=<?= $page - 1 ?>">Previous</a>
        <?php endif; ?>
    
        <?php if ($page < $total_pages): ?>
            <a href="?rows=<?= $rows_per_page ?>&page=<?= $page + 1 ?>">Next</a>
        <?php endif; ?>
    </div>

    <!-- Add tracklist form -->
    <button id="toggleTracklistButton">Assign Tracklist to Product</button><button id="toggleNewTracklistButton">Add New Tracklist</button>
    <div id="tracklistForm" class="form-container hidden">
        <form action="" method="POST">
        <label for="product">Select Product</label>
        <select id="product" name="product_id">
            <?php foreach ($products_filtered as $product): ?>
            <option value="<?= $product['id']; ?>"><?= $product['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="platform">Select Tracklist</label>
        <select id="platform" name="tracklist_id" onchange="updateTracklistStyle(this.value)">
            <?php foreach ($media_tracklists as $tracklist): ?>
            <option value="<?= $tracklist['tracklist_id']; ?>"><?= $tracklist['tracklist_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <div class="btn-container">
            <input type="submit" class="btn" value="Confirm" name="assign_tracklist">
            <button id="toggleTracklistButton" class="btn cancel">Close</button>
        </div>
        </form>
    </div>
    <div id="new_tracklistForm" class="form-container hidden">
        <form action="" method="POST">
            <div class="inputBox">
            <span>Platform (Required)</span>
                <select name="platform" required>
                    <option value="YouTube">YouTube</option>
                    <option value="Spotify">Spotify</option>
                    <option value="AppleMusic">AppleMusic</option>
                </select>
            </div>
            <div class="inputBox">
            <span>Tracklist Name (Required)</span>
                <input type="text" name="tracklist_name" placeholder="Tracklist Name" required>
            </div>
            <div class="inputBox">
            <span>Tracklist URL (Required)</span>
                <input type="url" name="tracklist_url" placeholder="Tracklist URL" required>
            </div>

        <?php if (isset($message)): ?>
            <p><?= implode(', ', $message); ?></p>
        <?php endif; ?>
            <div class="btn-container">
                    <input type="submit" class="btn" value="Add Tracklist" name="add_tracklist"></input>
            <button id="toggleNewTracklistButton" class="btn cancel">Close</button>
            </div>
        </form>
    </div>
</section>

<!-- Section 4: Credits Management -->
<section id="credits_section">
    <h1 class="heading">Manage Credits</h1>
    
<div class="top-controls">
    <input type="text" id="searchBox" onkeyup="searchCredits()" placeholder="Search credits...">
    <div class="sort-options">
    <label for="sort">Sort by: </label>
        <select id="sort" onchange="sortCredits()">
            <option value="newest">Newest</option>
            <option value="oldest">Oldest</option>
            <option value="az">A-Z</option>
            <option value="za">Z-A</option>
        </select>
    </div>
</div>

    <table class="credits-table">
        <thead>
            <tr>
                <th>Credit ID</th>
                <th>Credit Name</th>
                <th>Credit Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="credits_list">
        <?php if (!empty($media_credits)): ?>
            <?php foreach ($media_credits as $credit): ?>
            <tr>
                <td><?= $credit['credit_id']; ?></td>
                <td><?= $credit['credit_name']; ?></td>
                <td><?= $credit['credit_type']; ?></td>
                <td>
                    <a href="update_credits.php?update=<?= $credit['credit_id']; ?>" class="update-icon">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="credits.php?delete=<?= $credit['credit_id']; ?>" onclick="return confirm('Are you sure you want to delete this credit?');" class="delete-icon">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">No credits found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    <div class="bottom-controls">
        <label for="rows">Show </label>
        <select id="rows" onchange="setRowsPerPage()">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
        rows per page
    </div>
    <div>
        <?php if ($page > 1): ?>
            <a href="?rows=<?= $rows_per_page ?>&page=<?= $page - 1 ?>">Previous</a>
        <?php endif; ?>
    
        <?php if ($page < $total_pages): ?>
            <a href="?rows=<?= $rows_per_page ?>&page=<?= $page + 1 ?>">Next</a>
        <?php endif; ?>
    </div>

    <!-- Add credit form -->
    <button id="toggleCreditButton">Assign Credits to Product</button><button id="toggleNewCreditsButton">Add New Credits</button>
    <div id="creditForm" class="form-container hidden">
        <form action="" method="POST">
        <label for="product">Select Product</label>
        <select id="product" name="product_id">
            <?php foreach ($products_filtered as $product): ?>
            <option value="<?= $product['id']; ?>"><?= $product['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="product">Credit Name</label>
        <select id="product" name="credit_id">
            <?php foreach ($media_credits as $credit): ?>
            <option value="<?= $credit['credit_id']; ?>"><?= $credit['credit_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <div class="btn-container">
            <input type="submit" class="btn" value="Confirm" name="assign_credit">
            <button id="toggleCreditButton" class="btn cancel">Close</button>
        </div>
        </form>
    </div>
    <div id="new_creditsForm" class="form-container hidden">
        <form action="" method="POST">
        <div class="inputBox">
            <span>Credit Name (Required)</span>
            <input type="text" class="box" required maxlength="100" name="credit_name" placeholder="Enter credits name..." required>
        </div>
        <div class="inputBox">
        <span>Credit Type (Required)</span>
            <select name="credit_type" required>
                <option value="songwriter">Songwriter</option>
                <option value="producer">Producer</option>
            </select>
        </div>
        <div class="inputBox">
            <span>Image (Required)</span>
            <input type="file" name="image_url" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <?php if (isset($message)): ?>
            <p><?= implode(', ', $message); ?></p>
        <?php endif; ?>
            <div class="btn-container">
                    <input type="submit" class="btn" value="Add Credits" name="add_credits">
            <button id="toggleNewCreditsButton" class="btn cancel">Close</button>
            </div>
        </form>
    </div>
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
        <?php endif; ?>

        <!-- Display media type if available -->
        <?php if (isset($fetch_products['media_type_name'])): ?>
        <div class="media-type">
            <span>Media Type: <?= $fetch_products['media_type_name']; ?></span>
        </div>
        <?php endif; ?>

        <!-- Display category if available (for non-media products) -->
        <?php if (isset($fetch_products['category_name'])): ?>
        <div class="category">
            <span><?= isset($fetch_products['category_name']) ? $fetch_products['category_name'] : 'No category specified'; ?></span>
        </div>
        <?php endif; ?>

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

<!-- Section 5: Product Statistics -->
<section id="product_statistics_section">
    <h1>Product Statistics</h1>
    <p>Total Products: <?= count($products); ?></p>
    <p>Products In Stock: <?= count(array_filter($products, function($product) {
        return $product['inventory_status'] === 'in stock';
    })); ?></p>
</section>
</div>
</div>
<script>
// Function to toggle media/non-media fields
function toggleFields() {
    const productType = document.getElementById('product_type').value;
    const mediaFields = document.getElementById('media_fields');
    const nonMediaFields = document.getElementById('non_media_fields');
    const vinylSizeField = document.getElementById('vinyl_size_field');
    const mediaType = document.querySelector('select[name="media_type_id"]').value;

    if (productType === 'media') {
        mediaFields.style.display = 'block';
        nonMediaFields.style.display = 'none';

        // Check if vinyl is selected, and show/hide vinyl size field
        if (mediaType == '1') {
            vinylSizeField.style.display = 'block';
        } else {
            vinylSizeField.style.display = 'none';
        }
    } else {
        mediaFields.style.display = 'none';
        nonMediaFields.style.display = 'block';
    }
}

// Trigger toggle on page load and when media type changes
document.addEventListener('DOMContentLoaded', toggleFields);
document.querySelector('select[name="media_type_id"]').addEventListener('change', toggleFields);

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

function toggleForm(formId) {
    // Array of all form elements
    var forms = [
        document.getElementById("artistForm"),
        document.getElementById("new_artistForm"),
        document.getElementById("tracklistForm"),
        document.getElementById("new_tracklistForm"),
        document.getElementById("creditForm"),
        document.getElementById("new_creditsForm")
    ];
    
    // Loop through all forms and close them
    forms.forEach(function(form) {
        if (form && form.classList.contains("open")) {
            form.classList.remove("open");
            form.classList.add("hidden");
        }
    });
    
    // Toggle the clicked form
    var form = document.getElementById(formId);
    if (form.classList.contains("hidden")) {
        form.classList.remove("hidden");
        form.classList.add("open");
    }
}

// Assign this function to buttons
document.getElementById("toggleArtistButton").onclick = function() {
    toggleForm("artistForm");
};
document.getElementById("toggleNewArtistButton").onclick = function() {
    toggleForm("new_artistForm");
};
document.getElementById("toggleTracklistButton").onclick = function() {
    toggleForm("tracklistForm");
};
document.getElementById("toggleNewTracklistButton").onclick = function() {
    toggleForm("new_tracklistForm");
};
document.getElementById("toggleCreditButton").onclick = function() {
    toggleForm("creditForm");
};
document.getElementById("toggleNewCreditsButton").onclick = function() {
    toggleForm("new_creditsForm");
};

function updateTracklistStyle(platform) {
    const form = document.getElementById("tracklistForm");
    if (platform === 'YouTube') {
        form.style.backgroundColor = 'red';
    } else if (platform === 'Spotify') {
        form.style.backgroundColor = 'green';
    } else if (platform === 'AppleMusic') {
        form.style.backgroundColor = 'white';
    }
}

var count = 1;
    function setColor(btn, color) {
        var property = document.getElementById(btn);
        if (count == 0) {
            property.style.backgroundColor = "#FFFFFF"
            count = 1;        
        }
        else {
            property.style.backgroundColor = "#7FFF00"
            count = 0;
        }
    }
    
function setRowsPerPage() {
    var rows = document.getElementById("rows").value;
    // Fetch the products dynamically here, using AJAX or a similar approach.
    // Example of AJAX call to a PHP endpoint:
    fetch(`your-endpoint.php?rows=${rows}&page=1`)
        .then(response => response.json())
        .then(data => {
            // Update your table content dynamically
        });
}

function searchArtists() {
    var input = document.getElementById('searchBox');
    var filter = input.value.toLowerCase();
    var table = document.getElementById('artist_list');
    var rows = table.getElementsByTagName('tr');
    
    for (var i = 0; i < rows.length; i++) {
        var creditName = rows[i].getElementsByTagName('td')[1]; // Get the credit_name column
        if (creditName) {
            var txtValue = creditName.textContent || creditName.innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }       
    }
}

function searchTracklists() {
    var input = document.getElementById('searchBox');
    var filter = input.value.toLowerCase();
    var table = document.getElementById('tracklist_list');
    var rows = table.getElementsByTagName('tr');
    
    for (var i = 0; i < rows.length; i++) {
        var creditName = rows[i].getElementsByTagName('td')[1]; // Get the credit_name column
        if (creditName) {
            var txtValue = creditName.textContent || creditName.innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }       
    }
}

function searchCredits() {
    var input = document.getElementById('searchBox');
    var filter = input.value.toLowerCase();
    var table = document.getElementById('credits_list');
    var rows = table.getElementsByTagName('tr');
    
    for (var i = 0; i < rows.length; i++) {
        var creditName = rows[i].getElementsByTagName('td')[1]; // Get the credit_name column
        if (creditName) {
            var txtValue = creditName.textContent || creditName.innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }       
    }
}

function sortArtists() {
    var sort = document.getElementById("sort").value;
    window.location.href = "?sort=" + sort;
}

function sortTracklists() {
    var sort = document.getElementById("sort").value;
    window.location.href = "?sort=" + sort;
}

function sortCredits() {
    var sort = document.getElementById("sort").value;
    window.location.href = "?sort=" + sort;
}

document.getElementById('searchBox').addEventListener('keyup', function() {
    var query = this.value;
    fetch(`search_endpoint.php?q=${query}`)
        .then(response => response.json())
        .then(data => {
            // Populate your search results dynamically
            // Display search results with matching sections on top
        });
});

</script>

<script src="../Vinyl-Store/js/admin_script.js"></script>
   
</body>
</html>