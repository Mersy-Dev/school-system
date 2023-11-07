<?php
session_start();
if (
    isset($_SESSION["admin_id"]) &&
    isset($_SESSION["role"])
) {

    if ($_SESSION["role"] == "Admin") {
        include "../DB-connection.php";
        include "data/teacher.php";
        include "data/subject.php";
        include "data/grade.php";
        include "data/section.php";





        if (isset($_GET['teacher_id'])) {



            $teacher_id = $_GET['teacher_id'];
            $teacher = getTeacherById($teacher_id, $conn);

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
                if ($teacher != 0) {

                ?>

                    <div class="container mt-5">

                        <div class="card" style="width: 22rem;">
                            <img src="../img/teacher-<?= $teacher['gender']?>.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">@<?= $teacher['username'] ?></h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">First Name: <?= $teacher['fname'] ?></li>
                                <li class="list-group-item">Last Name: <?= $teacher['lname'] ?></li>
                                <li class="list-group-item">Username: <?= $teacher['username'] ?></li>
                                <li class="list-group-item">Employee Number: <?= $teacher['employee_number'] ?></li>
                                <li class="list-group-item">Address: <?= $teacher['address'] ?></li>
                                <li class="list-group-item">D.O.B : <?= $teacher['date_of_birth'] ?></li>
                                <li class="list-group-item">Phone Number: <?= $teacher['phone_number'] ?></li>
                                <li class="list-group-item">Qualification: <?= $teacher['qualification'] ?></li>
                                <li class="list-group-item">Email: <?= $teacher['email_address'] ?></li>
                                <li class="list-group-item">Gender: <?= $teacher['gender'] ?></li>
                                <li class="list-group-item">Date joined: <?= $teacher['date_of_joined'] ?></li>

                                <li class="list-group-item">Subject:
                                    <?php
                                        $s = '';
                                        $subjects = str_split(trim($teacher['subjects']));

                                        foreach ($subjects as $subject) {
                                            $s_temp = getSubjectById($subject, $conn);
                                            if ($s_temp != 0)
                                                $s .= $s_temp['subject_code'] . ', ';
                                        }
                                        echo $s;
                                    ?>
                                </li>
                                <li class="list-group-item">Grades:
                                    <?php
                                        $g = '';
                                        $grades = str_split(trim($teacher['grades']));

                                        foreach ($grades as $grade) {
                                            $g_temp = getGradeById($grade, $conn);
                                            if ($g_temp != 0)
                                                $g .= $g_temp['grade_code'] . '- ' .
                                                    $g_temp['grade'] . ', ';
                                        }
                                        echo $g;
                                    ?>
                                </li>

                                <li class="list-group-item">Sections:
                                    <?php
                                        $s = '';
                                        $sections = str_split(trim($teacher['section']));

                                        foreach ($sections as $section) {
                                            $s_temp = getSectionById($section, $conn);
                                            if ($s_temp != 0)
                                                $s .= $s_temp['section'] . ', ';
                                        }
                                        echo $s;
                                    ?>
                                </li>



                            </ul>
                            <div class="card-body">
                                <a href="teacher.php" class="card-link">Go Back</a>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                    header("Location: teacher.php");
                    exit;
                }

                ?>


                <script>
                    $(document).ready(function() {
                        $("#navLinks li:nth-child(2) a").addClass("active");
                    });
                </script>
                <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>"></script>
            </body>

            </html>

<?php
        } else {
            header("Location: teacher.php");
            exit;
        }
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