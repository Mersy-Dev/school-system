<?php

session_start();
if (
    isset($_SESSION["admin_id"]) &&
    isset($_SESSION["role"]) &&
    isset($_GET['grade_id'])) {

    if ($_SESSION["role"] == "Admin") {
        include "../DB-connection.php";
        include "data/grade.php";
 
        $id = $_GET['grade_id'];
        if (deleteGrade($id, $conn)) {
            $sm = " Successfully deleted!";
            header("Location: grade.php?success=$sm");
            exit;
        } else {
            $em = " Unknown Error Occured!";
            header("Location: grade.php?error=$em");
            exit;
        }
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
