

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64">
    <a href="<?php echo url_for_public('/Pages/home_page.php'); ?>" class="w3-button w3-light-grey" aria-label=", Guide to home page, "><i class="fa fa-arrow-up w3-margin-right" ></i>Back to home page</a>
    <div class="w3-xlarge w3-section">
        <i class="fa fa-facebook-official w3-hover-opacity"></i>
        <i class="fa fa-instagram w3-hover-opacity"></i>
        <i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>
</footer>
<script>
    // Modal Image Gallery
    function onClick(element) {
        document.getElementById("img01").src = element.src;
        document.getElementById("modal01").style.display = "block";
        var captionText = document.getElementById("caption");
        captionText.innerHTML = element.alt;
    }

    // Toggle between showing and hiding the sidebar when clicking the menu icon
    var mySidebar = document.getElementById("mySidebar");

    //side bar control function
    function w3_open() {
        if (mySidebar.style.display === 'block') {
            mySidebar.style.display = 'none';
        } else {
            mySidebar.style.display = 'block';
        }
    }

    // Close the sidebar with the close button
    function w3_close() {
        mySidebar.style.display = "none";
    }

    // Get the rating modal
    var modal = document.getElementById('rating_modal');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    //get the row's id number
    function targetID(x) {
        var tabRows = document.getElementById("outTable").rows.length;
        for (var i = 1; i < tabRows; i++) {
            if (document.getElementById("outTable").rows[i].cells[0].innerHTML == x) {
                var id = document.getElementById("outTable").rows[i].cells[0].innerHTML;
                document.forms["inputform"]["id"].value = id;
            }
        }
    }

    //focus tab event, when modal show up tab will focus on modal
    const evaluateBtn = document.querySelector('.evaluateBtn');
    const allBackgroundElements = document.querySelectorAll('.evaluateBtn');
    const clientRatingSelect = document.querySelector('#clients_rating');
    const cancelBtn = document.querySelector('#ratingCancelBtn');
    const evaluateSubmitBtn = document.getElementById('evaluateSubmitBtn');


    //click evaluate button, show modal
    function evaluateButtonClick() {
        document.getElementById('rating_modal').style.display = 'block';

        document.querySelector("#clients_rating").focus();
    }

    //keyboard event listener 
    document.addEventListener('keydown', (e) => {
        //if target is sign in button, check the key pressed.
        if (e.target === evaluateBtn) {
            //if key is "Enter":
            //Show modal.
            //Remove elements outside modal from tab order.
            //Focus on rating select box.
            if (e.keyCode === 13) {
                document.getElementById('rating_modal').style.display = 'block';
                for (const element of allBackgroundElements) {
                    element.setAttribute('tabindex', "-1");
                }
                document.querySelector("#clients_rating").focus();
            }
        } else if (e.target === cancelBtn) {
            //if target is cancel button, check for key(s) pressed.
            //if keys are "shift" and "tab":
            //Focus on submit button.
            if (e.shiftKey && e.keyCode === 9) {
                e.preventDefault();
                evaluateSubmitBtn.focus();
            } else if (e.keyCode === 13) {

                document.getElementById('rating_modal').style.display = 'none';
                for (const element of allBackgroundElements) {
                    element.setAttribute('tabindex', "0");
                }
                e.preventDefault();
                evaluateBtn.focus();

                //if key is "Tab":
                //Focus on rating select box.
            } else if (e.keyCode === 9) {
                e.preventDefault();
                clientRatingSelect.focus();
            }
        } else if (e.target === clientRatingSelect) {
            //If target rating select box.
            //if keys are "shift" and "tab":
            //Focus cancel button.
            if (e.shiftKey && e.keyCode === 9) {
                e.preventDefault();
                cancelBtn.focus();
            }
        }
    })

</script>

</body>
</html>

<?php
db_disconnect($db);
?>
