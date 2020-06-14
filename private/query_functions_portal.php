<?php
//verify account
function auth($username, $password)
{
    global $db;
    $sql = "SELECT username, password FROM account WHERE username = '" . $username . "' AND  password = '" . $password . "'";
    $result = mysqli_query($db, $sql);
    if ($result->num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            $account['username'] = $row['username'];
            $account['password'] = $row['password'];
        }
        return $account;
    }
}

//get subscribed members
function getMembers()
{
    global $db;
    $sql = "SELECT * FROM membership";
    $result = mysqli_query($db, $sql);
    if ($result->num_rows > 0) {
        return $result;
    }
}

//delete subscribed member
function deleteMember($username, $email)
{
    global $db;
    $sql = "DELETE FROM membership WHERE username = '" . $username . "' AND email = '" . $email . "'";
    mysqli_query($db, $sql);
}

//get users
function getUsers()
{
    global $db;
    $sql = "SELECT * FROM account";
    $result = mysqli_query($db, $sql);
    if ($result->num_rows > 0) {
        return $result;
    }
}

//delete user
function deleteUser($id)
{
    global $db;
    $sql = "DELETE FROM account WHERE id = '" . $id . "'";
    mysqli_query($db, $sql);
}

//register user
function register($username, $password)
{
    global $db;
    $sql = "INSERT INTO account (username, password) VALUE ('".$username."','".$password."' )";
    mysqli_query($db, $sql);
}
