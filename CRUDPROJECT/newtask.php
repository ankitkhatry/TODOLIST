<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "todolist");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$alertMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = trim($_POST['task']);
    $date = $_POST['date'];

    if ($task && $date) {
        $sql = "INSERT INTO tasks (task, date) VALUES ('$task', '$date')";
        if ($conn->query($sql)) {
            $alertMessage = "success";
        } else {
            $alertMessage = "error";
        }
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Task</title>
<link rel="stylesheet" href="style/dash.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
   <header class="header">
     <a class="logo">TO DO LIST</a>
     <div id="menu-btn" class="fas fa-bars"></div>
     <nav class="navbar">
         <ul>
             <li><a href="dashboard.php">ALL TASKS</a></li>
             <li><a href="newtask.php">NEW TASK</a></li>
             <li><a href="pendingtasks.php">PENDING TASKS</a></li>
             <li><a href="completedtasks.php">COMPLETED TASKS</a></li>
             <li><a href="dashboard.php?logout=true">LOGOUT</a></li>
         </ul>
     </nav>
   </header>

<div class="bg-animation">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>

<div class="task-form">
    <h2>Add New Task</h2>
    <form action="" method="POST">
        <label for="task">Task:</label>
        <input type="text" id="task" name="task" required>
        
        <label for="date">Select Date:</label>
        <input type="date" id="date" name="date" required>
        
        <button type="submit">Add Task</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>

let navbar = document.querySelector('.header .navbar');

if (navbar) {
    document.querySelector('#menu-btn').onclick = () => {
        navbar.classList.toggle('active');
    }

    window.onscroll = () => {
        navbar.classList.remove('active');
    }
} else {
    console.error("Navbar element not found.");
}
</script>

</body>
</html>
