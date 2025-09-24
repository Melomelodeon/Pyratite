<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pyratite</title>
    <link rel="stylesheet" href="<?= base_url() . 'public/css/style.css' ?>">
    <link rel="stylesheet" href="<?= base_url() . 'public/css/login.css' ?>">
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Login Header -->
            <div class="login-header">
                <h1 class="login-title">Welcome Back</h1>
                <p class="login-subtitle">Sign in to your account to continue</p>
            </div>

            <!-- Login Form -->
            <form class="login-form" method="POST" action="<?= base_url() . 'auth/login' ?>">
                <?php if (isset($error)): ?>
                    <?php if (strpos($error, 'inactive') !== false): ?>
                        <div class="alert alert-warning">
                            <?= $error ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-error">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (isset($success)): ?>
                    <div class="alert alert-success">
                        <?= $success ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['registered'])): ?>
                    <div class="alert alert-success">
                        Registration successful! Please login with your credentials.
                    </div>
                <?php endif; ?>

                <!-- Email/Username Field -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" name="email" class="form-input" placeholder="Enter your email"
                        value="<?= isset($old_email) ? $old_email : '' ?>" required>
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-input-container">
                        <input type="password" id="password" name="password" class="form-input"
                            placeholder="Enter your password" required>
                        <button type="button" class="password-toggle" onclick="toggleLoginPassword()" title="Show password">
                            <span id="login-password-eye">🙉</span>
                        </button>
                    </div>
                </div>

                <!-- Login Options -->
                <div class="login-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember" value="1">
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="<?= base_url() . 'auth/forgot-password' ?>" class="forgot-password">
                        Forgot Password?
                    </a>
                </div>

                <!-- Login Button -->
                <button type="submit" class="login-button" id="loginBtn">
                    Sign In
                </button>

                <!-- Divider -->
                <div class="login-divider">
                    <span>or</span>
                </div>

                <!-- Sign Up Link -->
                <div class="signup-link">
                    <p>Don't have an account? <a href="<?= base_url() . 'auth/register' ?>">Sign up</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('loginBtn').addEventListener('click', function () {
            this.classList.add('loading');
            this.textContent = 'Signing In...';
        });

        document.querySelector('.login-form').addEventListener('submit', function (e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (!email || !password) {
                e.preventDefault();
                document.getElementById('loginBtn').classList.remove('loading');
                document.getElementById('loginBtn').textContent = 'Sign In';
            }
        });

        document.getElementById('email').focus();

        // Check for remember me cookie and pre-fill email
        function getCookie(name) {
            const value = "; " + document.cookie;
            const parts = value.split("; " + name + "=");
            if (parts.length === 2) return parts.pop().split(";").shift();
        }

        const rememberCookie = getCookie('remember_user');
        if (rememberCookie) {
            try {
                const cookieData = JSON.parse(decodeURIComponent(rememberCookie));
                if (cookieData.email) {
                    document.getElementById('email').value = cookieData.email;
                    document.getElementById('remember').checked = true;
                    document.getElementById('password').focus(); // Focus password instead
                }
            } catch (e) {
                // Invalid cookie data, ignore
            }
        }

        // Password visibility toggle functionality
        function toggleLoginPassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('login-password-eye');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '🙈'; // Hide icon
                eyeIcon.parentElement.title = 'Hide password';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '🙉'; // Show icon
                eyeIcon.parentElement.title = 'Show password';
            }
        }
    </script>
</body>

</html>