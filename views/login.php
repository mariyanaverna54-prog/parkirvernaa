<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ANTI-BACK: Jika sudah login, paksa ke dashboard masing-masing
if (isset($_SESSION['user'])) {
    $role = $_SESSION['user']['role'];
    $redirect = [
        'admin'   => 'index.php?c=Dashboard&m=index',
        'petugas' => 'index.php?c=Dashboard&m=index',
        'owner'   => 'index.php?c=Dashboard&m=index'
    ];
    header("Location: " . ($redirect[$role] ?? 'index.php'));
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Parkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body class="login-page">

<div class="login-container">
    <div class="glass-card">
        <div class="brand-logo">
            <i class="fas fa-parking"></i>
        </div>
        <h1>Login</h1>
        <p class="subtitle">Sistem Parkir</p>

        <?php if (isset($error)): ?>
            <div class="error-alert">
                <i class="fas fa-exclamation-triangle me-2"></i> <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php?c=Auth&m=login">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <div class="input-group-custom">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required autocomplete="off">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group-custom">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="passwordField" placeholder="••••••••" required>
                    <i class="fas fa-eye" id="togglePassword" style="cursor: pointer; padding-right: 15px; padding-left: 0;"></i>
                </div>
            </div>

            <button type="submit" name="login" class="btn-login">Masuk Sekarang</button>
        </form>
    </div>
</div>

<script src="assets/js/login.js"></script>

</body>
</html>
