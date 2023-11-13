<?php

session_start();
if (
    isset($_SESSION["admin_id"]) &&
    isset($_SESSION["role"]) &&
    isset($_GET['class_id'])) {

    if ($_SESSION["role"] == "Admin") {
        include "../DB-connection.php";
        include "data/class.php";
 
        $id = $_GET['class_id'];
        if (deleteClass($id, $conn)) {
            $sm = " Successfully deleted!";
            header("Location: class.php?success=$sm");
            exit;
        } else {
            $em = " Unknown Error Occured!";
            header("Location: class.php?error=$em");
            exit;
        }
    } else {
        echo "Please log in first to see this page.";
        header("Location: class.php");
        exit;
    }
} else {
    echo "Please log in first to see this page.";
    header("Location: class.php");
    exit;
}
