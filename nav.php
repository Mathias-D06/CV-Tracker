<nav class="navigation-bar">
    <a href="index.php">Home</a> | 
    <?php if(isset($_SESSION["user_id"])): ?>
        <a href="cvupdate.php">Update CV</a> | 
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="register.php">Register</a> | 
        <a href="login.php">Login</a>
    <?php endif; ?>
</nav>
<hr>