<?php
require_once '../../private/initialize.php';

?>


<?php require SHARED_PATH . '/page_header.php'; ?>

<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-card" id="myNavbar">
        <a href="#home" class="w3-bar-item w3-button w3-wide">Home</a>
        <!-- Right-sided navbar links -->
        <div class="w3-right w3-hide-small">
            <a href="#about" class="w3-bar-item w3-button">Search movie</a>
            <a href="#team" class="w3-bar-item w3-button"><i class="fa fa-user"></i>Top ten</a>
            <a href="#contact" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> CONTACT</a>
        </div>
        <!-- Hide right-floated links on small screens and replace them with a menu icon -->

        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
    <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button">Search movie</a>
    <a href="#team" onclick="w3_close()" class="w3-bar-item w3-button">Top ten</a>
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button">CONTACT</a>
</nav>

<!-- Header with full-height image -->
<header class="bgimg-1 w3-display-container w3-grayscale-min" id="home">
    <div class="w3-display-left w3-text-white" style="padding:48px">
        <span class="w3-jumbo w3-hide-small">Movie Theater</span><br>
        <span class="w3-xxlarge w3-hide-large w3-hide-medium">Start something that matters</span><br>
        <p><a href="#about" class="w3-button w3-white w3-padding-large w3-large w3-margin-top w3-opacity w3-hover-opacity-off">Start Search</a></p>
    </div>
    <div class="w3-display-bottomleft w3-text-grey w3-large" style="padding:24px 48px">
        <i class="fa fa-facebook-official w3-hover-opacity"></i>
        <i class="fa fa-instagram w3-hover-opacity"></i>
        <i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>
    </div>
</header>

<!-- Search Section -->
<div class="w3-container" style="padding:128px 16px" id="about">
    <h2 class="w3-center">SEARCH MOVIE</h2>
    <div class="w3-row-padding w3-center" style="margin-top:64px">
        <div class="w3-card-4">
            <div class="w3-container w3-brown">
                <h2>Search Movie</h2>
            </div>

            <form class="w3-container" action="<?php echo url_for_public('/Pages/search_movie.php'); ?>" method="post">
                <p>
                    <label class="w3-text-brown"><b>Title</b></label>
                    <input class="w3-input w3-border w3-sand" name="title" type="text"></p>
                <p>
                    <label class="w3-text-brown"><b>Rating</b></label>
                    <input class="w3-input w3-border w3-sand" name="rating" type="text"></p>
                <p>
                    <label class="w3-text-brown"><b>Year</b></label>
                    <input class="w3-input w3-border w3-sand" name="year" type="text"></p>
                <p>
                    <label class="w3-text-brown"><b>genre</b></label>
                    <input class="w3-input w3-border w3-sand" name="genre" type="text"></p>
                <p>
                    <button class="w3-btn w3-brown" id="searchBtn" type="submit">Search</button></p>
            </form>
        </div>
    </div>

</div>

<!-- Top Ten Section -->
<div class="w3-container" style="padding:128px 16px" id="team">
    <h2 class="w3-center">Top Ten</h2>
    <p class="w3-center w3-large">Top ten searched movie</p>
    <div class="w3-row-padding w3-grayscale" style="margin-top:64px" align="center">
        <?php require 'top_ten_chart.php'; ?>
        <!-- <img src="chart.png" class="w3-image w3-greyscale" style="width:100%;margin-top:48px"> -->
        <br>
        <a href="<?php echo url_for_public('/Pages/top_ten_list.php'); ?>" class="w3-button w3-light-grey">Top Ten List</a>
    </div>
</div>

<div id="modal01" class="w3-modal w3-black" onclick="this.style.display='none'">
  <span class="w3-button w3-xxlarge w3-black w3-padding-large w3-display-topright" title="Close Modal Image">×</span>
  <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
    <img id="img01" class="w3-image">
    <p id="caption" class="w3-opacity w3-large"></p>
  </div>
</div>
<!-- Contact Section -->
<div class="w3-container w3-light-grey" style="padding:128px 16px" id="contact">
    <h3 class="w3-center">CONTACT</h3>
    <p class="w3-center w3-large">Lets get in touch. Send us a message:</p>
    <div style="margin-top:48px">
        <p><i class="fa fa-map-marker fa-fw w3-xxlarge w3-margin-right"></i> XXXX,XXXX </p>
        <p><i class="fa fa-phone fa-fw w3-xxlarge w3-margin-right"></i> Phone: +00 151515</p>
        <p><i class="fa fa-envelope fa-fw w3-xxlarge w3-margin-right"> </i> Email: mail@mail.com</p>
        <br>
        <form action="#contact">
            <p><input class="w3-input w3-border" type="text" placeholder="Name" required name="Name"></p>
            <p><input class="w3-input w3-border" type="text" placeholder="Email" required name="Email"></p>
            <p><input class="w3-input w3-border" type="text" placeholder="Subject" required name="Subject"></p>
            <p><input class="w3-input w3-border" type="text" placeholder="Message" required name="Message"></p>
            <p>
                <button class="w3-button w3-black" type="submit">
                    <i class="fa fa-paper-plane"></i> SEND MESSAGE
                </button>
            </p>
        </form>

        <img src="../img/theater.png" class="w3-image w3-greyscale" style="width:100%;margin-top:48px">
    </div>
</div>

<?php require SHARED_PATH . '/page_footer.php'; ?>
