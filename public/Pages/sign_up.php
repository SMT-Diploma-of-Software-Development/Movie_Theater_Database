<?php
require_once '../../private/initialize.php';

if (is_post_request()) {
    $membership = [];
    $membership['username'] = $_POST['username'];
    $membership['email'] = $_POST['email'];


    if (!isset($_POST['monthly_newsletter']) && !isset($_POST['newsflash'])) {
        $errors[] = "at least select one subscribe plan";
    } else {
        if (isset($_POST['monthly_newsletter'])) {
            $membership['monthly_newsletter'] = 1;
        } else {
            $membership['monthly_newsletter'] = 0;
        }

        if (isset($_POST['newsflash'])) {
            $membership['newsflash'] = 1;
        } else {
            $membership['newsflash'] = 0;
        }
        $result = insert_membership($membership);
        if ($result === true) {
            redirect_to(url_for_public('/Pages/home_page.php'));
        } else {
            $errors = $result;
        }
    }
}

require SHARED_PATH . '/page_header.php';
?>

<h2>Subscribe Form</h2>

<form action="<?php echo url_for_public('/Pages/sign_up.php'); ?>" method="post">
    <div class="imgcontainer">
        <img src="../img/img_avatar2.png" alt="Avatar" class="avatar">
    </div>
    <?php
    if (!empty($errors)) {
        echo display_errors($errors);
    }
    ?>
    <div class="container">
        <label for="username"><b>User Name</b></label>
        <input type="text" title=" Username. " name="username" aria-label="Please input subscriber's name, " required>

        <label for="email"><b>Email</b></label>
        <input type="text" title=" Email. " name="email" aria-label="Please input subscriber's email, " required>
        <label>
            <input id='monthly_newsletter' type="checkbox" checked="checked" name="monthly_newsletter" aria-label="Subscribe monthly newsletter content, "> Monthly Newsletter
        </label>
        <label>
            <input id='newsflash' type="checkbox" checked="checked" name="newsflash" aria-label="Subscribe newsflash content, "> Newsflash
        </label>
        <button type="submit" onclick="subscribeButtonClick()">Subscribe</button>

    </div>


    <div class="container" style="background-color:#f1f1f1">
        <a href="<?php echo url_for_public('/Pages/unsubscribe.php'); ?>" type="button" class="cancelbtn">Unsubscribe</a>
    </div>
</form>

<script>
    // if error div is exists tab focus it
    var errorDiv = document.getElementById("errors");
    if (errorDiv!=null) {
        errorDiv.focus();
    }

</script>

<?php require SHARED_PATH . '/page_footer.php'; ?>
