<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentsViewPage</title>
</head>

<body>
    <form method="POST" action="/database/create/1">

        <label>Last Name:</label>
        <input type="text" name="last_name" required><br>

        <label>First Name:</label>
        <input type="text" name="first_name" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <button type="submit">Create</button>
    </form>
</body>

</html>