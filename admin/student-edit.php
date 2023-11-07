<?php
session_start();
if (
    isset($_SESSION["admin_id"]) &&
    isset($_SESSION["role"]) &&
    isset($_GET["student_id"])
) {
    if ($_SESSION["role"] == "Admin") {
        include "../DB-connection.php";
        include "data/student.php";
        include "data/section.php";
        include "data/subject.php";
        include "data/grade.php";
        // $grades = getGradeById($conn);
        $subjects = getAllSubjects($conn);
        $grades = getAllGrades($conn);
        $sections = getAllSections($conn);
        $student_id = $_GET["student_id"];
        $student = getStudentById($_GET["student_id"], $conn);

        if ($student == 0) {
            header("Location: student.php");
            exit;
        }



?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin - Edit Students</title>
            <link rel="stylesheet" href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">">
            <link rel="stylesheet" href="../css/styles.css">
            <link rel="icon" href="../Minion.png">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        </head>

        <body class="">
            <?php
            include "inc/navbar.php";

            ?>

            <div class="container mt-5">
                <a href="student.php" class="btn btn-dark"> Go Back</a>

                <form class="shadow p-3 mt-5 form-w" method="post" action="req/student-edit.php">
                    <h3>Edit Student Info</h3>
                    <hr>
                    <?php if (isset($_GET['error'])) { ?>
                        <div class='alert alert-danger' role='alert'>
                            <?= $_GET['error'] ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($_GET['success'])) { ?>
                        <div class='alert alert-success' role='alert'>
                            <?= $_GET['success'] ?>
                        </div>
                    <?php } ?>

                    <div class="mb-3">
                        <label class="form-label">Firstname</label>
                        <input type="text" class="form-control" name="fname" value="<?= $student['fname'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lastname</label>
                        <input type="text" class="form-control" name="lname" value="<?= $student['lname'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="<?= $student['address'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="text" class="form-control" name="email_address" value="<?= $student['email_address'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">D.O.B </label>
                        <input type="date" class="form-control" name="date_of_birth" value="<?= $student['date_of_birth'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender</label> <br>
                        <input type="radio" name="gender" value="male" <?php if($student['gender'] == 'Male') echo 'checked';?>> Male
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gender" value="female" <?php if($student['gender'] == 'Female') echo 'checked';?>> Female
                    </div>
                        
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?= $student['username'] ?>">
                    </div>
                    <input type="text" value="<?= $student['student_id'] ?>" name="student_id" hidden>


                    <div class="mb-3">
                        <label class="form-label">Grade</label>
                        <div class="row row-cols-5">
                            <?php
                            $grade_ids = str_split(trim($student['grade']));
                            foreach ($grades as $grade) {
                                $checked = 0;
                                foreach ($grade_ids as $grade_id) {
                                    if ($grade['grade_id'] == $grade_id) {
                                        $checked = 1;
                                    }
                                }
                            ?>
                                <div class="col">
                                    <input type="radio" name="grade" <?php if ($checked) echo "checked"; ?> value="<?= $grade['grade_id'] ?>">
                                    <?= $grade['grade_code'] ?> - <?= $grade['grade'] ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Section</label>
                        <div class="row row-cols-5">
                            <?php
                            $section_ids = str_split(trim($student['section']));
                            foreach ($sections as $section) {
                                $checked = 0;
                                foreach ($section_ids as $section_id) {
                                    if ($section['section_id'] == $section_id) {
                                        $checked = 1;
                                    }
                                }
                            ?>
                                <div class="col">
                                    <input type="radio" name="section" <?php if ($checked) echo "checked"; ?> value="<?= $section['section_id'] ?>">
                                    <?= $section['section'] ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                     <br><hr>

                    <div class="mb-3">
                        <label class="form-label">Parent Firstname</label>
                        <input type="text" class="form-control" name="parent_fname" value="<?= $student['parent_fname'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Parent Lastname</label>
                        <input type="text" class="form-control" name="parent_lname" value="<?= $student['parent_lname'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Parent Phone NO.</label>
                        <input type="text" class="form-control" name="parent_phone_number" value="<?= $student['parent_phone_number'] ?>">
                    </div>
                   


                    <button type="submit" class="btn btn-primary">Update</button>

                </form>
                <form method="post" action="req/student-change.php" class="shadow p-3 my-5 form-w" id="change_password">
                    <h3>Change Password</h3>
                    <hr>
                    <?php if (isset($_GET['perror'])) { ?>
                        <div class='alert alert-danger' role='alert'>
                            <?= $_GET['perror'] ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($_GET['psuccess'])) { ?>
                        <div class='alert alert-success' role='alert'>
                            <?= $_GET['psuccess'] ?>
                        </div>
                    <?php } ?>
                    <div class="mb-3">
                        <div class="mb-3">
                            <label class="form-label">Admin password</label>
                            <input type="password" class="form-control" name="admin_pass">
                        </div>
                        <label class="form-label"> New Password</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="new_pass" id="passInput">
                            <button class="btn btn-secondary" id="gBtn">Random</button>

                        </div>
                    </div>

                    <input type="text" value="<?= $student['student_id'] ?>" name="student_id" hidden>


                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="text" class="form-control" name="c_new_pass" id="passInput2">
                    </div>
                    <button type="submit" class="btn btn-primary">Change</button>

                </form>
            </div>

            <script>
                $(document).ready(function() {
                    $("#navLinks li:nth-child(3) a").addClass("active");
                });

                function makePass(length) {
                    var result = '';
                    var character = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                    var characterLength = character.length;
                    for (var i = 0; i < length; i++) {
                        result += character.charAt(Math.floor(Math.random() * characterLength));
                    }
                    var passInput = document.getElementById("passInput");
                    var passInput2 = document.getElementById("passInput2");

                    passInput.value = result;
                    passInput2.value = result;


                }

                var gBtn = document.getElementById("gBtn");
                gBtn.addEventListener("click", function(e) {
                    e.preventDefault();
                    makePass(4);
                });
            </script>
            <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>"></script>
        </body>

        </html>

<?php
    } else {
        echo "Please log in first to see this page.";
        header("Location: student.php");
        exit;
    }
} else {
    echo "Please log in first to see this page.";
    header("Location: student.php");
    exit;
}
?>