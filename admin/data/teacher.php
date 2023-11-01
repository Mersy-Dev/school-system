<?php

function getAllTeachers($conn)
{
    $sql = "SELECT * FROM teachers";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $teachers = $stmt->fetchAll();
        return $teachers; 
    } else {
        return 0;
    }


}


// check if the username is unique
function unameIsUnique($uname, $conn)
{
    $sql = "SELECT username FROM teachers WHERE username=? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$uname]);

    if ($stmt->rowCount() >= 1) {
        return 0; 
    } else {
        return 1;
    }


}