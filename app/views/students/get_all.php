<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students List</title>

  <style>
    :root {
      --bg: #f5f7fb;
      --card-bg: #ffffff;
      --primary: #4f46e5;
      /* indigo */
      --primary-hover: #4338ca;
      --border: #e5e7eb;
      --text: #1f2937;
      --muted: #6b7280;
      --radius: 14px;
      font-family: 'Segoe UI', system-ui, sans-serif;
    }

    body {
      margin: 0;
      background: var(--bg);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      padding: 32px;
      color: var(--text);
    }

    .container {
      width: 100%;
      max-width: 960px;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 18px;
    }

    h2 {
      margin: 0;
      font-size: 1.6rem;
      font-weight: 600;
    }

    .btn {
      display: inline-block;
      padding: 10px 16px;
      border-radius: var(--radius);
      text-decoration: none;
      font-weight: 500;
      font-size: 0.95rem;
      transition: all 0.2s;
    }

    .btn-primary {
      background: var(--primary);
      color: #fff;
      border: none;
    }

    .btn-primary:hover {
      background: var(--primary-hover);
      transform: translateY(-1px);
    }

    .card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
      overflow: hidden;
      animation: fadeIn 0.4s ease;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 14px 16px;
      border-bottom: 1px solid var(--border);
      text-align: left;
      font-size: 0.95rem;
    }

    th {
      background: #f9fafb;
      font-weight: 600;
      color: var(--muted);
      font-size: 0.9rem;
    }

    tr:hover td {
      background: #fdfdfd;
    }

    .actions a {
      margin-right: 10px;
      text-decoration: none;
      color: var(--primary);
      font-weight: 500;
      transition: color 0.2s;
    }

    .actions a:hover {
      color: var(--primary-hover);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(8px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h2>👨‍🎓 Students List</h2>
      <a class="btn btn-primary" href="<?= base_url() . 'students/create' ?>">➕ Add Student</a>
    </div>
  <?php echo count($students) . ' students loaded'; ?>

    <div class="card">
      <table>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
        <?php foreach ($students as $s): ?>
          <tr>
            <td><?= $s['id'] ?></td>
            <td><?= $s['first_name'] ?></td>
            <td><?= $s['last_name'] ?></td>
            <td><?= $s['email'] ?></td>
            <td class="actions">
              <a href="<?= base_url() . 'students/update/' . $s['id'] ?>">✏️ Edit</a>
              <a href="<?= base_url() . 'students/delete/' . $s['id'] ?>" onclick="return confirm('Delete student?')">🗑️
                Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>

</body>

</html>