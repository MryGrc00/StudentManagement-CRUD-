<?php
// Perform the update operation and display appropriate message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the student ID from the form
    $id = $_POST['student_ID'];

    // Perform the update operation here
    $conn = new mysqli('localhost', 'root', '', 'studentrecord');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the update query
    $stmt = $conn->prepare("UPDATE students SET fname=?, lname=?, email=?, address=?, course=?, level=? WHERE student_ID=?");
    $stmt->bind_param("ssssssi", $_POST['fname'],$_POST['lname'], $_POST['email'], $_POST['address'],$_POST['course'],$_POST['level'], $id);

    // Execute the update query
    $update_success = $stmt->execute();

    // Close the statement and database connection
    $stmt->close();
    $conn->close();

    // Redirect back to the main page with a success message
    header("Location: student_records.php?success=1");
    exit();
}
