<?php

include '../Vinyl-Store/components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

// Fetch artists
$artists = $conn->query("SELECT * FROM `artists` ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);

// Add a new artist
if (isset($_POST['add_artist'])) {
    $artist_name = filter_var($_POST['artist_name'], FILTER_SANITIZE_STRING);
    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);

    // Check if artist already exists
    $select_artists = $conn->prepare("SELECT * FROM `artists` WHERE artist_name = ?");
    $select_artists->execute([$artist_name]);

    if ($select_artists->rowCount() > 0) {
        $message[] = 'Artist Already Exists!';
    } else {
        $insert_artist = $conn->prepare("INSERT INTO `artists` (artist_name, bio) VALUES (?, ?)");
        $insert_artist->execute([$artist_name, $bio]);

        if ($insert_artist) {
            $message[] = 'New Artist Added!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artists</title>
    <link rel="icon" href="images/favicon.ico" type="images/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../Vinyl-Store/css/admin_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<?php include '../Vinyl-Store/components/admin_header.php'; ?>

<div class="container">

<section class="form-section">
    <h1>Add Artist</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="flex">
            <div class="inputBox">
                <span>Artist Name (Required)</span>
                <input type="text" class="box" required maxlength="100" name="artist_name" placeholder="Artist Name" required>
            </div>
            <div class="inputBox">
                <span>Artist Bio (Required)</span>
                <textarea name="bio" placeholder="Artist Bio" required></textarea>
            </div>
        </div>
        <input type="submit" value="Add Artist" name="add_artist">
    </form>

    <?php if (isset($message)): ?>
        <p><?= implode(', ', $message); ?></p>
    <?php endif; ?>
</section>

<section class="list-section">
    <h2>Artists List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Artist Name</th>
                <th>Bio</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($artists as $artist): ?>
                <tr>
                    <td><?= $artist['id']; ?></td>
                    <td><?= $artist['artist_name']; ?></td>
                    <td><?= $artist['bio']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
</div>

</body>
</html>
