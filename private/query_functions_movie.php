<?php

// Find all movies
function find_all_movies()
{
    global $db;

    $sql = "SELECT * FROM movies ";
    //$sql .= "ORDER BY id ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_movie_by_info($title, $rating, $year, $genre)
{
    global $db;

    $sql = "SELECT * FROM movies ";
    $sql .= "WHERE id=id ";

    if (!empty($title)) {
        $sql .= "AND title='" . db_escape($db, $title) . "' ";
    }
    if (!empty($rating)) {
        $sql .= "AND rating='" . db_escape($db, $rating) . "' ";
    }
    if (!empty($year)) {
        $sql .= "AND year='" . db_escape($db, $year) . "' ";
    }
    if (!empty($genre)) {
        $sql .= "AND genre='" . db_escape($db, $genre) . "' ";
    }

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_top_ten_movies()
{
    global $db;

    $sql = "SELECT * FROM movies ORDER BY search_times DESC LIMIT 10";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function update_search_times($id)
{
    global $db;

    $sql = "UPDATE movies SET search_times=search_times+1 ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

?>
