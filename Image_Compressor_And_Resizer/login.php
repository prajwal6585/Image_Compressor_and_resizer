

@include 'config.php';
<?php


    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape user inputs for security
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // SQL query to check if username and password match
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Redirect user to dashboard or another page
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }

    // Close connection
    $conn->close();

?>
