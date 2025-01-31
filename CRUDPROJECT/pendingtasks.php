<?php
session_start();

if (isset($_GET['logout'])) {
    session_unset();
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

if (isset($_GET['complete'])) {
    $task_id = $_GET['complete'];
    $conn->query("UPDATE tasks SET status = 1 WHERE id = $task_id");
    header("Location: pendingtasks.php");
    exit();
}

$sql = "SELECT * FROM tasks WHERE status = 0 ORDER BY date DESC";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pending Tasks</title>
<link rel="stylesheet" href="style/dash.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

<div class="task-list">
    <h2>Pending Tasks</h2>
    <?php if ($result->num_rows > 0): ?>
        <ul class="task-items">
            <?php while($row = $result->fetch_assoc()): ?>
                <li class="task-item">
                    <div class="task-info">
                        <h3><?php echo $row['task']; ?></h3>
                        <p><?php echo $row['date']; ?></p>
                    </div>
                    <div class="task-actions">
                        <a href="pendingtasks.php?complete=<?php echo $row['id']; ?>" class="btn-complete">Completed</a>
                        <a href="updatetask.php?id=<?php echo $row['id']; ?>" class="btn-update">Update</a>
                        <a href="dashboard.php?delete=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this task?');">Delete</a>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No pending tasks found!</p>
    <?php endif; ?>
</div>

<div class="bg-animation">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>

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
