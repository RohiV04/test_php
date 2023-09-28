<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add your CSS styles here */
        body {
            background-color: #f0f0f0; /* Set your desired background color */
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 5px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button[type="submit"] {
            background-color: #5791ff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <?php
    require_once 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM todos WHERE id = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        $id = $_POST['id'];
        $task = $_POST['task'];
        $sql = "UPDATE todos SET task = '$task' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <h1>Edit Task</h1>
    <form action="edit.php" method="post">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <div class="form-group">
            <label for="task">Task:</label>
            <input type="text" class="form-control" id="task" name="task" value="<?= $row['task'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>

    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
