<?php
session_start();
if (isset($_SESSION["admin_id"]) && $_SESSION["role"]) {
    if ($_SESSION["role"] == "Admin") {


?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin - Home</title>
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
                <div class="container text-center">
                    <div class="row row-cols-5">
                        <a href="teacher.php" class="col btn btn-dark m-2 py-3">
                            <i class="fa fa-user-md fs-1" aria-hidden="true"></i>
                            <br>
                            Teachers
                        </a>

                        <a href="" class="col btn btn-dark m-2 py-3">
                        <i class="fa fa-graduation-cap fs-1" aria-hidden="true"></i>
                            <br>
                            Students
                        </a>

                        <a href="" class="col btn btn-dark m-2 py-3">
                            <i class="fa fa-pencil-square fs-1" aria-hidden="true"></i>
                            <br>
                            Registrar-Office 
                        </a>

                        <a href="" class="col btn btn-dark m-2 py-3">
                            <i class="fa fa-cubes fs-1" aria-hidden="true"></i>
                            <br>
                            Class
                        </a>

                        <a href="" class="col btn btn-dark m-2 py-3">
                            <i class="fa fa-columns fs-1" aria-hidden="true"></i>
                            <br>
                            Section
                        </a>
                        <a href="" class="col btn btn-dark m-2 py-3">
                            <i class="fa fa-calendar fs-1" aria-hidden="true"></i>
                            <br>
                            Schedule
                        </a>                  
                        <a href="" class="col btn btn-dark m-2 py-3">
                            <i class="fa fa-book fs-1" aria-hidden="true"></i>
                            <br>
                            Courses
                        </a>
                        <a href="" class="col btn btn-dark m-2 py-3">
                            <i class="fa fa-envelope fs-1" aria-hidden="true"></i>
                            <br>
                            Messages
                        </a>
                        
                        <a href="" class="col btn btn-primary m-2 py-3 col-5">
                            <i class="fa fa-cogs fs-1" aria-hidden="true"></i>
                            <br>
                            Settings
                        </a>

                        <a href="../logout.php" class="col btn btn-warning m-2 py-3 col-5">
                            <i class="fa fa-sign-out fs-1" aria-hidden="true"></i>
                            <br>
                            Logout
                        </a>

                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $("#navLinks li:nth-child(1) a").addClass("active");
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