<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($password == $user['password']) { 
            $_SESSION['username'] = $user['username']; 
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "No user found with that username!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - To-Do List Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <div class="login">
        <div class="login-content">
            <h1>Login Now</h1>
            <p>Sign in to manage and organize tasks efficiently.</p>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form class="mt-4" action="login.php" method="POST">
                <div class="mb-3">
                    <input 
                        type="text" 
                        class="form-control form-control-lg" 
                        placeholder="Username" 
                        name="username" 
                        required>
                </div>
                <div class="mb-3">
                    <input 
                        type="password" 
                        class="form-control form-control-lg" 
                        placeholder="Password" 
                        name="password" 
                        required>
                </div>
                <button type="submit" class="btn btn-outline-light w-100">Login</button>
            </form>
        </div>
    </div>
    
    <div class="bg-animation">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
