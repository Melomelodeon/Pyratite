<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Student</title>
  <link rel="stylesheet" href="<?= base_url() . 'public/css/style.css' ?>">
  <link rel="stylesheet" href="<?= base_url() . 'public/css/update.css' ?>">
</head>

<body>
  <div id="update-container" class="container">
    <div id="update-card" class="card">
      <header id="update-header" class="header">
        <h2>Edit Account</h2>
      </header>
      
      <form id="update-student-form" method="POST">
        <div class="form-group">
          <label for="update-first-name">First Name</label>
          <input 
            type="text" 
            id="update-first-name"
            name="first_name" 
            value="<?= $user['first_name'] ?>" 
            placeholder="Enter first name"
            required
          >
        </div>
        
        <div class="form-group">
          <label for="update-last-name">Last Name</label>
          <input 
            type="text" 
            id="update-last-name"
            name="last_name" 
            value="<?= $user['last_name'] ?>" 
            placeholder="Enter last name"
            required
          >
        </div>
        
        <div class="form-group">
          <label for="update-email">Email Address</label>
          <input 
            type="email" 
            id="update-email"
            name="email" 
            value="<?= $user['email'] ?>" 
            placeholder="Enter email address"
            required
          >
        </div>
        
        <div class="form-group">
          <label for="update-password">Password</label>
          <div class="password-input-container">
            <input 
              type="password" 
              id="update-password"
              name="password" 
              value="<?= isset($user['password']) ? $user['password'] : '' ?>" 
              placeholder="Enter new password (leave blank to keep current)"
              minlength="6"
            >
            <button type="button" class="password-toggle" onclick="toggleUpdatePassword()" title="Show password">
              <span id="update-password-eye">🙉</span>
            </button>
          </div>
          <small class="form-help">Leave blank to keep current password</small>
        </div>
        
        <div class="form-group">
          <label for="update-active">Account Status</label>
          <select 
            id="update-active" 
            name="active" 
            required
          >
            <option value="1" <?= (isset($user['active']) && $user['active'] == 1) ? 'selected' : '' ?>>Active</option>
            <option value="0" <?= (isset($user['active']) && $user['active'] == 0) ? 'selected' : '' ?>>Inactive</option>
          </select>
        </div>
        
        <div class="form-actions">
          <button type="submit" id="update-submit-btn" class="btn-primary">
            <span class="btn-text">Update Acount</span>
          </button>
          <a id="back-from-update" class="btn-secondary" href="<?= base_url() ?>users">
            Back to Main Page
          </a>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Password visibility toggle functionality
    function toggleUpdatePassword() {
      const passwordInput = document.getElementById('update-password');
      const eyeIcon = document.getElementById('update-password-eye');
      
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