<?php

session_start();
if (
    isset($_SESSION["admin_id"]) &&
    isset($_SESSION["role"]) &&
    isset($_GET['section_id'])) {

    if ($_SESSION["role"] == "Admin") {
        include "../DB-connection.php";
        include "data/section.php";
 
        $id = $_GET['section_id'];
        if (deleteSection($id, $conn)) {
            $sm = " Successfully deleted!";
            header("Location: section.php?success=$sm");
            exit;
        } else {
            $em = " Unknown Error Occured!";
            header("Location: section.php?error=$em");
            exit;
        }
    } else {
        echo "Please log in first to see this page.";
        header("Location: section.php");
        exit;
    }
} else {
    echo "Please log in first to see this page.";
    header("Location: section.php");
    exit;
}
