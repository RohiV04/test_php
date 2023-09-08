<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Log In</title>
</head>

<body>
    <h1>Log In</h1>

    <form action="login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Log In</button>
    </form>

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
</body>

</html>