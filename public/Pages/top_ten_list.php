<?php
require_once '../../private/initialize.php';

$topTen = find_top_ten_movies();

require SHARED_PATH . '/page_header.php';
?>

<meta http-equiv="refresh" content="30" > 

<div class="w3-container" style="padding:128px 16px" id="about">
    <h2 class="w3-center">SEARCH RESULT</h2>
    <div class="w3-row-padding w3-center" style="margin-top:64px">
        <div class="w3-card-4">
            <div class="w3-container w3-brown">
                <h2>Search Result</h2>
            </div>
            <div style="overflow-x:auto;">
                <table class="table table-striped" id="outTable">
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
                    </tr>

                    <?php while ($movie = mysqli_fetch_assoc($topTen)) { ?>
                        <tr>
                            <td><?php echo $movie['id']; ?></td>
                            <td><?php echo $movie['title']; ?></td>
                            <td><?php echo $movie['studio']; ?></td>
                            <td><?php echo $movie['status']; ?></td>
                            <td><?php echo $movie['sound']; ?></td>
                            <td><?php echo $movie['versions']; ?></td>
                            <td><?php echo $movie['rec_ret_price']; ?></td>
                            <td><?php echo $movie['rating']; ?></td>
                            <td><?php echo $movie['year']; ?></td>
                            <td><?php echo $movie['genre']; ?></td>
                            <td><?php echo $movie['aspect']; ?></td>
                            <td onclick=targetID("<?php echo $movie['id']; ?>")>
                            <button id="evaluate_button" onclick="evaluateButtonClick()" style="width:auto;" class="evaluateBtn" aria-label=", Movie title <?php echo $movie['title']; ?> evaluate">Evaluate</button>
                            </td>

                        </tr>
                    <?php } ?>

                </table>
            </div>
        </div>
    </div>
</div>

<!--evaluate modal, hide by default-->
<div id="rating_modal" class="modal">

    <form name="inputform" class="modal-content animate" action="<?php echo url_for_public('/Pages/update_movie_rating.php'); ?>" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('rating_modal').style.display = 'none'" class="close" title="Close Modal">&times;</span>
        </div>

        <div class="container">

            <input type="hidden" name="id" id="id" required>

            <label for="rating">Evaluate the movie</label>
            <select name="clients_rating" id="clients_rating" aria-label="give movie rating stars, ">
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
            <button type="button" onclick="document.getElementById('rating_modal').style.display = 'none'" class="cancelbtn" id="ratingCancelBtn" aria-label="cancel rating">Cancel</button>
        </div>
    </form>
</div>

<?php require SHARED_PATH . '/page_footer.php'; ?>
