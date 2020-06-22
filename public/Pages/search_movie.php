<?php
require_once '../../private/initialize.php';

if (is_post_request()) {
    // Handle form values 
    $movie = [];
    $movie['title'] = $_POST['title'];
    $movie['rating'] = $_POST['rating'];
    $movie['year'] = $_POST['year'];
    $movie['genre'] = $_POST['genre'];
    $targetMovies = find_movie_by_info($movie['title'], $movie['rating'], $movie['year'], $movie['genre']);
} else {
    redirect_to(url_for_public('/Pages/home_page.php'));
}

require SHARED_PATH . '/page_header.php';
?>


<div class="w3-container" style="padding:128px 16px" id="search">
    <h2 class="w3-center">SEARCH RESULT</h2>
    <div class="w3-row-padding w3-center" style="margin-top:64px">
        <div class="w3-card-4" >
            <div class="w3-container w3-brown">
                <h2>Search Result</h2>
            </div>
            <div  style="overflow-x:auto;" >
                <?php
                if ($targetMovies->num_rows > 0) {

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
                    <th>Give Rating</th>
                </tr>";
                    while ($movie = mysqli_fetch_assoc($targetMovies)) {
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
                        <td onclick=targetID(" . $movie['id'] . ")>
                        <button id='evaluate_button' onclick=\"evaluateButtonClick()\" style=\"width:auto;\" class='evaluateBtn' aria-label=', Movie title " . $movie['title'] . "evaluate'>Evaluate</button></td>
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
</div>

<!--evaluate modal, hide by default-->
<div id="rating_modal" class="modal">

    <form id="evaluate_form" name="inputform" class="modal-content animate" action="<?php echo url_for_public('/Pages/update_movie_rating.php'); ?>" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('rating_modal').style.display = 'none'" class="close" title="Close Modal">&times;</span>
        </div>

        <div class="container">

            <input type="hidden" name="id" id="id" required>

            <label for="rating">Evaluate the movie</label>
            <select name="clients_rating" id="clients_rating" aria-label="give movie rating stars">
                <option value=0>0</option>
                <option value=1>1</option>
                <option value=2>2</option>
                <option value=3>3</option>
                <option value=4>4</option>
                <option value=5>5</option>
            </select>
            <label for="rating">stars</label>

            <button id="evaluateSubmitBtn" type="submit" aria-label="submit evaluating">Submit</button>

        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('rating_modal').style.display = 'none'" class="cancelbtn" id="ratingCancelBtn" aria-label="cancel rating" tabindex="0">Cancel</button>
        </div>
    </form>
</div>


<?php require SHARED_PATH . '/page_footer.php'; ?>
