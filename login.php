<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Log In</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add your CSS styles here */
        body {
            background-color: #f0f0f0; /* Set your desired background color */
        }

        .container {
            max-width: 400px;
            margin-top: 100px;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Log In</h1>

        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Log In</button>
            </div>
        </form>

        <p class="text-center">New user? <a href="./signup.php">Signup</a></p>
    </div>

    <?php
    session_start(); // Start the session
    require_once 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password_hash'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                header("Location: index.php");
                echo "Logged in successfully.";
                exit();
                // You can add session handling here to keep the user logged in.
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "User not found.";
        }
    }

    $conn->close();
    ?>

    <!-- Add Bootstrap JS if needed -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
</body>

</html>
