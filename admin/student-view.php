<?php
session_start();
if (
    isset($_SESSION["admin_id"]) &&
    isset($_SESSION["role"])
) {

    if ($_SESSION["role"] == "Admin") {
        include "../DB-connection.php";
        include "data/student.php";
        include "data/subject.php";
        include "data/grade.php";
        include "data/section.php";





        if (isset($_GET['student_id'])) {



            $student_id = $_GET['student_id'];
            $student = getStudentById($student_id, $conn);

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
                if ($student != 0) {

                ?>

                    <div class="container mt-5">

                        <div class="card" style="width: 22rem;">
                            <img src="../img/student-<?= $student['gender']?>.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">@<?= $student['username'] ?></h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">First Name: <?= $student['fname'] ?></li>
                                <li class="list-group-item">Last Name: <?= $student['lname'] ?></li>
                                <li class="list-group-item">Username: <?= $student['username'] ?></li>
                                <li class="list-group-item">Address: <?= $student['address'] ?></li>
                                <li class="list-group-item">D.O.B : <?= $student['date_of_birth'] ?></li>
                         
                                <li class="list-group-item">Email: <?= $student['email_address'] ?></li>
                                <li class="list-group-item">Gender: <?= $student['gender'] ?></li>
                                <li class="list-group-item">Date joined: <?= $student['date_of_joined'] ?></li>

                                
                                <li class="list-group-item">Grades:
                                    <?php
                                            $grade = $student['grade'];
                                            $g = getGradeById($grade, $conn);
                                            echo $g['grade_code'].'-'.$g['grade'];   
                                     ?>
                                </li>

                                <li class="list-group-item">Sections:
                                    <?php
                                        $section = $student['section'];
                                        $s = getSectionById($section, $conn);
                                             echo $s['section']; 
                                          
                                    ?>
                                </li>
                                <br><br><hr>
                                <li class="list-group-item">Parent first name: <?= $student['parent_fname'] ?></li>
                                <li class="list-group-item">Parent last name: <?= $student['parent_lname'] ?></li>
                                <li class="list-group-item">Parent Phone NO: <?= $student['parent_phone_number'] ?></li>



                            </ul>
                            <div class="card-body">
                                <a href="student.php" class="card-link">Go Back</a>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                    header("Location: student.php");
                    exit;
                }

                ?>


                <script>
                    $(document).ready(function() {
                        $("#navLinks li:nth-child(3) a").addClass("active");
                    });
                </script>
                <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>"></script>
            </body>

            </html>

<?php
        } else {
            header("Location: student.php");
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