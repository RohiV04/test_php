<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Todo List</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS styles */
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        /* Add your custom styles here if needed */
    </style>
</head>

<body>
    <?php
    session_start(); // Start a new session or resume the existing session

    // Check if the user is authenticated (logged in)
    if (!isset($_SESSION['username'])) {
        header("Location: login.php"); // Redirect to the login page if not authenticated
        exit();
    }
    ?>

    <div class="container mt-4">
        <h1 class="text-center">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <a href="logout.php" class="float-right">Log Out</a>

        <h1 class="text-center mt-4">Todo List</h1>

        <!-- Task Search -->
        <form action="" method="get" class="mt-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search Task">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <!-- Display tasks -->
        <ul class="list-group mt-3">
            <?php
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
                    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                            {$row['task']}
                            <div>
                                <a href='edit.php?id={$row['id']}' class='btn btn-primary btn-sm'>Edit</a>
                                <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                            </div>
                          </li>";
                }
            } else {
                echo "<li class='list-group-item'>No tasks found.</li>";
            }
            ?>
        </ul>

        <!-- Add new task form -->
        <h2 class="mt-4">Add New Task</h2>
        <form action="add.php" method="post">
            <div class="input-group">
                <input type="text" name="task" class="form-control" placeholder="Task" required>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-success">Add Task</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Add Bootstrap JS if needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
