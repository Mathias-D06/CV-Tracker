<?php
session_start();
require_once('connectdb.php');
if (isset($_GET["search"]) && !empty($_GET["search"])) {
    $searchTerm = "%" . $_GET["search"] . "%";
    $sql = "SELECT id, name, email, keyprogramming FROM cvs WHERE name LIKE :term OR keyprogramming LIKE :term";
    $rows = $db->prepare($sql);
    $rows->execute(['term' => $searchTerm]);
} else{
    $rows = $db->query("SELECT id,name,email,keyprogramming FROM cvs");
}
$cvs = $rows->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <title>AstonCV - Home</title>
        </head>
    <body>
        <?php include('nav.php'); ?>
        <header>
            <h1>Welcome to AstonCV</h1>
        </header>
        <main>
            <h2>CV Directory</h2>
            <ul>
                <?php foreach ($cvs as $row): ?>
                <li>
                    <strong>Id:</strong> <?= $row["id"] ?> <br>
                    <strong>Name:</strong> <a href="cvdetails.php?id=<?= $row["id"] ?>"><?= $row["name"] ?></a> <br>
                    <strong>Email:</strong> <?= $row["email"] ?> <br>
                    <strong>Key Programming:</strong> <?= $row["keyprogramming"] ?>
                </li>
                <hr> <?php endforeach; ?>
            </ul>
            <form action="index.php" method="GET">
                <label for="search">Find a Programmer:</label>
                <input type="text" id="search" name="search" placeholder="Search name or language">
                <button type="submit">Search</button>
                <a href="index.php">Clear Search</a>
            </form>    
            <hr>
        </main>
    </body>
</html>