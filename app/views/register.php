<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pyratite</title>
    <!-- Common Styles -->
    <link rel="stylesheet" href="<?= base_url() . 'public/css/style.css' ?>">
    <!-- Login Base Styles -->
    <link rel="stylesheet" href="<?= base_url() . 'public/css/login.css' ?>">
    <!-- Register Specific Styles -->
    <link rel="stylesheet" href="<?= base_url() . 'public/css/register.css' ?>">
</head>

<body>
    <div class="login-container">
        <div class="login-card register-card">
            <!-- Register Header -->
            <div class="login-header">
                <h1 class="login-title">Create Account</h1>
                <p class="login-subtitle">Sign up to get started with your account</p>
            </div>

            <!-- Register Form -->
            <form class="login-form register-form" method="POST" action="<?= base_url() . 'auth/register' ?>">
                <?php if (isset($error)): ?>
                    <div class="alert alert-error">
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($success)): ?>
                    <div class="alert alert-success">
                        <?= $success ?>
                    </div>
                <?php endif; ?>

                <!-- Name Fields -->
                <div class="name-row">
                    <div class="form-group">
                        <label for="first_name" class="form-label">First Name</label>
                        <input 
                            type="text" 
                            id="first_name" 
                            name="first_name" 
                            class="form-input" 
                            placeholder="Enter your first name"
                            value="<?= isset($old_first_name) ? $old_first_name : '' ?>"
                            required
                        >
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input 
                            type="text" 
                            id="last_name" 
                            name="last_name" 
                            class="form-input" 
                            placeholder="Enter your last name"
                            value="<?= isset($old_last_name) ? $old_last_name : '' ?>"
                            required
                        >
                    </div>
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input" 
                        placeholder="Enter your email"
                        value="<?= isset($old_email) ? $old_email : '' ?>"
                        required
                    >
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-input-container">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-input password-input" 
                            placeholder="Create a password"
                            required
                            minlength="6"
                        >
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <span class="password-eye" id="password-eye">🙉</span>
                        </button>
                    </div>
                    <small class="form-help">Password must be at least 6 characters long</small>
                </div>

                <!-- Confirm Password Field -->
                <div class="form-group">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <div class="password-input-container">
                        <input 
                            type="password" 
                            id="confirm_password" 
                            name="confirm_password" 
                            class="form-input password-input" 
                            placeholder="Confirm your password"
                            required
                        >
                        <button type="button" class="password-toggle" onclick="togglePassword('confirm_password')">
                            <span class="password-eye" id="confirm_password-eye">🙉</span>
                        </button>
                    </div>
                </div>

                <!-- Register Button -->
                <button type="submit" class="login-button register-button" id="registerBtn">
                    Create Account
                </button>

                <!-- Divider -->
                <div class="login-divider">
                    <span>or</span>
                </div>

                <!-- Login Link -->
                <div class="signup-link">
                    <p>Already have an account? <a href="<?= base_url() . 'auth/login' ?>">Sign in</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Add loading state to register button
        document.getElementById('registerBtn').addEventListener('click', function() {
            this.classList.add('loading');
            this.textContent = 'Creating Account...';
        });

        // Password confirmation validation
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');

        function validatePasswordMatch() {
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity('Passwords do not match');
            } else {
                confirmPassword.setCustomValidity('');
            }
        }

        password.addEventListener('input', validatePasswordMatch);
        confirmPassword.addEventListener('input', validatePasswordMatch);

        // Form submission validation
        document.querySelector('.login-form').addEventListener('submit', function(e) {
            const firstName = document.getElementById('first_name').value;
            const lastName = document.getElementById('last_name').value;
            const email = document.getElementById('email').value;
            const pwd = document.getElementById('password').value;
            const confirmPwd = document.getElementById('confirm_password').value;
            
            if (!firstName || !lastName || !email || !pwd || !confirmPwd || pwd !== confirmPwd) {
                e.preventDefault();
                document.getElementById('registerBtn').classList.remove('loading');
                document.getElementById('registerBtn').textContent = 'Create Account';
                return;
            }
        });

        // Auto-focus on first name field
        document.getElementById('first_name').focus();

        // Password visibility toggle functionality
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(inputId + '-eye');
            
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