<?php
require_once '../../private/initialize.php';

$topTen = find_top_ten_movies();

require SHARED_PATH . '/page_header.php';
?>

<meta http-equiv="refresh" content="10" > 
<style>


    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    /* Set a style for all buttons */
    button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        opacity: 0.8;
    }

    /* Extra styles for the cancel button */
    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    /* Center the image and position the close button */
    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
        position: relative;
    }

    img.avatar {
        width: 40%;
        border-radius: 50%;
    }

    .container {
        padding: 16px;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        padding-top: 60px;
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button (x) */
    .close {
        position: absolute;
        right: 25px;
        top: 0;
        color: #000;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: red;
        cursor: pointer;
    }
    .checked {
        color: orange;
    }

    /* Add Zoom Animation */
    .animate {
        -webkit-animation: animatezoom 0.6s;
        animation: animatezoom 0.6s
    }

    @-webkit-keyframes animatezoom {
        from {-webkit-transform: scale(0)}
        to {-webkit-transform: scale(1)}
    }

    @keyframes animatezoom {
        from {transform: scale(0)}
        to {transform: scale(1)}
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }
        .cancelbtn {
            width: 100%;
        }
    }
</style>
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
                            <button onclick="document.getElementById('rating_modal').style.display = 'block'" style="width:auto;">Evaluate</button></td>

                        </tr>
                    <?php } ?>

                </table>
            </div>
        </div>
    </div>
</div>

<div id="rating_modal" class="modal">

    <form name="inputform" class="modal-content animate" action="<?php echo url_for_public('/Pages/update_movie_rating.php'); ?>" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('rating_modal').style.display = 'none'" class="close" title="Close Modal">&times;</span>
        </div>

        <div class="container">

            <input type="hidden" name="id" id="id" required>

            <label for="rating">Evaluate the movie</label>
            <select name="clients_rating" id="clients_rating">
                <option value=0>0</option>
                <option value=1>1</option>
                <option value=2>2</option>
                <option value=3>3</option>
                <option value=4>4</option>
                <option value=5>5</option>
            </select>
            <label for="rating">stars</label>

            <button type="submit">Submit</button>

        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('rating_modal').style.display = 'none'" class="cancelbtn">Cancel</button>
        </div>
    </form>
</div>

<script>
// Get the modal
    var modal = document.getElementById('rating_modal');

// When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    function targetID(x) {
        var tabRows = document.getElementById("outTable").rows.length;
        for (var i = 1; i < tabRows; i++) {
            if (document.getElementById("outTable").rows[i].cells[0].innerHTML == x) {
                var id = document.getElementById("outTable").rows[i].cells[0].innerHTML;
                document.forms["inputform"]["id"].value = id;
            }
        }
    }
</script>
<?php require SHARED_PATH . '/page_footer.php'; ?>
