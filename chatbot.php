<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chatbot</title>
</head>

<body>
    <h1>Chatbot</h1>

    <form action="chatbot.php" method="post">
        <label for="question">Ask a question:</label>
        <input type="text" name="question" id="question" required>
        <button type="submit">Ask</button>
    </form>

    <?php
    session_start(); // Start a new session 
    // Check if the user is authenticated (logged in)
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php"); // Redirect to the login page if not authenticated
        exit();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['question'])) {
        $question = $_POST['question'];

        // Set up cURL to make a request to the Chatbot API
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://chatgpt-gpt4-ai-chatbot.p.rapidapi.com/ask",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'query' => $question
            ]),
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: chatgpt-gpt4-ai-chatbot.p.rapidapi.com",
                "X-RapidAPI-Key: e4d4507831msh8daf27e079eeb5cp15df2ejsn008380f9d487",
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<p>Response from Chatbot:</p>";
            echo "<p>" . $response . "</p>";
        }
    }
    ?>
</body>

</html>