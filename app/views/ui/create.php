<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Student</title>
  <?php load_css(['css/style']); ?>
  <?php load_css(['css/create']); ?>
</head>

<body>
  <div class="main-container">
    <div class="form-card">
      <div class="form-header">
        <h1 class="form-title">Add New Student</h1>
        <p class="form-subtitle">Enter student information below</p>
      </div>
      
      <form id="student-form" method="POST" class="student-form">
        <div class="form-group">
          <label for="first_name" class="form-label">First Name</label>
          <input 
            type="text" 
            id="first_name" 
            name="first_name" 
            class="form-input" 
            placeholder="Enter first name" 
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
            placeholder="Enter last name" 
            required
          >
        </div>
        
        <div class="form-group">
          <label for="email" class="form-label">Email Address</label>
          <input 
            type="email" 
            id="email" 
            name="email" 
            class="form-input" 
            placeholder="Enter email address" 
            required
          >
        </div>
        
        <div class="form-actions">
          <button type="submit" class="btn btn-primary btn-submit">
            Save Student
          </button>
          <a href="<?= base_url() ?>users" class="btn btn-secondary">
            Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
</body>


</html>