<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students List</title>
  <link rel="stylesheet" href="<?= base_url() . 'public/css/style.css' ?>">
  <link rel="stylesheet" href="<?= base_url() . 'public/css/get_all.css' ?>">
</head>

<body>
  <div class="main-container">
    <header class="page-header">
      <h1 class="form-title">USERS MANAGEMENT</h1>
      <a id="btn-add-user" class="btn btn-primary" href="<?= base_url() . 'users/create' ?>">
        <span>Add New Accounts</span>
      </a>

      <form method="get" action="/users/get-all">
        <input id="search-user" type="text" name="search" value="<?= $search ?? '' ?>" placeholder="Search...">
      </form>

      <div class="student-count">
        <?= $total_records ?> Registered accounts
      </div>
    </header>
    <div class="data-card">
      <table class="data-table" id="students-table">
        <thead>
          <tr>
            <th scope="col">User ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email Address</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($records as $user): ?>
            <tr id="student-row-<?= $user['id'] ?>">
              <td data-label="Student ID"><?= htmlspecialchars($user['id']) ?></td>
              <td data-label="First Name"><?= htmlspecialchars($user['first_name']) ?></td>
              <td data-label="Last Name"><?= htmlspecialchars($user['last_name']) ?></td>
              <td data-label="Email" class="<?= (isset($user['active']) && $user['active'] == 0) ? 'inactive-email' : '' ?>"><?= htmlspecialchars($user['email']) ?></td>
              <td data-label="Actions" class="table-actions">
                <a href="<?= base_url() . 'users/update/' . $user['id'] ?>" class="btn btn-secondary btn-small"
                  aria-label="Edit <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>">
                  Edit
                </a>
                <button type="button" class="btn btn-danger btn-small"
                  onclick="confirmDelete('<?= $user['id'] ?>', '<?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>')"
                  aria-label="Delete <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>">
                  Delete
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?php if (isset($pagination_data)): ?>
      <div>
        <?php if (!empty($pagination_links)): ?>
          <div>
            <?php echo $pagination_links; ?>
          </div>
        <?php endif; ?>

        <div id="pagination-info">
          <div><?php echo $pagination_data['info']; ?></div>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <!-- Floating Draggable Logout Button -->
  <div id="floating-logout" class="floating-logout-container" title="Drag to move">
    <button type="button" id="logout-btn" class="floating-logout-btn" onclick="showLogoutPopup()" title="Logout">
      <span>🗑️</span>
    </button>
    
    <!-- Logout Popup -->
    <div id="logout-popup" class="logout-popup" style="display: none;">
      <div class="popup-content">
        <h3>Confirm Logout</h3>
        <p>Are you sure you want to logout?</p>
        <div class="popup-actions">
          <button type="button" class="btn btn-secondary" onclick="hideLogoutPopup()">Cancel</button>
          <button type="button" class="btn btn-danger" onclick="confirmLogout()">Logout</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    function confirmDelete(studentId, studentName) {
      if (confirm(`Are you sure you want to delete ${studentName}? This action cannot be undone.`)) {
        window.location.href = '<?= base_url() ?>users/delete/' + studentId;
      }
    }

    function showLogoutPopup() {
      document.getElementById('logout-popup').style.display = 'flex';
    }

    function hideLogoutPopup() {
      document.getElementById('logout-popup').style.display = 'none';
    }

    function confirmLogout() {
      window.location.href = '<?= base_url() ?>users/logout';
    }

    // Close popup with Escape key
    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
        hideLogoutPopup();
      }
    });

    // Draggable functionality
    let isDragging = false;
    let dragOffset = { x: 0, y: 0 };
    const floatingElement = document.getElementById('floating-logout');

    floatingElement.addEventListener('mousedown', function(e) {
      if (e.target.closest('#logout-popup')) return; // Don't drag when clicking popup
      
      isDragging = true;
      const rect = floatingElement.getBoundingClientRect();
      dragOffset.x = e.clientX - rect.left;
      dragOffset.y = e.clientY - rect.top;
      
      floatingElement.style.cursor = 'grabbing';
      document.body.style.userSelect = 'none';
    });

    document.addEventListener('mousemove', function(e) {
      if (!isDragging) return;
      
      e.preventDefault();
      const x = e.clientX - dragOffset.x;
      const y = e.clientY - dragOffset.y;
      
      // Keep within viewport bounds
      const maxX = window.innerWidth - floatingElement.offsetWidth;
      const maxY = window.innerHeight - floatingElement.offsetHeight;
      
      const boundedX = Math.max(0, Math.min(x, maxX));
      const boundedY = Math.max(0, Math.min(y, maxY));
      
      floatingElement.style.left = boundedX + 'px';
      floatingElement.style.top = boundedY + 'px';
      floatingElement.style.right = 'auto';
      floatingElement.style.bottom = 'auto';
    });

    document.addEventListener('mouseup', function() {
      if (isDragging) {
        isDragging = false;
        floatingElement.style.cursor = 'grab';
        document.body.style.userSelect = '';
      }
    });

    // Touch events for mobile
    floatingElement.addEventListener('touchstart', function(e) {
      if (e.target.closest('#logout-popup')) return;
      
      isDragging = true;
      const touch = e.touches[0];
      const rect = floatingElement.getBoundingClientRect();
      dragOffset.x = touch.clientX - rect.left;
      dragOffset.y = touch.clientY - rect.top;
    });

    document.addEventListener('touchmove', function(e) {
      if (!isDragging) return;
      
      e.preventDefault();
      const touch = e.touches[0];
      const x = touch.clientX - dragOffset.x;
      const y = touch.clientY - dragOffset.y;
      
      const maxX = window.innerWidth - floatingElement.offsetWidth;
      const maxY = window.innerHeight - floatingElement.offsetHeight;
      
      const boundedX = Math.max(0, Math.min(x, maxX));
      const boundedY = Math.max(0, Math.min(y, maxY));
      
      floatingElement.style.left = boundedX + 'px';
      floatingElement.style.top = boundedY + 'px';
      floatingElement.style.right = 'auto';
      floatingElement.style.bottom = 'auto';
    });

    document.addEventListener('touchend', function() {
      isDragging = false;
    });
  </script>
</body>



</html>