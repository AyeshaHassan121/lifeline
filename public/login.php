<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../config/database.php';

if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit;
}

$error = "";
$email = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare(
        "SELECT id, name, email, password_hash, role FROM users WHERE email = ?"
    );
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];

        header("Location: home.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}

$pageTitle = "Login";
include __DIR__ . '/../includes/header.php';
?>
<div class="card form-card">
    <h1>Login</h1>

    <?php if (isset($_GET['registered'])): ?>
        <div class="alert success">Account created! Please login.</div>
    <?php endif; ?>

    <?php if ($error !== ""): ?>
        <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">

        <label>Password</label>
        <input type="password" name="password">

        <button class="btn" type="submit">Login</button>
    </form>

    <p>No account? <a href="signup.php">Sign up</a></p>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
