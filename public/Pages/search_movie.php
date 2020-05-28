<?php
require_once '../../private/initialize.php';

if (is_post_request()) {
    // Handle form values sent by new.php
    $movie = [];
    $movie['title'] = $_POST['title'];
    $movie['rating'] = $_POST['rating'];
    $movie['year'] = $_POST['year'];
    $movie['genre'] = $_POST['genre'];
    $result = find_movie_by_info($movie['title'], $movie['rating'], $movie['year'], $movie['genre']);
} else {
    redirect_to(url_for_public('/Pages/home_page.php'));
}

require SHARED_PATH . '/page_header.php';
?>
<div class="w3-container" style="padding:128px 16px" id="about">
    <h2 class="w3-center">SEARCH RESULT</h2>
    <div class="w3-row-padding w3-center" style="margin-top:64px">
        <div class="w3-card-4">
            <div class="w3-container w3-brown">
                <h2>Search Result</h2>
            </div>

            <?php
            if ($result->num_rows > 0) {

                echo "<table class='table table-striped' id='outTable'>
                <tr><th>ID</th>
                    <th>Title</th>
                    <th>Studio</th>
                    <th>Status</th>
                    <th>Sound</th>
                    <th>Versions</th>
                    <th>RecRetPrice</th>
                    <th>Rating</th>
                    <th>Year</th>
                    <th>Genre</th>
                    <th>Aspect</th>
                </tr>";
                while ($movie = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>" . $movie['id'] . "</td>
                        <td>" . $movie['title'] . "</td>
                        <td>" . $movie['studio'] . "</td>
                        <td>" . $movie['status'] . "</td>
                        <td>" . $movie['sound'] . "</td>
                        <td>" . $movie['versions'] . "</td>
                        <td>" . $movie['rec_ret_price'] . "</td>
                        <td> " . $movie['rating'] . "</td>
                        <td>" . $movie['year'] . "</td>
                        <td>" . $movie['genre'] . "</td>
                        <td>" . $movie['aspect'] . "</td>
                    </tr>";
                    update_search_times($movie['id']);
                }
            } else {

                echo "<h2>Can not find any matched movie</h2>";
            }
            ?>

            </table>

        </div>
    </div>
</div>

<?php require SHARED_PATH . '/page_footer.php'; ?>
