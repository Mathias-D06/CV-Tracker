<?php
session_start();
require_once('connectdb.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("Enter a valid email");
    }
    $sql = "SELECT id FROM cvs WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->execute(["email" => $email]);
    if ($stmt->rowCount() > 0) {
        exit("An account with this email already exists");
    }
    $hashed = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $sql = "INSERT INTO cvs (name, email, password) VALUES (:name, :email, :password) ";
    $stmt = $db->prepare($sql);
    $stmt->execute(["name" => $_POST["name"], "email" => $email, "password" => $hashed]);
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <title>AstonCV - Regristration</title>
    </head>
    <body>
        <?php include('nav.php'); ?>
        <h1>Register Here</h1>
        <form id="register" action="register.php" method="POST">
            <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Your Name" required/>
            <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Your Email" required/> 
            <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password here" required/>
            <input type="submit" id="submit" value="Register"/>
        </form>    
    </body>
</html>