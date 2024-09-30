<?php

include '../Vinyl-Store/components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

// Fetch tracklists
$tracklists = $conn->query("SELECT * FROM `media_tracklists` ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);

// Add a new tracklist
if (isset($_POST['add_tracklist'])) {
    $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
    $platform = filter_var($_POST['platform'], FILTER_SANITIZE_STRING);
    $tracklist_url = filter_var($_POST['tracklist_url'], FILTER_SANITIZE_URL);

    // Insert new tracklist
    $insert_tracklist = $conn->prepare("INSERT INTO `media_tracklists` (product_id, platform, tracklist_url) VALUES (?, ?, ?)");
    $insert_tracklist->execute([$product_id, $platform, $tracklist_url]);

    if ($insert_tracklist) {
        $message[] = 'New Tracklist Added!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracklists</title>
    <link rel="icon" href="images/favicon.ico" type="images/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../Vinyl-Store/css/admin_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<?php include '../Vinyl-Store/components/admin_header.php'; ?>

<section class="form-section">
    <h1>Add Tracklist</h1>
    <form action="" method="POST">
        <input type="number" name="product_id" placeholder="Product ID" required>
        <select name="platform" required>
            <option value="YouTube">YouTube</option>
            <option value="Spotify">Spotify</option>
            <option value="AppleMusic">AppleMusic</option>
        </select>
        <input type="url" name="tracklist_url" placeholder="Tracklist URL" required>
        <input type="submit" value="Add Tracklist" name="add_tracklist">
    </form>

    <?php if (isset($message)): ?>
        <p><?= implode(', ', $message); ?></p>
    <?php endif; ?>
</section>

<section class="list-section">
    <h2>Tracklists</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product ID</th>
                <th>Platform</th>
                <th>Tracklist URL</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tracklists as $tracklist): ?>
                <tr>
                    <td><?= $tracklist['id']; ?></td>
                    <td><?= $tracklist['product_id']; ?></td>
                    <td><?= $tracklist['platform']; ?></td>
                    <td><?= $tracklist['tracklist_url']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

</body>
</html>
