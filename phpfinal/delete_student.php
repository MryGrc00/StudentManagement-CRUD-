<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the student ID from the form
    $student_ID = $_POST['student_ID'];

    // Perform the delete operation here
    $conn = new mysqli('localhost', 'root', '', 'studentrecord');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the delete query
    $stmt = $conn->prepare("DELETE FROM students WHERE student_ID=?");
    $stmt->bind_param("i", $student_ID);

    // Execute the delete query
    $delete_success = $stmt->execute();

    // Close the statement and database connection
    $stmt->close();
    $conn->close();

    // Check if the delete was successful
    if ($delete_success) {
        // Redirect back to the main page with a success message
        header("Location: student_records.php?deletesuccess=1");
        exit();
    } else {
        // Redirect back to the main page with an error message
        header("Location: student_records.php?deleteerror=1");
        exit();
    }
} else {
    // If the form is not submitted, redirect back to the main page
    header("Location: student_records.php");
    exit();
}
