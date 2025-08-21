<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Student</title>
  <?php load_css(['css/style']); ?>
  <?php load_css(['css/update']); ?>
</head>

<body>
  <div id="update-container" class="container">
    <div id="update-card" class="card">
      <header id="update-header" class="header">
        <!-- Updated title to match original request -->
        <h2>Edit Student</h2>
      </header>
      
      <form id="update-student-form" method="POST">
        <div class="form-group">
          <label for="update-first-name">First Name</label>
          <input 
            type="text" 
            id="update-first-name"
            name="first_name" 
            value="<?= $student['first_name'] ?>" 
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
            value="<?= $student['last_name'] ?>" 
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
            value="<?= $student['email'] ?>" 
            placeholder="Enter email address"
            required
          >
        </div>
        
        <div class="form-actions">
          <button type="submit" id="update-submit-btn" class="btn-primary">
            <span class="btn-text">Update Student</span>
            <span class="btn-loading">Updating...</span>
          </button>
          <a id="back-from-update" class="btn-secondary" href="<?= base_url() ?>users">
            Back to Students
          </a>
        </div>
      </form>
    </div>
  </div>
</body>



</html>