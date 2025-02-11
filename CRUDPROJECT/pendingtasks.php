<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

include('connection.php');

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
</head>
<body>

<header class="header">
    <a class="logo">TO DO LIST</a>
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
        <ul class="task-items">
         <?php while ($row = $result->fetch_assoc()) { ?>
            <li class="task-item">
                <div class="task-info">
                    <h3><?php echo $row['task']; ?></h3>
                    <p><?php echo $row['date']; ?></p>
                </div>
                <div class="task-actions">
                    <a href="dashboard.php?complete=<?php echo $row['id']; ?>" class="btn-complete">Complete</a>
                    <a href="updatetask.php?id=<?php echo $row['id']; ?>" class="btn-update">Update</a>
                    <a href="dashboard.php?delete=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this task?');">Delete</a>
                </div>
            </li>
        <?php } ?>
        </ul>
</div>

</body>
</html>