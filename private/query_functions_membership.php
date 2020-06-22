<?php

/**
 * find all subscribers
 */
function find_all_membership()
{
    global $db;

    $sql = "SELECT * FROM membership ";
    //$sql .= "ORDER BY id ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}
/**
 * find all subscribers by email
 */
function find_membership_by_email($email)
{
    global $db;

    $sql = "SELECT * FROM membership ";
    $sql .= "WHERE email='" . db_escape($db, $email) . "'";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $enroll = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $enroll; // returns an assoc. array
}

/**
 * check if subscriber's information is legal 
 */
function validate_membership($membership)
{
    $errors = [];

    $namePattern = '/^[a-zA-Z]{1}.*$/';
    if (preg_match($namePattern, $membership['username'])) {

    } else {
        $errors[] = "Name need to start with letters.";
    }

    $emailPattern = '/^[\w.]+@{1}[\w.]+\.(com|net|com.au)$/';
    if (preg_match($emailPattern, $membership['email'])) {

    } else {
        $errors[] = "Email must match XXX@XXX.com or XXX@XXX.net or XXX@XXX.com.au. No hyphen no space.";
    }
    return $errors;
}
/**
 * check if subscriber's email is legal 
 */
function validate_email($email)
{
    $errors = [];

    $emailPattern = '/^[\w.]+@{1}[\w.]+\.(com|net|com.au)$/';
    if (preg_match($emailPattern, $email)) {

    } else {
        $errors[] = "Email must match XXX@XXX.com or XXX@XXX.net or XXX@XXX.com.au. No hypen no space.";
    }
    return $errors;
}
/**
 * insert subscriber's info to database
 */
function insert_membership($membership)
{
    global $db;

    $errors = validate_membership($membership);
    if (!empty($errors)) {
        return $errors;
    }


    $sql = "INSERT INTO membership ";
    $sql .= "(username, email, monthly_newsletter, newsflash) ";
    $sql .= "VALUES (";
    $sql .= "'" . $membership['username'] . "',";
    $sql .= "'" . $membership['email'] . "',";
    $sql .= "'" . $membership['monthly_newsletter'] . "',";
    $sql .= "'" . $membership['newsflash'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        //        echo mysqli_error($db);
        db_disconnect($db);
         $errors[] = "Error happened, please check email format or the email has already registered.";
        return  $errors;
        //        exit;
    }
}
/**
 * update subscriber's information is legal 
 */
function update_membership($membership)
{
    global $db;

    $errors = validate_membership($membership);
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "UPDATE membership SET ";
    $sql .= "Name='" . $membership['userame'] . "', ";
    $sql .= "Email='" . $membership['email'] . "' ";
    $sql .= "WHERE ID='" . $membership['ID'] . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//function delete_membership($ID)
//{
//    global $db;
//
//    $sql = "DELETE FROM membership ";
//    $sql .= "WHERE ID='" . $ID . "' ";
//    $sql .= "LIMIT 1";
//    $result = mysqli_query($db, $sql);
//
//    // For DELETE statements, $result is true/false
//    if ($result) {
//        return true;
//    } else {
//        // DELETE failed
//        echo mysqli_error($db);
//        db_disconnect($db);
//        exit;
//    }
//}
?>
