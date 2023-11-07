<?php

//Get Teacher by Id
function getTeacherById($teacher_id, $conn)
{
    $sql = "SELECT * FROM teachers WHERE teacher_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$teacher_id]);

    if ($stmt->rowCount() == 1) {
        $teacher = $stmt->fetch();
        return $teacher;
    } else {
        return 0;
    }
}



//All Teachers
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
function unameIsUnique($uname, $conn, $teacher_id = 0)
{
    $sql = "SELECT username, teacher_id FROM teachers WHERE username=? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$uname]);

    if ($teacher_id == 0) {
        if ($stmt->rowCount() >= 1) {
            return 0;
        } else {
            return 1;
        }
    }else {
        if ($stmt->rowCount() >= 1) {
         $teacher = $stmt->fetch();
            if ($teacher['teacher_id'] == $teacher_id) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 1;
        }   
    }
}


//search
function searchTeachers($key, $conn)
{
    $key = preg_replace('/(?<!\\\)([%_])/', '\\\$1', $key);
    $sql = "SELECT * FROM teachers 
                    WHERE teacher_id LIKE ? 
                    OR fname LIKE ? 
                    OR lname LIKE ? 
                    OR username LIKE ?
                    OR address LIKE ?
                    OR date_of_birth LIKE ?
                    OR phone_number LIKE ?
                    OR qualification LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$key, $key, $key, $key, $key, $key, $key, $key]);

    if ($stmt->rowCount() == 1) {
        $teachers = $stmt->fetchAll();
        return $teachers;
    } else {
        return 0;
    }
}


//delete teacher by id
function deleteTeacher($id, $conn)
{
    $sql = "DELETE FROM teachers WHERE teacher_id=? ";
    $stmt = $conn->prepare($sql);
    $re = $stmt->execute([$id]);

    if ($re) {
        return 1;
    } else {
        return 0;
    }
}
