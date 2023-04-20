<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

function validatePassword($npsw) {
    $errMsgPsw = array();

    if ($npsw == "" || $npsw == null) {
        $errMsgPsw[] = "Please enter your Password.";
    }

    if (strlen($npsw) < 8 || strlen($npsw) > 12) {
        $errMsgPsw[] = "Password cannot exceed 12 characters.";
    }

    $pattern = "/^[A-Za-z0-9@?]{8,12}$/";

    if (preg_match($pattern, $npsw) == false) {
        $errMsgPsw[] = "Invalid new password entered.";
    }

    return $errMsgPsw;
}

function validateConfPassword($npsw, $confirmPsw) {
    $errMsgConfPassword = array();

    $pattern = "/^[A-Za-z0-9@?]{8,12}$/";

    if (preg_match($pattern, $confirmPsw) == false) {
        $errMsgConfPassword[] = "Invalid confirm password entered.";
    }

    if ($npsw != $confirmPsw) {
        $errMsgConfPassword[] = "The confirm password is not same as the password.";
    }

    return $errMsgConfPassword;
}

function validateFirstName($FirstName) {
    $errMsgFirstName = array();

    if ($FirstName == "" || $FirstName == null) {
        $errMsgFirstName[] = "Please enter your first name.";
    }

    if (strlen($FirstName) > 30) {
        $errMsgFirstName[] = "First Name cannot exceed 30 characters.";
    }

    $pattern = "/^[A-Za-z ]+$/";

    if (preg_match($pattern, $FirstName) == false) {
        $errMsgFirstName[] = "Invalid first name entered.";
    }

    return $errMsgFirstName;
}

function validateLastName($LastName) {
    $errMsgLastName = array();

    if ($LastName == "" || $LastName == null) {
        $errMsgLastName[] = "Please enter your last name.";
    }

    if (strlen($LastName) > 30) {
        $errMsgLastName[] = "Last Name cannot exceed 30 characters.";
    }

    $pattern = "/^[A-Za-z ]+$/";

    if (preg_match($pattern, $LastName) == false) {
        $errMsgLastName[] = "Invalid last name entered.";
    }

    return $errMsgLastName;
}

function getFacultyFullName($Faculty) {
    switch ($Faculty) {
        case "FOSS":
            return "Faculty of Social Science";
        case "FOAS":
            return "Faculty of Applied Sciences";
        case "FOBE":
            return "Faculty of Built Environment";
        case "FOCS":
            return "Faculty of Computing and Information Technology";
        case "FOET":
            return "Faculty of Engineering and Technology";
        case "FAFB":
            return "Faculty of Accountancy, Finance & Business";
        case "FCCI":
            return "Faculty of Communication and Creative Industries";
        default:
            return "Unknown";
    }
}

function validateProgramme($Programme) {
    $errMsgProgramme = array();

    if ($Programme == "" || $Programme == null) {
        $errMsgProgramme[] = "Please enter your Programme.";
    }

    if (strlen($Programme) > 7) {
        $errMsgProgramme[] = "Programme cannot exceed 7 characters.";
    }

    $pattern = "/^[D][A-Z][A-Z][Y][1-3][S][1-3]$/";

    if (preg_match($pattern, $Programme) == false) {
        $errMsgProgramme[] = "Invalid Programme entered.";
    }

    return $errMsgProgramme;
}

function validateStudentID($StudentID) {

    $errMsgStudentID = array();

    if ($StudentID == "" || $StudentID == null) {
        $errMsgStudentID[] = "Please enter your StudentID.";
    }
    if (strlen($StudentID) > 10) {
        $errMsgStudentID[] = "Programme cannot exceed 10 characters.";
    }
    $pattern = "/^[0-9]{2}[A-Z]{3}[0-9]{5}$/";
    if (preg_match($pattern, $StudentID) == false) {
        $errMsgStudentID[] = "Invalid Student ID entered.";
    }
    
    global $dbConnection;
    $selectCommand = "SELECT * FROM member WHERE StudentID = '$StudentID'";
    $result = mysqli_query($dbConnection, $selectCommand);

    if ($result->num_rows > 0) {
        $errMsgStudentID[] = "Student ID " . $StudentID . " already exist.";
    }
    return $errMsgStudentID;
}

function validateStudentEmail($StudentEmail) {
    $errMsgStudentEmail = array();

    if ($StudentEmail == "" || $StudentEmail == null) {
        $errMsgStudentEmail[] = "Please enter your Student Email.";
    }

    if (strlen($StudentEmail) > 50) {
        $errMsgStudentEmail[] = "Student Email cannot exceed 50 characters.";
    }

    $pattern = "/^[A-Za-z0-9@_?.-]+$/";

    if (preg_match($pattern, $StudentEmail) == false) {
        $errMsgStudentEmail[] = "Invalid Student Email entered.";
    }

    return $errMsgStudentEmail;
}

function validateContact($Contact) {
    $errMsgContact = array();

    if ($Contact == "" || $Contact == null) {
        $errMsgContact[] = "Please enter your Contact Number.";
    }

    if (strlen($Contact) > 12) {
        $errMsgContact[] = "Contact Number cannot exceed 12 characters.";
    }

    $pattern = "/^[0-9-]+$/";

    if (preg_match($pattern, $Contact) == false) {
        $errMsgContact[] = "Invalid Contact Number entered.";
    }

    return $errMsgContact;
}

function getGenderFullName($Gender) {
    return ($Gender == "M" ? "Male" : "Female");
}

function getDateMsg($DateOfBirth) {
    //Change YYYY-MM-DD to DD-MM-YYYY
    $formattedDate = date("d M Y", strtotime($DateOfBirth));
    return $formattedDate;
}
