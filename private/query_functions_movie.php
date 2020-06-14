<?php

function find_movie_by_ID($ID) {
    global $db;

    $sql = "SELECT * FROM movies ";
    $sql .= "WHERE ID='" . db_escape($db, $ID) . "'";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $movie = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $movie; // returns an assoc. array
}

// Find all movies
function find_all_movies() {
    global $db;

    $sql = "SELECT * FROM movies ";
    //$sql .= "ORDER BY id ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_movie_by_info($title, $rating, $year, $genre) {
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

function find_top_ten_movies() {
    global $db;

//SET @max=(SELECT MAX(search_times) FROM movies);
//SET @min=(SELECT MIN(search_times) FROM movies);
//SELECT *,ROUND(((search_times-@min)/((@max-@min)/5)*0.4+clients_rating*0.6),1) AS test FROM movies ORDER BY ROUND(((search_times-@min)/((@max-@min)/5)*0.4+clients_rating*0.6),1) DESC,id LIMIT 10
    $sql = "SET @max=(SELECT MAX(search_times) FROM movies); ";
    $sql .= "SET @min=(SELECT MIN(search_times) FROM movies); ";
    $sql .= "SELECT *,ROUND(((search_times-@min)/((@max-@min)/5)*0.4+clients_rating*0.6),1) AS finalRating FROM movies ORDER BY ROUND(((search_times-@min)/((@max-@min)/5)*0.4+clients_rating*0.6),1) DESC,id LIMIT 10";

    $count = 1;
    if (mysqli_multi_query($db, $sql)) {
        do {
            // Store first result set
            if ($result = mysqli_store_result($db)) {
                if ($count == 3) {
                    confirm_result_set($result);
                    return $result;
                } else {
                    mysqli_free_result($result);
                }
            }
            $count++;
            //Prepare next result set
        } while (mysqli_next_result($db));
    }


//    $result = mysqli_query($db, $sql);
//    confirm_result_set($result);
//    return $result;
}

function update_search_times($id) {
    global $db;

    $sql = "UPDATE movies SET search_times=search_times+1 ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        //failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_clients_rating($id, $rating) {
    global $db;

    $sql = "UPDATE movies SET clients_rating='" . db_escape($db, $rating) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        //failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_evaluated_times($id) {
    global $db;

    $sql = "UPDATE movies SET evaluated_times = evaluated_times+1 ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        //failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function max_searched_times() {
    global $db;

    $sql = "SELECT MAX(search_times) AS search_times FROM movies";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    return $row['search_times'];
}

function min_searched_times() {
    global $db;

    $sql = "SELECT MIN(search_times) AS search_times FROM movies";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    return $row['search_times'];
}

?>
