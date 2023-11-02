<?php

session_start();
if (
    isset($_SESSION["admin_id"]) &&
    isset($_SESSION["role"]) &&
    isset($_GET['teacher_id'])) {

    if ($_SESSION["role"] == "Admin") {
        include "../DB-connection.php";
        include "data/teacher.php";

        $id = $_GET['teacher_id'];
        if (deleteTeacher($id, $conn)) {
            $sm = " Successfully deleted!";
            header("Location: teacher.php?success=$sm");
            exit;
        } else {
            $em = " Unknown Error Occured!";
            header("Location: teacher.php?error=$em");
            exit;
        }
    } else {
        echo "Please log in first to see this page.";
        header("Location: teacher.php");
        exit;
    }
} else {
    echo "Please log in first to see this page.";
    header("Location: teacher.php");
    exit;
}
