<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students List</title>
  <?php load_css(['css/style']); ?>
  <?php load_css(['css/get_all']); ?>
</head>

<body>
  <div class="main-container">
    <header class="page-header">
      <h1 class="page-title">Student Management</h1>
      <a class="btn btn-primary" href="<?= base_url() . 'users/create' ?>">
        <span>Add New Student</span>
      </a>
    </header>
    
    <div class="student-count">
      <strong><?php echo count($students); ?></strong> students currently enrolled
    </div>

    <div class="data-card">
      <table class="data-table" id="students-table">
        <thead>
          <tr>
            <th scope="col">Student ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email Address</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($students as $student): ?>
            <tr id="student-row-<?= $student['id'] ?>">
              <td data-label="Student ID"><?= htmlspecialchars($student['id']) ?></td>
              <td data-label="First Name"><?= htmlspecialchars($student['first_name']) ?></td>
              <td data-label="Last Name"><?= htmlspecialchars($student['last_name']) ?></td>
              <td data-label="Email"><?= htmlspecialchars($student['email']) ?></td>
              <td data-label="Actions" class="table-actions">
                <a href="<?= base_url() . 'users/update/' . $student['id'] ?>" 
                   class="btn btn-secondary btn-small"
                   aria-label="Edit <?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?>">
                  Edit
                </a>
                <button type="button" 
                        class="btn btn-danger btn-small"
                        onclick="confirmDelete('<?= $student['id'] ?>', '<?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?>')"
                        aria-label="Delete <?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?>">
                  Delete
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    function confirmDelete(studentId, studentName) {
      if (confirm(`Are you sure you want to delete ${studentName}? This action cannot be undone.`)) {
        window.location.href = '<?= base_url() ?>users/delete/' + studentId;
      }
    }
  </script>
</body>



</html>