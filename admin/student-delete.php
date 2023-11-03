<?php

session_start();
if (
    isset($_SESSION["admin_id"]) &&
    isset($_SESSION["role"]) &&
    isset($_GET['student_id'])) {

    if ($_SESSION["role"] == "Admin") {
        include "../DB-connection.php";
        include "data/student.php";

        $id = $_GET['student_id'];
        if (deleteStudent($id, $conn)) {
            $sm = " Successfully deleted!";
            header("Location: student.php?success=$sm");
            exit;
        } else {
            $em = " Unknown Error Occured!";
            header("Location: student.php?error=$em");
            exit;
        }
    } else {
        echo "Please log in first to see this page.";
        header("Location: student.php");
        exit;
    }
} else {
    echo "Please log in first to see this page.";
    header("Location: student.php");
    exit;
}
