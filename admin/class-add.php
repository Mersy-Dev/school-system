<?php
session_start();
if (
    isset($_SESSION["admin_id"]) &&
    isset($_SESSION["role"])
) {
    if ($_SESSION["role"] == "Admin") {
        include "../DB-connection.php";
        include "data/grade.php";
        include "data/section.php";

        $grades = getAllGrades($conn);
        $sections = getAllSections($conn);

        

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin - Add Class </title>
            <link rel="stylesheet" href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">">
            <link rel="stylesheet" href="../css/styles.css">
            <link rel="icon" href="../Minion.png">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        </head>

        <body class="">
            <?php
            include "inc/navbar.php";
            if ($sections == 0 || $grades == 0 ) { ?>
                <div class='alert alert-info' role='alert'>
                     First create Section and class
                </div>
                <a href="class.php" class="btn btn-dark">Go Back</a>

            <?php }

            ?>

            <div class="container mt-5">
                <a href="class.php" class="btn btn-dark"> Go Back</a>

                <form class="shadow p-3 mt-5 form-w" method="post" action="req/class-add.php">
                    <h3>Add New Class</h3>
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
                        <label class="form-label">Grade</label>
                        <select name="grade" 
                                class="form-control">
                                <?php foreach($grades as $grade){ ?>
                                    <option value="<?=$grade['grade_id']?>">
                                        <?=$grade['grade_code'].'-' . $grade['grade'] ?>
                                    </option>
                                <?php } ?> 
                        </select>  
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Section</label>
                        <select name="section" class="form-control">
                                <?php foreach($sections as $section){ ?>
                                    <option value="<?=$section['section_id']?>">
                                        <?=$section['section']?>
                                    </option>
                                <?php } ?>                         
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Create</button>

                </form>
            </div>

            <script>
                $(document).ready(function() {
                    $("#navLinks li:nth-child(6) a").addClass("active");
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