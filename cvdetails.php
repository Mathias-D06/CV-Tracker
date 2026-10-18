<?php
session_start();
require_once('connectdb.php');
$id = $_GET['id'];
$sql = "SELECT * FROM cvs WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $id]);
$cv = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <title>AstonCV - CV Details</title>
    </head>
    <body>
        <?php include('nav.php'); ?>
        <header>
            <h1>CV Details</h1>
            <a href="index.php">Back to Main Directory</a>
        </header>
        <main>
            <?php if ($cv): ?>      
                <h2><?= $cv['name'] ?>'s Profile</h2>       
                <ul>
                    <li><strong>Email:</strong> <?= $cv['email'] ?></li>
                    <li><strong>Key Programming:</strong> <?= $cv['keyprogramming'] ?></li>
                    <li><strong>Education:</strong> <?= $cv['education'] ?></li>
                    <li><strong>Profile:</strong> <?= $cv['profile'] ?></li>
                    <li><strong>Links:</strong> <?= $cv['URLlinks'] ?></li>
                </ul>
            <?php else: ?>
                <p>Sorry, that CV could not be found.</p>
            <?php endif; ?>
        </main>
    </body>
</html>