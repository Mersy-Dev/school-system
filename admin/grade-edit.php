<?php
session_start();
if (
    isset($_SESSION["admin_id"]) &&
    isset($_SESSION["role"]) &&
    isset($_GET["grade_id"])
) {
    if ($_SESSION["role"] == "Admin") {
        include "../DB-connection.php";
        include "data/grade.php";
        // $grades = getGradeById($conn);
        $grades = getAllGrades($conn);
        $grade_id = $_GET["grade_id"];
        $grade = getGradeById($grade_id, $conn);
        if ($grade == 0) {
            header("Location: grade.php");
            exit;
        
        }



?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin - Edit Grades</title>
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
                <a href="grade.php" class="btn btn-dark"> Go Back</a>

                <form class="shadow p-3 mt-5 form-w" method="post" action="req/grade-edit.php">
                    <h3>Edit Grades</h3>
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
                        <label class="form-label">Grade Code</label>
                        <input type="text" class="form-control" name="grade_code" value="<?=$grade['grade_code']?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Grade</label>
                        <input type="text" class="form-control" name="grade" value="<?=$grade['grade']?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Grade</label>
                        <input type="text" class="form-control" name="grade_id" value="<?=$grade['grade_id']?>" hidden>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>

                </form>
            </div>
            <script>
                $(document).ready(function() {
                    $("#navLinks li:nth-child(4) a").addClass("active");
                });
            </script>
            <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>"></script>
        </body>

        </html>

<?php
    } else {
        echo "Please log in first to see this page.";
        header("Location: grade.php");
        exit;
    }
} else {
    echo "Please log in first to see this page.";
    header("Location: grade.php");
    exit;
}
?>