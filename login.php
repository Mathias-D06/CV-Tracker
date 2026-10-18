<?php
session_start();
require_once('connectdb.php');
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM cvs WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->execute(["email" => $email]);
    if ($stmt->rowCount() == 0) {
        echo("Invalid email");
    } else {
        $user = $stmt->fetch();
        $check = password_verify($_POST["password"], $user["password"]);
        if ($check == FALSE){
            echo("Incorrect Password");
        } else{
            $_SESSION["user_id"] = $user["id"];
            header("Location: cvupdate.php");
            exit;   
        
        }
    }   
}
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <title>AstonCV - Login</title>
    </head>
    <body>
        <?php include('nav.php'); ?>
        <h1>Login Here</h1>
        <form id="login" action="login.php" method="POST">
            <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Your Email" required/>
            <label for="password">Password</label> 
                <input type="password" id="password" name="password" placeholder="Enter your password here" required/>
            <input type="submit" id="submit" value="Login"/>
        </form>    
    </body>
</html>