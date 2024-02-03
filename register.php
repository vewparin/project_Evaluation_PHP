
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=.head, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
    <div class="header">
        <h2>Register</h2>
    </div>

    <form action="register_db.php" method="post" class="p-4 rounded shadow-lg bg-light">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="password_1" class="form-label">Password</label>
        <input type="password" name="password_1" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="password_2" class="form-label">Confirm Password</label>
        <input type="password" name="password_2" class="form-control" required>
    </div>
    <div class="mb-3">
        <button type="submit" name="reg_user" class="btn btn-primary">Register</button>
    </div>
    <p class="mb-0">Already a member? <a href="index.php">Sign in</a></p>
</form>

</body>

</html>