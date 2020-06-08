<?php
require_once '../../private/initialize.php';

if (is_post_request()) {
//    $membership = [];
//    $membership['username'] = $_POST['username'];
//    $membership['email'] = $_POST['email'];

    $membership = find_membership_by_email($_POST['email']);
    if ($membership != null) {
        sendUnsubscribeMail($membership['email']);
        redirect_to(url_for_public('/Pages/home_page.php'));
    }else{
        redirect_to(url_for_public('/Pages/home_page.php'));
    }
}

require SHARED_PATH . '/page_header.php';
?>


<h2>Unsubscribe Form</h2>

<form action="<?php echo url_for_public('/Pages/unsubscribe.php'); ?>" method="post">
    <div class="imgcontainer">
        <img src="../img/img_avatar2.png" alt="Avatar" class="avatar">
    </div>
    <?php // echo display_errors($errors); ?>
    <div class="container">

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Please Enter Your Suscribe Email" name="email" required>

        <button type="submit">Unsubscribe</button>

    </div>

    <div class="container" style="background-color:#f1f1f1">
        <a href="<?php echo url_for_public('/Pages/home_page.php'); ?>" type="button" class="cancelbtn">Cancel</a>
    </div>
</form>


<?php require SHARED_PATH . '/page_footer.php'; ?>
