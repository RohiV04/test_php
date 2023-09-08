<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Todo List</title>
</head>

<body>
    <h1>Welcome, <?php echo $_SESSION['user_username']; ?>!</h1>
    <!-- Display user's profile information here -->
    <a href="logout.php">Log Out</a>
    <h1>Todo List</h1>

    <!-- Task Search -->
    <form action="" method="get">
        <input type="text" name="search" placeholder="Search Task">
        <button type="submit">Search</button>
    </form>

    <!-- Display tasks -->
    <ul>
        <?php
        session_start(); // Start a new session or resume the existing session

        // Check if the user is authenticated (logged in)
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php"); // Redirect to the login page if not authenticated
            exit();
        }
        require_once 'config.php';

        // Check if a search query is submitted
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        if (!empty($search)) {
            // If a search query is provided, filter tasks
            $sql = "SELECT * FROM todos WHERE task LIKE '%$search%' ORDER BY created_at DESC";
        } else {
            // Otherwise, display all tasks
            $sql = "SELECT * FROM todos ORDER BY created_at DESC";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li>{$row['task']} (<a href='edit.php?id={$row['id']}'>Edit</a> | <a href='delete.php?id={$row['id']}'>Delete</a>)</li>";
            }
        } else {
            echo "No tasks found.";
        }
        ?>
    </ul>

    <!-- Add new task form -->
    <h2>Add New Task</h2>
    <form action="add.php" method="post">
        <input type="text" name="task" placeholder="Task" required>
        <button type="submit">Add Task</button>
    </form>
</body>

</html>