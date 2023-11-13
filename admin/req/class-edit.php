<?php
session_start();

if (isset($_SESSION["admin_id"]) && 
    isset($_SESSION["role"])) {

    if ($_SESSION["role"] == "Admin") {


    if (isset($_POST['section'])    &&
        isset($_POST['grade']) &&
        isset($_POST['class_id'])){

            include '../../DB-connection.php';



            $section = $_POST['section'];
            $grade = $_POST['grade'];
            $class_id = $_POST['class_id'];

            $data = ' section=' . $section.'&grade='.$grade.'&class_id='.$class_id;


            if (empty($section)) {
                $em = "Section is required";
                header("Location: ../class-edit.php?error=$em&$data");
                exit;
            } else if (empty($grade)) {
                $em = "Grade is required";
                header("Location: ../class-edit.php?error=$em&$data");
                exit;
            }   else {  
                 //to check if class already exist
                 $sql_check = "SELECT * FROM class 
                 WHERE grade=? AND section=?";

                    $stmt_check = $conn->prepare($sql_check);
                    $stmt_check->execute([$grade, $section]);

                if ($stmt_check->rowCount() > 0) {
                    $em = "Class already exist";
                    header("Location: ../class-edit.php?error=$em&$data");
                    exit;
                } else{
                    $sql = "UPDATE class SET  section=?, grade=?
                                WHERE class_id=?";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$section, $grade, $class_id]);
                    $sm = "successfully Updated";
                    header("Location: ../class-edit.php?success=$sm&$data"); 
                    exit;
                }
            }

            
            } else {
                $em = "An error occured";
                header("Location: ../class.php?error=$em&$data"); 
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