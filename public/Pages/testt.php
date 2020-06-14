<?php

require_once '../../private/initialize.php';

$targetMovies = find_all_movies();
?>


<?php

if ($targetMovies->num_rows > 0) {
    while ($movie = mysqli_fetch_assoc($targetMovies)) {

        update_search_times($movie['id']);
    }
}
?>


<?php require SHARED_PATH . '/page_footer.php'; ?>
