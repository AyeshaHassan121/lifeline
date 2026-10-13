<?php
require_once __DIR__ . '/../includes/auth.php';

$pageTitle = "Dashboard";
include __DIR__ . '/../includes/header.php';
?>
<h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
<p>You are logged in as <strong><?php echo htmlspecialchars($_SESSION['user_email']); ?></strong>.</p>
<?php include __DIR__ . '/../includes/footer.php'; ?>
