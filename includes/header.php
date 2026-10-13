<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$pageTitle = $pageTitle ?? 'LifeLine';
$loggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> | LifeLine</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<header class="site-header">
    <div class="container nav">
        <a class="brand" href="index.php">&#10084; LifeLine</a>
        <nav>
            <a href="index.php">Home</a>
            <?php if ($loggedIn): ?>
                <a href="home.php">Dashboard</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="signup.php">Sign up</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="container">
