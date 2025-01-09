
<?php
// MySQL database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "dip";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Perform some basic validation
if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password)) {
    echo "All fields are required.";
    exit;
}

if ($password !== $confirm_password) {
    echo "Password and Confirm Password do not match.";
    exit;
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $firstname, $lastname, $email, $hashed_password);

// Execute the statement
if ($stmt->execute() === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="signup.css">
</head>
<body>
    <form class="form" action="" method="post">
       
        <p class="title">Register </p>
        <p class="message">Signup now and get full access to our app. </p>
            <div class="flex">
            <label>
                <input class="input" type="text" name="firstname" placeholder="" required="">
                <span>Firstname</span>
            </label>
    
            <label>
                <input class="input" type="text" name="lastname" placeholder="" required="">
                <span>Lastname</span>
            </label>
        </div>  
                
        <label>
            <input class="input" type="email" name="email" placeholder="" required="">
            <span>Email</span>
        </label> 
            
        <label>
            <input class="input" type="password" name="password" placeholder="" required="">
            <span>Password</span>
        </label>
        <label>
            <input class="input" type="password" name="confirm_password" placeholder="" required="">
            <span>Confirm password</span>
        </label>
        <button type="submit" class="submit">Submit</button>
        <p class="signin">Already have an account? <a href="login.html">Signin</a> </p>
    </form>
</body>
</html>