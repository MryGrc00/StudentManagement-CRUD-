<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $student_ID = ucwords($_POST['student_ID']);
    $fname = ucwords($_POST['fname']);
    $lname = ucwords($_POST['lname']);
    $email =ucwords($_POST['email']);
    $address = ucwords($_POST['address']);
    $course = ucwords($_POST['course']);
    $level = ucwords($_POST['level']);



    
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
    
    // Prepare and execute the SQL query to insert the new student record
    $sql = "INSERT INTO students (student_ID, fname, lname, email, address, course, level) VALUES ('$student_ID', '$fname', '$lname' , '$email', '$address', '$course', '$level')";

    if ($conn->query($sql) === TRUE) {
        // If the record is successfully inserted, redirect to the student records page
        header("Location: student_records.php?addsuccess=1");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    
}
