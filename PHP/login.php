<?php
// Start session to store login information
session_start();

$loginParams = parse_ini_file("/home/jacob/website1/config/login.ini");

// Define a hardcoded username and hashed password (or fetch from a database)
$valid_username = $loginParams['username'];
$hashed_password = password_hash($loginParams['password'], PASSWORD_DEFAULT);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the credentials
    if ($username === $valid_username && password_verify($password, $hashed_password)) {
        // Credentials are correct, start a session and redirect to restricted page
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        header('Location: /Control'); // Redirect to restricted page
        exit();
    } else {
        // Invalid credentials, show an error
        echo 'Invalid username or password.';
    }
}
?>