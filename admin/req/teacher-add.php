<?php
session_start();

if (isset($_SESSION["admin_id"]) && 
    isset($_SESSION["role"])) {

    if ($_SESSION["role"] == "Admin") {


    if (isset($_POST['fname']) &&
        isset($_POST['lname']) &&
        isset($_POST['username']) &&
        isset($_POST['pass']) &&
        isset($_POST['subjects']) &&
        isset($_POST['grades'])){

            include '../../DB-connection.php';
            include '../data/teacher.php';



            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $uname = $_POST['username'];
            $pass = $_POST['pass'];


            $grades = "";
            foreach ($_POST['grades'] as $grade) {
                $grades .= $grade . ",";
            }
             
            $subjects = "";
            foreach ($_POST['subjects'] as $subject) {
                $subjects .= $subject . ",";
            }


            $data = 'uname=' . $uname.'&fname='.$fname.'&lname='.$lname;
            if (empty($fname)) {
                $em = "FIrstname is required";
                header("Location: ../teacher-add.php?error=$em&$data");
                exit;
            } else if (empty($lname)) {
                $em = "Lastname is required";
                header("Location: ../teacher-add.php?error=$em&$data");
                exit;
            }  else if (empty($uname)) {
                $em = "Username is required";
                header("Location: ../teacher-add.php?error=$em&$data");
                exit;
            }  else if (!unameIsUnique($uname, $conn)) {
                $em = "Username is taken! Try another";
                header("Location: ../teacher-add.php?error=$em&$data");
                exit;
            }else if (empty($pass)) {
                $em = "Password is required.";
                header("Location: ../teacher-add.php?error=$em&$data");
                exit;
            } else {
                //hashing the password
                  $pass = password_hash($pass, PASSWORD_DEFAULT);

                  $sql = "INSERT INTO teachers (username, password, fname, lname, subjects, grades) 
                          VALUES (?, ?, ?, ?, ?, ?)";
                    
                  $stmt = $conn->prepare($sql);
                  $stmt->execute([$uname, $pass, $fname, $lname, $subjects, $grades]);
             
                  $sm = " New Teacher has registered successfully";
                  header("Location: ../teacher-add.php?success=$sm"); 
                  exit;
            }


            } else {
                $em = "An error occured";
                header("Location: ../teacher-add.php?error=$em"); 
                exit;
            }
        } else {
            header("Location: ../../logout.php");
            exit;
        }
    } else {
        header("Location: ../../logout.php");
        exit;
    }