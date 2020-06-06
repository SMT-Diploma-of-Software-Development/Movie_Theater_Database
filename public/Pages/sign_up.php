<?php
require_once '../../private/initialize.php';

if (is_post_request()) {
    $membership = [];
    $membership['username'] = $_POST['username'];
    $membership['email'] = $_POST['email'];


    if (!isset($_POST['monthly_newsletter']) && !isset($_POST['newsflash'])) {
        $errors[] = "at least select one suscribe plan";
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
<style>
    body {font-family: Arial, Helvetica, sans-serif;}
    form {border: 3px solid #f1f1f1;}

    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

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

    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
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

<h2>Subscribe Form</h2>

<form action="<?php echo url_for_public('/Pages/sign_up.php'); ?>" method="post">
    <div class="imgcontainer">
        <img src="../img/img_avatar2.png" alt="Avatar" class="avatar">
    </div>
<?php echo display_errors($errors); ?>
    <div class="container">
        <label for="username"><b>Name</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>
        <label>
            <input id='monthly_newsletter' type="checkbox" checked="checked" name="monthly_newsletter"> Monthly Newsletter
            <input type="checkbox" checked="checked" name="newsflash"> Newsflash
        </label>
        <button type="submit">Subscribe</button>

    </div>


    <div class="container" style="background-color:#f1f1f1">
        <a href="<?php echo url_for_public('/Pages/unsubscribe.php'); ?>" class="cancelbtn">Unsubscribe</a>
    </div>

</form>


<?php require SHARED_PATH . '/page_footer.php'; ?>
