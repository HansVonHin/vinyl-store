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

// Handle Add Artist
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_artist'])) {
    $artist_name = $mysqli->real_escape_string($_POST['artist_name']);
    $bio = $mysqli->real_escape_string($_POST['bio']);
    
    $sql = "INSERT INTO artists (artist_name, bio) VALUES ('$artist_name', '$bio')";
    
    if ($mysqli->query($sql) === TRUE) {
        echo "New artist added successfully";
    } else {
        echo "Error: " . $sql;
    }
}

// Handle Add Tracklist
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tracklist_url'])) {
    $platform = $mysqli->real_escape_string($_POST['platform']);
    $tracklist_url = $mysqli->real_escape_string($_POST['tracklist_url']);
    
    $sql = "INSERT INTO media_tracklists (platform, tracklist_url) VALUES ('$platform', '$tracklist_url')";
    
    if ($mysqli->query($sql) === TRUE) {
        echo "New tracklist added successfully";
    } else {
        echo "Error: " . $sql;
    }
}

// Handle Add Credits
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['credit_type'])) {
    $product_id = (int)$_POST['product_id'];
    $artist_id = (int)$_POST['artist_id'];
    $credit_type = $mysqli->real_escape_string($_POST['credit_type']);
    
    $sql = "INSERT INTO media_credits (product_id, artist_id, credit_type) VALUES ($product_id, $artist_id, '$credit_type')";
    
    if ($mysqli->query($sql) === TRUE) {
        echo "Credit assigned successfully";
    } else {
        echo "Error: " . $sql;
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

// Fetch artists
$artists = $conn->query("SELECT * FROM `artists` ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch tracklists
$tracklists = $conn->query("SELECT * FROM `media_tracklists` ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch credits
$credits = $conn->query("
    SELECT media_credits.id, products.id AS product_name, media_credits.credit_type, artists.id AS artist_name
    FROM `media_credits`
    LEFT JOIN `products` ON media_credits.product_id = products.id
    LEFT JOIN `artists` ON media_credits.artist_id = artists.id
    ORDER BY media_credits.id ASC
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
<section id="artist_section">
    <h1 class="heading">Manage Artists</h1>
    <table class="artists-table">
        <thead>
            <tr>
                <th>Artist ID</th>
                <th>Artist Name</th>
                <th>Bio</th>
            </tr>
        </thead>
        <tbody id="artist_list">
        <?php if (!empty($artists)): ?>
            <?php foreach ($artists as $artist): ?>
            <tr>
                <td><?= $artist['id']; ?></td>
                <td><?= $artist['name']; ?></td>
                <td><?= $artist['bio']; ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">No artists found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- Add artist to product form -->
    <button id="toggleArtistButton">Assign Artist to Product</button><button id="toggleNewArtistButton">Add New Artist</button>
    <div id="artistForm" class="form-container hidden">

        <label for="product">Select Product</label>
        <select id="product" name="product_id">
            <?php foreach ($products as $product): ?>
            <option value="<?= $product['id']; ?>"><?= $product['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="artist">Select Artist</label>
        <select id="artist" name="artist_id">
            <?php foreach ($artists as $artist): ?>
            <option value="<?= $artist['id']; ?>"><?= $artist['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <div class="btn-container">
            <a href="artists.php">
                <button type="button" class="btn">Confirm</button>
            </a>
            <button id="toggleArtistButton" class="btn cancel">Close</button>
        </div>
    </div>
    <div id="new_artistForm" class="form-container hidden">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="inputBox">
                <span>Artist Name (Required)</span>
                <input type="text" class="box" required maxlength="100" name="artist_name" placeholder="Enter artist name..." required>
            </div>
            <div class="inputBox">
                <span>Artist Bio (Required)</span>
                <textarea name="bio" placeholder="Enter artist bio..." required class="box" required maxlength="500" cols="30" rows="5"></textarea>
            </div>
            <?php if (isset($message)): ?>
                <p><?= implode(', ', $message); ?></p>
            <?php endif; ?>
            <div class="btn-container">
                    <button type="button" class="btn" name="add_artist">Add Artist</button>
            <button id="toggleNewArtistButton" class="btn cancel">Close</button>
            </div>
        </form>
    </div>
</section>

<!-- Section 4: Tracklist Management -->
<section id="tracklist_section">
    <h1 class="heading">Manage Tracklist</h1>
    <table class="tracklist-table">
        <thead>
            <tr>
                <th>Tracklist ID</th>
                <th>Platform</th>
                <th>Tracklist URL</th>
            </tr>
        </thead>
        <id="tracklist_list">
        <?php if (!empty($tracklists)): ?>
            <?php foreach ($tracklists as $tracklist): ?>
            <tr class="<?= strtolower($tracklist['platform']); ?>">
                <td><?= $tracklist['id']; ?></td>
                <td><?= $tracklist['platform']; ?></td>
                <td><a href="<?= $tracklist['tracklist_url']; ?>" target="_blank"><?= $tracklist['tracklist_url']; ?></a></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">No tracklists found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- Add tracklist form -->
    <button id="toggleTracklistButton">Assign Tracklist to Product</button><button id="toggleNewTracklistButton">Add New Tracklist</button>
    <div id="tracklistForm" class="form-container hidden">

        <label for="product">Select Product</label>
        <select id="product" name="product_id">
            <?php foreach ($products as $product): ?>
            <option value="<?= $product['id']; ?>"><?= $product['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="platform">Select Platform</label>
        <select id="platform" name="platform" onchange="updateTracklistStyle(this.value)">
            <option value="YouTube">YouTube</option>
            <option value="Spotify">Spotify</option>
            <option value="AppleMusic">Apple Music</option>
        </select>

        <label for="tracklist_url">Tracklist URL</label>
        <input type="text" id="tracklist_url" name="tracklist_url" required>

        <div class="btn-container">
            <a href="tracklist.php">
                <button type="submit" class="btn">Add Tracklist</button>
            </a>
            <button id="toggleTracklistButton" class="btn cancel">Close</button>
        </div>
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
            <span>Tracklist URL (Required)</span>
                <input type="url" name="tracklist_url" placeholder="Tracklist URL" required>
            </div>

        <?php if (isset($message)): ?>
            <p><?= implode(', ', $message); ?></p>
        <?php endif; ?>
            <div class="btn-container">
                    <button type="button" class="btn">Add Tracklist</button>
            <button id="toggleNewTracklistButton" class="btn cancel">Close</button>
            </div>
        </form>
    </div>
</section>

<!-- Section 4: Credits Management -->
<section id="credits_section">
    <h1 class="heading">Manage Credits</h1>
    <table class="credits-table">
        <thead>
            <tr>
                <th>Credit ID</th>
                <th>Product Name</th>
                <th>Credit Type</th>
                <th>Artist Name</th>
            </tr>
        </thead>
        <tbody id="credits_list">
        <?php if (!empty($credits)): ?>
            <?php foreach ($credits as $credit): ?>
            <tr>
                <td><?= $credit['id']; ?></td>
                <td><?= $credit['product_name']; ?></td>
                <td><?= $credit['credit_type']; ?></td>
                <td><?= $credit['artist_name']; ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">No credits found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- Add credit form -->
    <button id="toggleCreditButton">Assign Credits to Product</button><button id="toggleNewCreditsButton">Add New Credits</button>
    <div id="creditForm" class="form-container hidden">

        <label for="product">Select Product</label>
        <select id="product" name="product_id">
            <?php foreach ($products as $product): ?>
            <option value="<?= $product['id']; ?>"><?= $product['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="artist">Select Artist</label>
        <select id="artist" name="artist_id">
            <?php foreach ($artists as $artist): ?>
            <option value="<?= $artist['id']; ?>"><?= $artist['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="credit_type">Credit Type</label>
        <input type="text" id="credit_type" name="credit_type" required>

        <div class="btn-container">
            <a href="credits.php">
                <button type="submit" class="btn">Add Credit</button>
            </a>
            <button id="toggleCreditButton" class="btn cancel">Close</button>
        </div>
    </div>
    <div id="new_creditsForm" class="form-container hidden">
        <form action="" method="POST">
        <div class="inputBox">
        <span>Product ID (Required)</span>
            <input type="number" name="product_id" placeholder="Product ID" required>
        </div>
        <div class="inputBox">
        <span>Artist ID (Required)</span>
            <input type="number" name="artist_id" placeholder="Artist ID" required>
        </div>
        <div class="inputBox">
        <span>Credit Type (Required)</span>
            <select name="credit_type" required>
                <option value="songwriter">Songwriter</option>
                <option value="producer">Producer</option>
            </select>
        </div>

        <?php if (isset($message)): ?>
            <p><?= implode(', ', $message); ?></p>
        <?php endif; ?>
            <div class="btn-container">
                    <button type="button" class="btn">Add Tracklist</button>
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
</script>

<script src="../Vinyl-Store/js/admin_script.js"></script>
   
</body>
</html>