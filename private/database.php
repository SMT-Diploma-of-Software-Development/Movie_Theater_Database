<?php
/**
 * database 
 * all database functions
 */


require_once 'db_credentials.php';

/**
 * database connection
 */
function db_connect()
{
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    confirm_db_connect();
    return $connection;
}

/**
 * database disconnection
 */
function db_disconnect($connection)
{
    if (isset($connection)) {
        mysqli_close($connection);
    }
}

/**
 * escape string function
 */
function db_escape($connection, $string)
{
    return mysqli_real_escape_string($connection, $string);
}

function confirm_db_connect()
{
    if (mysqli_connect_errno()) {
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " (" . mysqli_connect_errno() . ")";
        exit($msg);
    }
}

/**
 * check return result of SQL query
 */
function confirm_result_set($result_set)
{
    if (!$result_set) {
        exit("Database query failed.");
    }
}

?>
