<?php

include '../Vinyl-Store/components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

// Fetch credits
$credits = $conn->query("
    SELECT media_credits.id, products.name AS product_name, media_credits.credit_type, artists.artist_name
    FROM `media_credits`
    LEFT JOIN `products` ON media_credits.product_id = products.id
    LEFT JOIN `artists` ON media_credits.artist_id = artists.id
    ORDER BY media_credits.id ASC
")->fetchAll(PDO::FETCH_ASSOC);

// Add a new credit
if (isset($_POST['add_credit'])) {
    $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
    $artist_id = filter_var($_POST['artist_id'], FILTER_SANITIZE_NUMBER_INT);
    $credit_type = filter_var($_POST['credit_type'], FILTER_SANITIZE_STRING);

    // Insert new credit
    $insert_credit = $conn->prepare("INSERT INTO `media_credits` (product_id, artist_id, credit_type) VALUES (?, ?, ?)");
    $insert_credit->execute([$product_id, $artist_id, $credit_type]);

    if ($insert_credit) {
        $message[] = 'New Credit Added!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credits</title>
    <link rel="icon" href="../Vinyl-Store/images/favicon.ico" type="images/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../Vinyl-Store/css/admin_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<?php include '../Vinyl-Store/components/admin_header.php'; ?>

<section class="form-section">
    <h1>Add Credit</h1>
    <form action="" method="POST">
        <input type="number" name="product_id" placeholder="Product ID" required>
        <input type="number" name="artist_id" placeholder="Artist ID" required>
        <select name="credit_type" required>
            <option value="songwriter">Songwriter</option>
            <option value="producer">Producer</option>
        </select>
        <input type="submit" value="Add Credit" name="add_credit">
    </form>

    <?php if (isset($message)): ?>
        <p><?= implode(', ', $message); ?></p>
    <?php endif; ?>
</section>

<section class="list-section">
    <h2>Credits</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Credit Type</th>
                <th>Artist Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($credits as $credit): ?>
                <tr>
                    <td><?= $credit['id']; ?></td>
                    <td><?= $credit['product_name']; ?></td>
                    <td><?= $credit['credit_type']; ?></td>
                    <td><?= $credit['artist_name']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

</body>
</html>
