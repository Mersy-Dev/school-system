<?php
session_start();
if (isset($_SESSION["id"]) && $_SESSION["role"]) {
    //echo "Welcome to the member's area, " . $_SESSION[""] . "!";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Minions School</title>
    <link rel="stylesheet" href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="icon" href="Minion.png">
</head>

<body class="body-home">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="shadow w-450 p-3 text-center bg-light" id="wit">
            <small>Role:
                <b>
                    <?php 
                        if ($_SESSION["role"] == "Admin") {
                            echo "Admin";
                        } else if ($_SESSION["role"] == "Teacher") {
                            echo "Teacher";
                        } else {
                            echo "Student";
                        }
                    ?>
                </b><br>

                <h3 class="display-4"> <?=$_SESSION["fname"]?></h3>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </small>
        </div>

    </div>

    <button class="bt"> jd</button>


    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>"></script>
</body>

</html>

<?php
    } else {
        echo "Please log in first to see this page.";
        header("Location: login.php");
        exit;
    }
?>