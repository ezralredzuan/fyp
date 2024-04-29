<!DOCTYPE html>
<html>
<head>
    <title>View List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="adminstyle.css">
</head>
<body>
    <input type="checkbox" id="checkbox">
    <header class="header">
        <h2 class="u-name">TAEKWONDO<b>UPTM</b>
            <label for="checkbox">
                <i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
            </label>
        </h2>
        <i class="fa fa-user" aria-hidden="true"></i>
    </header>
    <div class="body">
        <nav class="side-bar">
            <ul>
                <li>
                    <a href="adminmenu.php">
                        <i class="fa fa-desktop" aria-hidden="true"></i>
                        <span>DashBoard</span>
                    </a>
                </li>
                <li>
                    <a href="viewUsers.php">
                        <i class="fa fa-desktop" aria-hidden="true"></i>
                        <span>View list</span>
                    </a>
                </li>
                <li>
                    <a href="hompage.html">
                        <i class="fa fa-power-off" aria-hidden="true"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <section class="section-1">
            <div class="container-xl">
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2><b> New Student Details</b></h2>
                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addStudentModal"><i class="fa fa-plus-circle"></i> <span>Add New Student</span></a><br>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>No Phone</th>
                                    <th>Experience</th>
                                    <th>Achievement</th>
                                    <th>Belt</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include_once "./connection.php";
                                $sql = "SELECT * FROM register";
                                $result = $conn->query($sql);
                                
                                function generateUniqueID($conn) {
                                    $id = 'O' . rand(1, 99); // Generating the random ID
                                    $sql = "SELECT stud_id FROM register WHERE stud_id = '$id'";
                                    $result = $conn->query($sql);
                                
                                    // Check if ID already exists in the database, if yes, regenerate the ID
                                    if ($result->num_rows > 0) {
                                        return generateUniqueID($conn); // Recursively call the function until a unique ID is generated
                                    } else {
                                        return $id; // Return the unique ID
                                    }
                                }
                                
                                // Call the function to generate a unique ID
                                $uniqueID = generateUniqueID($conn);


                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <!-- Displaying Student Details -->
                                        <tr>
                                            <td><?= $row["stud_id"] ?></td>
                                            <td><?= $row["full_name"] ?></td>
                                            <td><?= $row["email"] ?></td>
                                            <td><?= $row["phone_no"] ?></td>
                                            <td><?= $row["experience"] ?></td>
                                            <td><?= $row["achievement"] ?></td>
                                            <td><?= $row["belt"] ?></td>
                                            <td>
                                                <!-- Edit Action -->
                                                <a href="#" onclick="populateEditModal('<?= $row['stud_id'] ?>', '<?= $row['full_name'] ?>', '<?= $row['email'] ?>', '<?= $row['phone_no'] ?>', '<?= $row['experience'] ?>', '<?= $row['achievement'] ?>', '<?= $row['belt'] ?>')">
                                                    <i class="fa fa-pencil" style="color: blue;" data-toggle="tooltip" title="Edit"></i>
                                                </a>
                                                <!-- Delete Action -->
                                                <a href="#" onclick="deleteStudent('<?= $row['stud_id'] ?>')">
                                                    <i class="fa fa-trash" style="color: red;" data-toggle="tooltip" title="Delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div id="editStudentModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editStudentForm" action="edit_student.php" method="post">
                <div class="modal-header">                      
                    <h4 class="modal-title">Edit Student</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="stud_id">                  
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" name="full_name" id="editFullName" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" id="editEmail" required>
                    </div>
                    <div class="form-group">
                        <label>No Phone</label>
                        <input type="text" class="form-control" name="phone_no" id="editNoPhone" required>
                    </div>  
                    <div class="form-group">
                        <label>Experience</label>
                        <select class="form-control" name="experience" id="editExperience" required>
                            <option value="">Select Experience</option>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                    </div> 
                    <div class="form-group">
                        <label>Highest Achievement</label> 
                        <select class="form-control" name="achievement" id="editAchievement" required>
                            <option value="">Select Achievement</option>
                            <option value="Local">Local</option>
                            <option value="Regional">Regional</option>
                            <option value="National">National</option>
                            <option value="Inter-National">Inter-National</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Belt Colour</label> 
                        <select class="form-control" name="belt" id="editBelt" required>
                            <option value="">Select Belt Colour</option>
                            <option value="White Belt">White Belt</option>
                            <option value="Yellow Belt">Yellow Belt</option>
                            <option value="Green Belt">Green Belt</option>
                            <option value="Blue Belt">Blue Belt</option>
                            <option value="Red Belt">Red Belt</option>
                            <option value="Black Belt">Black Belt</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>           
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="editStudentId" name="stud_id">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-info" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
<div id="addStudentModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addStudentForm" action="add_student.php" method="post">
                <div class="modal-header">                      
                    <h4 class="modal-title">Add New Student</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                
                <div class="modal-body">   
                    <!-- Displaying the generated ID -->
                    <div class="form-group">
                        <label>ID</label>
                        <input type="text" class="form-control" name="studID" value="<?php echo $uniqueID; ?>" readonly>
                    </div>                 
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" name="full_name" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>No Phone</label>
                        <input type="text" class="form-control" name="phone_no" required>
                    </div>  
                    <div class="form-group">
                        <label>Experience</label>
                        <select class="form-control" name="experience" required>
                            <option value="">Select Experience</option>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                    </div> 
                    <div class="form-group">
                        <label>Highest Achievement</label> 
                        <select class="form-control" name="achievement" required>
                            <option value="">Select Achievement</option>
                            <option value="Local">Local</option>
                            <option value="Regional">Regional</option>
                            <option value="National">National</option>
                            <option value="Inter-National">Inter-National</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Belt Colour</label> 
                        <select class="form-control" name="belt" required>
                            <option value="">Select Belt Colour</option>
                            <option value="White Belt">White Belt</option>
                            <option value="Yellow Belt">Yellow Belt</option>
                            <option value="Green Belt">Green Belt</option>
                            <option value="Blue Belt">Blue Belt</option>
                            <option value="Red Belt">Red Belt</option>
                            <option value="Black Belt">Black Belt</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>        
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success" value="Add">
                </div>
            </form>
        </div>
    </div>
</div>


</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script>

    

    // Function to handle adding a new student (open modal)
    function addNewStudent() {
        // Generate a unique ID
        var newID = generateUniqueID();
        // Set the generated ID in the modal input field
        $('#addStudentModal input[name="studID"]').val(newID);
        // Show the modal
        $('#addStudentModal').modal('show');
    }
    // Function to handle deleting an student
    function deleteStudent(studID) {
        if (confirm("Are you sure you want to delete this Student?")) {
            // Redirect to a PHP script to handle deleting the specific student
            window.location.href = "delete_student.php?id=" + studID; // Pass studID as a parameter
        }
    }
    function populateEditModal(id, name, email, phone_no, experience, achievement, belt) {
        // Set values in the edit modal
        $('#editStudentId').val(id);
        $('#editFullName').val(name);
        $('#editEmail').val(email);
        $('#editNoPhone').val(phone_no);
        $('#editExperience').val(experience);
        $('#editAchievement').val(achievement);
        $('#editBelt').val(belt);
        // Show the modal
        $('#editStudentModal').modal('show');
    }
    function generateUniqueID() {
        var id;
        do {
            // Generate a random number within the range of 1 to 99
            var randomNumber = Math.floor(Math.random() * 99) + 1;
            // Format the number with leading zeros if necessary
            id = "O" + randomNumber.toString().padStart(2, '0');
            // Check if the generated ID already exists in the table
            var existingID = false;
            $('table.table tbody tr').each(function() {
                var existingIDText = $(this).find('td:nth-child(2)').text();
                if (existingIDText === id) {
                    existingID = true;
                    return false; // Break out of the loop
                }
            });
        } while (existingID); // Repeat generation if the ID already exists
        return id;
    }
</script>
    </div>
</body>
</html>
