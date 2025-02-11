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

            <form class="mt-4" id="loginForm">
                <div class="mb-3">
                    <input 
                        type="text" 
                        class="form-control form-control-lg" 
                        placeholder="Username" 
                        id="username" 
                        required>
                </div>
                <div class="mb-3">
                    <input 
                        type="password" 
                        class="form-control form-control-lg" 
                        placeholder="Password" 
                        id="password" 
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

    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault();

            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;
            if (username === "admin" && password === "admin@123") {
                alert("Login Successful!");
                window.location.href = "dashboard.php";
            } else {
                alert("Invalid Username or Password!");
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
