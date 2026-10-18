<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
require_once('connectdb.php');
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM cvs WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $keyprogramming = $_POST["Keyprogramming"];
    $url = $_POST["URLlinks"];
    $education = $_POST["education"]; 
    $profile = $_POST["profile"];     
    $sql = "UPDATE cvs SET keyprogramming = :keyprogramming, URLlinks = :url, education = :education, profile = :profile WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(["keyprogramming" => $keyprogramming, "url" => $url, "education" => $education, "profile" => $profile, "id" => $user_id]);
    echo "Your CV has been updated";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <title>AstonCV - Update CV</title>
    </head>
    <body>
        <?php include('nav.php'); ?>
        <h1>Fill in your Details Here</h1>
        <form id="CV Update" action="cvupdate.php" method="POST">
            <label for="keyprogramming">Key Programming Language:</label>
            <select id="keyprogramming" name="Keyprogramming">
                <option value="Java" <?php if($user["keyprogramming"] == "Java") echo "selected"; ?>>Java</option>
                <option value="Python" <?php if($user["keyprogramming"] == "Python") echo "selected"; ?>>Python</option>
                <option value="PHP" <?php if($user["keyprogramming"] == "PHP") echo "selected"; ?>>PHP</option>
                <option value="C++" <?php if($user["keyprogramming"] == "C++") echo "selected"; ?>>C++</option>
                <option value="JavaScript" <?php if($user["keyprogramming"] == "JavaScript") echo "selected"; ?>>JavaScript</option>
            </select>
            <label for="urllinks">URL Links:</label>
            <input type="text" id="urllinks" name="URLlinks" value="<?= htmlspecialchars($user["URLlinks"] ?? '') ?>">
            <label for="education">Education:</label>
            <textarea id="education" name="education"><?= htmlspecialchars($user["education"] ?? '') ?></textarea>
            <label for="profile">Profile:</label>
            <textarea id="profile" name="profile"><?= htmlspecialchars($user["profile"] ?? '') ?></textarea><br><br>
            <input type="submit" value="Update Profile">
        </form>    
    </body>
</html>