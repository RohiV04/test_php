<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
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
        <h1 class="text-center">Sign Up</h1>

        <form action="signup.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
            </div>
        </form>

        <p class="text-center">Already a user? <a href="./login.php">Log in</a></p>
    </div>

    <?php
    session_start(); // Start the session
    require_once 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (username, email, password_hash) VALUES ('$username', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            // Retrieve the user ID after insertion
            $user_id = $conn->insert_id;

            // Set session variables
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;

            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    ?>

    <!-- Add Bootstrap JS if needed -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
</body>

</html>
