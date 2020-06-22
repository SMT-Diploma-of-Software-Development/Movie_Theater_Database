<?php

require_once '../../private/initialize.php';

if (is_post_request()) {
    // Handle form values  
    $movie = find_movie_by_ID($_POST['id']);
    
    $maxSearchtimes = max_searched_times();
    $minSearchtimes = min_searched_times();
    $searchTimesRating=round(($movie['search_times']-$minSearchtimes)/(($maxSearchtimes-$minSearchtimes)/5));

    $clientRating = round(($movie['clients_rating'] * $movie['evaluated_times'] + $_POST['clients_rating']) / ($movie['evaluated_times'] + 1), 1);

    update_evaluated_times($movie['id']);
    update_clients_rating($movie['id'], $clientRating);
    
    redirect_to(url_for_public('/Pages/home_page.php'));
} else {
    redirect_to(url_for_public('/Pages/home_page.php'));
}

require SHARED_PATH . '/page_header.php';
?>


<?php require SHARED_PATH . '/page_footer.php'; ?>
