<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students List</title>
  <?php load_css(['css/style']); ?>
  <?php load_css(['css/get_all']); ?>
</head>

<style>
  .pagination-nav {
    display: flex;
    justify-content: center;
    margin-top: 1rem;
  }

  .pagination-list {
    display: inline-flex;
    gap: 0.5rem;
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .pagination-item {
    margin: 0;
  }

  .pagination-link {
    display: flex;
    justify-content: center;
    align-items: center;
    min-width: 2.5rem;
    height: 2.5rem;
    padding: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #6b7280;
    background-color: #fff;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    text-decoration: none;
    transition: 0.2s ease-in-out;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
  }

  .pagination-link:hover {
    background-color: #f9fafb;
    color: #374151;
    border-color: #9ca3af;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .pagination-item.active .pagination-link {
    background-color: #3b82f6;
    color: #fff;
    border-color: #3b82f6;
    font-weight: 600;
    box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
  }

  .pagination-item.active .pagination-link:hover {
    background-color: #2563eb;
    border-color: #2563eb;
    transform: translateY(-1px);
    box-shadow: 0 4px 6px rgba(59, 130, 246, 0.4);
  }

  .pagination-item:first-child .pagination-link,
  .pagination-item:last-child .pagination-link {
    background-color: #f8fafc;
    border-color: #e2e8f0;
    color: #64748b;
    font-weight: 500;
  }

  .pagination-item.disabled .pagination-link {
    background-color: #f8fafc;
    border-color: #e2e8f0;
    color: #cbd5e1;
    cursor: not-allowed;
    pointer-events: none;
  }
</style>


<body>
  <div class="main-container">
    <header class="page-header">
      <h1 class="form-title">USERS MANAGEMENT</h1>

      <a id="btn-add-user" class="btn btn-primary" href="<?= base_url() . 'users/create' ?>">
        <span>Add New Accounts</span>
      </a>

      <div class="student-count">
        <?php echo count($users); ?> Registered accounts
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
          <?php foreach ($users as $user): ?>
            <tr id="student-row-<?= $user['id'] ?>">
              <td data-label="Student ID"><?= htmlspecialchars($user['id']) ?></td>
              <td data-label="First Name"><?= htmlspecialchars($user['first_name']) ?></td>
              <td data-label="Last Name"><?= htmlspecialchars($user['last_name']) ?></td>
              <td data-label="Email"><?= htmlspecialchars($user['email']) ?></td>
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

    <!-- Pagination Controls -->
    <?php if (isset($pagination_data)): ?>
      <div class="mt-8">
        <?php if (!empty($pagination_links)): ?>
          <div class="flex justify-center mb-4">
            <?php echo $pagination_links; ?>
          </div>
        <?php endif; ?>

        <div class="flex justify-between items-center text-sm text-gray-600">
          <div><?php echo $pagination_data['info']; ?></div>
          <div class="flex items-center space-x-2">
            <span>Items per page:</span>
            <select id="itemsPerPage" class="px-3 py-1 bg-gray-200 border border-gray-300 rounded-lg text-gray-700">
              <option value="10" <?php echo ($_GET['per_page'] == 10) ? 'selected' : ''; ?>>10</option>
              <option value="25" <?php echo ($_GET['per_page'] == 25) ? 'selected' : ''; ?>>25</option>
              <option value="50" <?php echo ($_GET['per_page'] == 50) ? 'selected' : ''; ?>>50</option>
              <option value="100" <?php echo ($_GET['per_page'] == 100) ? 'selected' : ''; ?>>100</option>
            </select>
          </div>
        </div>
      </div>
    <?php endif; ?>


  </div>

  <script>
    function confirmDelete(studentId, studentName) {
      if (confirm(`Are you sure you want to delete ${studentName}? This action cannot be undone.`)) {
        window.location.href = '<?= base_url() ?>users/delete/' + studentId;
      }
    }

    document.addEventListener('DOMContentLoaded', function () {
      const itemsPerPageSelect = document.getElementById('itemsPerPage');
      if (itemsPerPageSelect) {
        itemsPerPageSelect.addEventListener('change', function () {
          const selectedValue = this.value;
          const currentUrl = new URL(window.location.href);
          currentUrl.searchParams.set('per_page', selectedValue);
          if (currentUrl.pathname.includes('/index/')) {
            currentUrl.pathname = currentUrl.pathname.replace(/\\/index\\/\\d+/, '/index/1');
          }
          window.location.href = currentUrl.toString();
        });
      }
    });
  </script>



</body>



</html>