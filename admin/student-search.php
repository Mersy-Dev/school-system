<?php
session_start();
if (
    isset($_SESSION["admin_id"]) &&
    isset($_SESSION["role"])
) {

    if ($_SESSION["role"] == "Admin") {
        if(isset($_GET['searchKey'])){

            $search_key = $_GET['searchKey'];
         
        include "../DB-connection.php";
        include "data/student.php";
        include "data/grade.php";
        $students = searchStudents($search_key, $conn);
        // $grades = getGradeById($conn);
        // $subjects = getAllSubjects($conn);

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin - Search Students</title>
            <link rel="stylesheet" href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">">
            <link rel="stylesheet" href="../css/styles.css">
            <link rel="icon" href="../Minion.png">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        </head>

        <body class="">
            <?php
            include "inc/navbar.php";
            if ($students != 0) {

            ?>

                <div class="container mt-5">
                    <a href="student-add.php" class="btn btn-dark">Add New Student</a>
                    <form action="student-search.php" class="mt-3 n-table" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="searchKey" placeholder="Search...">
                            <button class="btn btn-primary">
                                <i class="fa fa-search" aria-hidden="true"></i>  
                            </button>
                        </div>
                    </form>


                    <?php if (isset($_GET['error'])) { ?>
                        <div class='alert alert-danger mt-3 n-table' role='alert'>
                            <?= $_GET['error'] ?>
                        </div>

                    <?php } ?>

                    <?php if (isset($_GET['success'])) { ?>
                        <div class='alert alert-info mt-3 n-table' role='alert'>
                            <?= $_GET['success'] ?>
                        </div>

                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-bordered mt-3 n-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Grade</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; foreach ($students as $student) {
                                    $i++; ?>

                                    <tr>
                                        <th scope="row"><?=$i?></th>
                                        <td><?= $student['student_id'] ?></td>
                                        <td><a href="student-view.php?student_id=<?= $student['student_id'] ?>"><?= $student['fname'] ?></a></td>
                                        <td><?= $student['lname'] ?></td>
                                        <td><?= $student['username'] ?></td>
    
                                        <td>
                                            <?php
                                            $grade = $student['grade'];
                                            $g_temp = getGradeById($grade, $conn);

                                            if ($g_temp != 0) {
                                            echo $g_temp['grade_code'] . '- ' .
                                                        $g_temp['grade'] . ', ';
                                            }
                                             
                                            ?>
                                        </td>
                                        <td>
                                            <a href="student-edit.php?student_id=<?= $student['student_id'] ?>" class="btn btn-primary">Edit</a>
                                            <a href="student-delete.php?student_id=<?= $student['student_id'] ?>" class="btn btn-danger">Delete</a>
                                        </td>

                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-info .w-450 m-5" role="alert">
                        No Result Found
                        <a href="student.php" class="btn btn-dark"> Go Back</a>

                    </div>
                <?php } ?>
                </div>

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
            echo "Please log in first to see this page.";
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