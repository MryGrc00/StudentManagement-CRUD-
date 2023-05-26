<?php
// Database credentials
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'studentrecord';

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username and password are correct
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login successful
        // Redirect to student records page
        header("Location: student_records.php");
        exit();
    } else {
        // Login failed
        echo '<script>alert("Invalid username or password.");</script>';
        header("Refresh: 0; url=index.php");
        exit();
    }
}

$conn->close();
