<?php
session_start();
if (
    isset($_SESSION["admin_id"]) &&
    isset($_SESSION["role"]) &&
    isset($_GET["teacher_id"])
) {
    if ($_SESSION["role"] == "Admin") {
        include "../DB-connection.php";
        include "data/teacher.php";
        include "data/subject.php";
        include "data/grade.php";
        // $grades = getGradeById($conn);
        $subjects = getAllSubjects($conn);
        $grades = getAllGrades($conn);
        $teacher_id = $_GET["teacher_id"];
        $teacher = getTeacherById($_GET["teacher_id"], $conn);
        
        if ($teacher == 0) {
            header("Location: teacher.php");
            exit;
        } 



?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin - Edit Teachers</title>
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
                <a href="teacher.php" class="btn btn-dark"> Go Back</a>

                <form class="shadow p-3 mt-5 form-w" method="post" action="req/teacher-edit.php">
                    <h3>Edit Teacher</h3>
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
                        <input type="text" class="form-control" name="fname" value="<?= $teacher['fname'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lastname</label>
                        <input type="text" class="form-control" name="lname" value="<?= $teacher['lname'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?= $teacher['username'] ?>">
                    </div>
                        <input type="text" value="<?= $teacher['teacher_id'] ?>" name="teacher_id" hidden >


                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <div class="row row-cols-5">
                            <?php 
                            $subject_ids = str_split(trim($teacher['subjects']));
                            foreach ($subjects as $subject) {
                                $checked = 0;
                                foreach ($subject_ids as $subject_id) {
                                    if ($subject['subject_id'] == $subject_id) {
                                        $checked = 1;
                                    } 
                                }
                                 ?>
                                <div class="col">
                                    <input type="checkbox" name="subjects[]"
                                    <?php if ($checked) echo "checked";?>
                                     value="<?= $subject['subject_id'] ?>">
                                    <?= $subject['subject'] ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Grade</label>
                        <div class="row row-cols-5">
                        <?php 
                            $grade_ids = str_split(trim($teacher['grades']));
                            foreach ($grades as $grade) {
                                $checked = 0;
                                foreach ($grade_ids as $grade_id) {
                                    if ($grade['grade_id'] == $grade_id) {
                                        $checked = 1;
                                    } 
                                }
                                 ?>
                                <div class="col">
                                    <input type="checkbox" name="grades[]"
                                    <?php if ($checked) echo "checked";?>
                                     value="<?= $grade['grade_id'] ?>">
                                    <?= $grade['grade_code'] ?> - <?= $grade['grade'] ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">Update</button>

                </form>
                <form method="post" action="req/teacher-change.php" class="shadow p-3 my-5 form-w" id="change_password">
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

                    <input type="text" value="<?= $teacher['teacher_id'] ?>" name="teacher_id" hidden >


                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                            <input type="text" class="form-control" name="c_new_pass" id="passInput2">
                    </div>
                    <button type="submit" class="btn btn-primary">Change</button>

                </form>
            </div>

            <script>
                $(document).ready(function() {
                    $("#navLinks li:nth-child(2) a").addClass("active");
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
        header("Location: teacher.php");
        exit;
    }
} else {
    echo "Please log in first to see this page.";
    header("Location: teacher.php");
    exit;
}
?>