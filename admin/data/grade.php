<?php

// get all subjects
function getAllGrades($conn)
{
    $sql = "SELECT * FROM grades";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $grades = $stmt->fetchAll();
        return $grades; 
    } else {
        return 0;
    }


}


// get all grades by  id
function getGradeById($grade_id, $conn)
{
    $sql = "SELECT * FROM grades WHERE grade_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$grade_id]);

    if ($stmt->rowCount() == 1) {
        $grade = $stmt->fetch();
        return $grade; 
    } else {
        return 0;
    }


}