<?php
session_start();
if (
    isset($_SESSION["admin_id"]) &&
    isset($_SESSION["role"])
) {
    if ($_SESSION["role"] == "Admin") {
        include "../DB-connection.php";
        include "data/subject.php";
        include "data/grade.php";
        include "data/section.php";
        // $grades = getGradeById($conn);
        $subjects = getAllSubjects($conn);
        $grades = getAllGrades($conn);
        $sections = getAllSections($conn);


        $fname = '';
        $lname = '';
        $uname = '';
        $address = '';
        $en = '';
        $pn = '';
        $qual = '';
        $email = '';





        if (isset($_GET['fname'])) $fname = $_GET['fname'];
        if (isset($_GET['lname'])) $lname = $_GET['lname'];
        if (isset($_GET['uname'])) $uname = $_GET['uname'];
        if (isset($_GET['address'])) $address = $_GET['address'];
        if (isset($_GET['en'])) $en = $_GET['en'];
        if (isset($_GET['pn'])) $pn = $_GET['pn'];
        if (isset($_GET['qual'])) $qual = $_GET['qual'];
        if (isset($_GET['email'])) $email = $_GET['email'];



?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin - Teachers</title>
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

                <form class="shadow p-3 mt-5 form-w" method="post" action="req/teacher-add.php">
                    <h3>Add New Teacher</h3>
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
                        <input type="text" class="form-control" name="fname" value="<?= $fname ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lastname</label>
                        <input type="text" class="form-control" name="lname" value="<?= $lname ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?= $uname ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="pass" id="passInput">
                            <button class="btn btn-secondary" id="gBtn">Random</button>

                        </div>
                    </div>
                   
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="<?=$address?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Employee Number</label>
                        <input type="text" class="form-control" name="employee_number" value="<?=$en?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="number" class="form-control" name="phone_number" value="<?=$pn?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Qualification</label>
                        <input type="text" class="form-control" name="qualification" value="<?=$qual?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="text" class="form-control" name="email_address" value="<?=$email?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label> <br>
                        <input type="radio" name="gender" value="Male" checked> Male
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gender" value="Female"> Female

                    </div>

                    <div class="mb-3">
                        <label class="form-label">D.O.B</label>
                        <input type="date" class="form-control" name="date_of_birth" value="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <div class="row row-cols-5">
                            <?php foreach ($subjects as $subject) : ?>
                                <div class="col">
                                    <input type="checkbox" name="subjects[]" value="<?= $subject['subject_id'] ?>">
                                    <?= $subject['subject'] ?>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Grade</label>
                        <div class="row row-cols-5">
                            <?php foreach ($grades as $grade) : ?>
                                <div class="col">
                                    <input type="checkbox" name="grades[]" value="<?= $grade['grade_id'] ?>">
                                    <?= $grade['grade_code'] ?> - <?= $grade['grade'] ?>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Section</label>
                        <div class="row row-cols-5">
                            <?php foreach ($sections as $section) : ?>
                                <div class="col">
                                    <input type="checkbox" name="section[]" value="<?= $section['section_id'] ?>">
                                    <?= $section['section'] ?>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>



                    <button type="submit" class="btn btn-primary">Add</button>

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
                    passInput.value = result;

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
        header("Location: ../login.php");
        exit;
    }
} else {
    echo "Please log in first to see this page.";
    header("Location: ../login.php");
    exit;
}
?>