<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Student</title>

  <style>
    :root {
      --bg: #f5f7fb;
      --card-bg: #ffffff;
      --primary: #4f46e5;   /* indigo-600 */
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
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      color: var(--text);
    }

    .container {
      width: 100%;
      max-width: 480px;
      padding: 20px;
    }

    .card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: 0 8px 20px rgba(0,0,0,0.04);
      padding: 32px;
      animation: fadeIn 0.4s ease;
    }

    .header {
      text-align: center;
      margin-bottom: 24px;
    }

    .header h2 {
      margin: 0;
      font-size: 1.6rem;
      font-weight: 600;
      color: var(--text);
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    input {
      padding: 12px 14px;
      border-radius: var(--radius);
      border: 1px solid var(--border);
      font-size: 1rem;
      background: #fafafa;
      transition: all 0.2s;
    }

    input:focus {
      outline: none;
      border-color: var(--primary);
      background: #fff;
      box-shadow: 0 0 0 3px rgba(79,70,229,0.15);
    }

    button {
      background: var(--primary);
      color: #fff;
      padding: 12px;
      border: none;
      border-radius: var(--radius);
      font-size: 1rem;
      font-weight: 500;
      cursor: pointer;
      transition: background 0.2s, transform 0.1s;
    }

    button:hover {
      background: var(--primary-hover);
      transform: translateY(-1px);
    }

    .back-link {
      display: inline-block;
      margin-top: 18px;
      font-size: 0.95rem;
      text-decoration: none;
      color: var(--muted);
      transition: color 0.2s;
    }

    .back-link:hover {
      color: var(--primary);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(8px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="card">
      <div class="header">
        <h2>➕ Add Student</h2>
      </div>

      <form method="POST">
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Save Student</button>
      </form>

      <a class="back-link" href="<?= base_url() ?>students">⬅ Back to Students</a>
    </div>
  </div>

</body>
</html>
