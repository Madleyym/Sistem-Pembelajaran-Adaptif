<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Halaman login sistem pembelajaran">
    <meta name="author" content="Your Name">
    <title>Login - Sistem Pembelajaran</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .card {
            border-radius: 15px;
            border: none;
        }

        .card-title {
            color: #2c3e50;
            font-weight: 600;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            padding: 10px;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        .alert {
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="text-center mb-4">
                        <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" class="img-fluid" style="max-height: 100px;">
                    </div>

                    <div class="card shadow-lg">
                        <div class="card-body p-4">
                            <h3 class="card-title text-center mb-4">Login</h3>

                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <?= session()->getFlashdata('error') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show">
                                    <i class="fas fa-check-circle me-2"></i>
                                    <?= session()->getFlashdata('success') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>

                            <form action="<?= base_url('login') ?>" method="post" id="loginForm">
                                <?= csrf_field() ?>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" id="username" name="username"
                                            required minlength="3" maxlength="50"
                                            value="<?= old('username') ?>"
                                            placeholder="Masukkan username">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group position-relative">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" id="password" name="password"
                                            required minlength="6"
                                            placeholder="Masukkan password">
                                        <span class="password-toggle" onclick="togglePassword()">
                                            <i class="fas fa-eye" id="toggleIcon"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Ingat saya</label>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 mb-3">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login
                                </button>

                                <div class="text-center">
                                    <a href="<?= base_url('forgot-password') ?>" class="text-decoration-none">
                                        Lupa password?
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="text-center mt-3 text-muted">
                        <small>&copy; <?= date('Y') ?> Sistem Pembelajaran. All rights reserved.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        // Form validation
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;

            if (username.length < 3) {
                event.preventDefault();
                alert('Username minimal 3 karakter!');
                return false;
            }

            if (password.length < 6) {
                event.preventDefault();
                alert('Password minimal 6 karakter!');
                return false;
            }
        });
    </script>
</body>

</html>