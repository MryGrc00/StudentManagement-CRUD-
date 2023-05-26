<?php
// db_connection.php

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

// Retrieve student records from the database
$sql = "SELECT student_ID, fname, lname,  email, address, course, level FROM students";
//$sql = "SELECT * FROM students";
$result = $conn->query($sql);

$students = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

// Retrieve user records from the database
$sql = "SELECT fname, lname, username, password FROM users";
//$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$conn->close();
