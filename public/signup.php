<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../config/database.php';

if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit;
}

$error = "";
$name = "";
$email = "";
$phone = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($name === '') {
        $error = "Name is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } elseif (!preg_match('/^[0-9+\- ]{10,20}$/', $phone)) {
        $error = "Enter a valid phone number.";
    } elseif (strlen($password) < 8) {
        $error = "Password must contain at least 8 characters.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        if ($stmt->get_result()->num_rows > 0) {
            $error = "Email already registered.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare(
                "INSERT INTO users (name, email, phone, password_hash) VALUES (?, ?, ?, ?)"
            );
            $stmt->bind_param("ssss", $name, $email, $phone, $hash);
            $stmt->execute();

            header("Location: login.php?registered=1");
            exit;
        }
    }
}

$pageTitle = "Sign up";
include __DIR__ . '/../includes/header.php';
?>
<div class="card form-card">
    <h1>Create Account</h1>

    <?php if ($error !== ""): ?>
        <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">

        <label>Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">

        <label>Phone</label>
        <input type="tel" name="phone" value="<?php echo htmlspecialchars($phone); ?>">

        <label>Password</label>
        <input type="password" name="password">

        <label>Confirm Password</label>
        <input type="password" name="confirm_password">

        <button class="btn" type="submit">Create Account</button>
    </form>

    <p>Already have an account? <a href="login.php">Login</a></p>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
