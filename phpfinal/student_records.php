
<?php include 'db_connection.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Records</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body style="background-color:#E1D9D1">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
        <?php foreach ($users as $index => $user) : ?>
         Hi! <?php echo $user['fname']; ?> <?php echo $user['lname']; ?>, Welcome to your Student Record Dashboard!
        <?php endforeach; ?>

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav justify-content-center">
                </ul>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="logout.php">LOGOUT</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Top left corner alert -->
    <?php
    // Check if a success message is present in the URL
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '
    <div style="z-index: 11">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Student record updated successfully!
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".alert").alert();
            setTimeout(function() {
                $(".alert").alert("close");
                window.location.href = "student_records.php";
            }, 3000);
        });
    </script>';
    }
    // Check if a success message is present in the URL after adding a student
    if (isset($_GET['addsuccess']) && $_GET['addsuccess'] == 1) {
        echo '
    <div style="z-index: 11">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Student added successfully!
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".alert").alert();
            setTimeout(function() {
                $(".alert").alert("close");
                window.location.href = "student_records.php";
            }, 3000);
        });
    </script>';
    }
    // Check if a success message is present in the URL after deleting a student
    if (isset($_GET['deletesuccess']) && $_GET['deletesuccess'] == 1) {
        echo '
    <div style="z-index: 11">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Student deleted successfully!
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".alert").alert();
            setTimeout(function() {
                $(".alert").alert("close");
                window.location.href = "student_records.php";
            }, 1000);
        });
    </script>';
    }
    ?>

    <div class="container mt-4 ">
        <h2 class="text-center">Student Records</h2>
        <hr>
        <button type="button" class="btn btn-success mt-2 mb-4" style="float:right;" data-toggle="modal" data-target="#addStudentModal">
            Add Student
        </button>
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>#</th>
                    <th>student_ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Course</th>
                    <th>Level</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $index => $student) : ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $student['student_ID']; ?></td>
                        <td><?php echo $student['fname']; ?></td>
                        <td><?php echo $student['lname']; ?></td>
                        <td><?php echo $student['email']; ?></td>
                        <td><?php echo $student['address']; ?></td>
                        <td><?php echo $student['course']; ?></td>
                        <td><?php echo $student['level']; ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm" title="Edit Student" data-toggle="modal" data-target="#editStudentModal<?php echo $student['student_ID']; ?>">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" title="Delete Student" data-toggle="modal" data-target="#deleteModal<?php echo $student['student_ID']; ?>">
                                <i class="fas fa-trash"></i> <!-- Icon Only -->
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form content -->
                    <form method="post" action="add_student.php">
                        <!-- Form fields -->
                        <div class="form-group">
                            <label for="student_ID">Student ID:</label>
                            <input type="text" class="form-control" id="student_ID" name="student_ID" required>
                        </div>
                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input type="text" class="form-control" id="fname" name="fname" required>
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name:</label>
                            <input type="text" class="form-control" id="lname" name="lname" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                        <label for="course" class="form-label">Course:</label>
                             <select class="form-control" style="height: 38px" id="course" name="course">
                                 <option value=""selected disabled>Select Course</option>
                                  <option value="BSIT">BSIT</option>
                                  <option value="BSCS">BSCS</option>
                                  <option value="BSIS">BSIS</option>
                                  <option value="BSIS">BSA</option>
                                  <option value="BSIS">BSCPE</option>
                             </select>
                        </div>
                        <div class="form-group">
                            <label for="level">Level:</label>
                            <input type="number" class="form-control" id="level" name="level" required>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <?php foreach ($students as $student) : ?>
        <div class="modal fade" id="editStudentModal<?php echo $student['student_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel<?php echo $student['student_ID']; ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title " id="editStudentModalLabel<?php echo $student['student_ID']; ?>">Edit
                            Student
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form content -->
                        <form method="post" action="edit_student.php">
                            <!-- Form fields -->
                            <div class="form-group">
                                <label for="student_ID">Student ID:</label>
                                <input type="text" class="form-control" id="student_ID" name="student_ID" value="<?php echo $student['student_ID']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="fname">First Name:</label>
                                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $student['fname']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name:</label>
                                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $student['lname']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $student['email']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $student['address']; ?>" required>
                            </div>
                            <div class="form-group">
                            <label for="course" class="form-label">Course:</label>
                             <select class="form-control" style="height: 38px" id="course" name="course">
                                 <option value=""selected disabled>Select Course</option>
                                  <option value="BSIT" <?php if ($student['course'] == 'BSIT') echo 'selected'; ?>>BSIT</option>
                                  <option value="BSCS" <?php if ($student['course'] == 'BSCS') echo 'selected'; ?>>BSCS</option>
                                  <option value="BSIS" <?php if ($student['course'] == 'BSIS') echo 'selected'; ?>>BSIS</option>
                                  <option value="BSA" <?php if ($student['course'] == 'BSA') echo 'selected'; ?>>BSA</option>
                                  <option value="BSCPE" <?php if ($student['course'] == 'BSCPE') echo 'selected'; ?>>BCPE</option>
                             </select>
                            </div>
                            <div class="form-group">
                            <label for="level">Level:</label>
                            <input type="number" class="form-control" id="level" name="level" value="<?php echo $student['level']; ?>" required>
                             </div>

                            <!-- Hidden input field for student ID -->
                            <input type="hidden" name="id" value="<?php echo $student['student_ID']; ?>">

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal<?php echo $student['student_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Student Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure that you want to delete <?php echo $student['fname']; ?> <?php echo $student['lname']; ?>?</p>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <form method="POST" action="delete_student.php">
                            <input type="hidden" name="student_ID" value="<?php echo $student['student_ID']; ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- To loop also the data in the delete -->
    <?php endforeach; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>