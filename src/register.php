<?php
$pageTitle = "Register";
include 'header.php';

if (isLoggedIn()) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (register($username, $password)) {
        header("Location: login.php");
        exit;
    } else {
        $error = "Registrasi gagal! Username sudah digunakan.";
    }
}
?>

<div class="container" style="max-width: 400px; margin-top: 100px;">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title text-center"><i class="fas fa-user-plus"></i> Register</h3>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="form-group">
                    <label><i class="fas fa-user"></i> Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-lock"></i> Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-user-plus"></i> Register</button>
            </form>
            <div class="text-center mt-3">
                <p>Sudah punya akun? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
