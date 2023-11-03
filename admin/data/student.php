<?php 

//All Students
function getAllStudents($conn)
{
    $sql = "SELECT * FROM students";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $students = $stmt->fetchAll();
        return $students;
    } else {
        return 0;
    }
}


//Get Teacher by Id
function getStudentById($id, $conn)
{
    $sql = "SELECT * FROM students WHERE student_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() == 1) {
        $student = $stmt->fetch();
        return $student;
    } else {
        return 0;
    }
}




//delete teacher by id
function deleteStudent($id, $conn)
{
    $sql = "DELETE FROM students WHERE student_id=? ";
    $stmt = $conn->prepare($sql);
    $re = $stmt->execute([$id]);

    if ($re) {
        return 1;
    } else {
        return 0;
    }
}


// check if the username is unique
function unameIsUnique($uname, $conn, $student_id = 0)
{
    $sql = "SELECT username, student_id FROM students WHERE username=? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$uname]);

    if ($student_id == 0) {
        if ($stmt->rowCount() >= 1) {
            return 0;
        } else {
            return 1;
        }
    }else {
        if ($stmt->rowCount() >= 1) {
         $student = $stmt->fetch();
            if ($student['student_id'] == $student_id) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 1;
        }   
    }
}

?>