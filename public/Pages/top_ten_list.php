<?php
require_once '../../private/initialize.php';

$result = find_top_ten_movies();

require SHARED_PATH . '/page_header.php';
?>
<div class="w3-container" style="padding:128px 16px" id="about">
    <h2 class="w3-center">SEARCH RESULT</h2>
    <div class="w3-row-padding w3-center" style="margin-top:64px">
        <div class="w3-card-4">
            <div class="w3-container w3-brown">
                <h2>Search Result</h2>
            </div>

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
                </tr>

                <?php while ($movie = mysqli_fetch_assoc($result)) { ?>
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
                    </tr>
                <?php } ?>

            </table>

        </div>
    </div>
</div>

<?php require SHARED_PATH . '/page_footer.php'; ?>
