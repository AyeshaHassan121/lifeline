<?php
require_once __DIR__ . '/../includes/session.php';
$pageTitle = "Home";
include __DIR__ . '/../includes/header.php';
?>
<section class="hero">
    <svg class="hero-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
        <path d="M3.22 12H9.5l.5-1 2 4.5 2-7 1.5 3.5h5.27"/>
    </svg>
    <h1>Find a Donor. Save a Life.</h1>
    <p>Connect with blood donors near you and help make every second count.</p>
    <a class="btn" href="<?php echo $loggedIn ? 'home.php' : 'login.php'; ?>">Find a Donor</a>
    <a class="btn btn-outline" href="<?php echo $loggedIn ? 'home.php' : 'signup.php'; ?>">Become a Donor</a>
</section>
<section class="grid">
    <div class="card"><h3>1. Register</h3><p>Create an account and add your blood group and city.</p></div>
    <div class="card"><h3>2. Request</h3><p>Post an urgent request with the hospital and blood group needed.</p></div>
    <div class="card"><h3>3. Connect</h3><p>Matching donors respond so you can get in touch quickly.</p></div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
