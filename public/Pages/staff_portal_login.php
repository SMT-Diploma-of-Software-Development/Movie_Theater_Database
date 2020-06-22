<?php
// require needed funcionts
require_once '../../private/initialize.php';
require_once '../../private/query_functions_portal.php';
?>

<!-- insert page header -->
<?php require SHARED_PATH . '/page_header.php';
?>

<!-- Navbar ( sit on top ) ( Responsive ( less than 601px hide bar ) ) -->
<div class='w3-top'>
    <div class='w3-bar w3-white w3-card' id='myNavbar'>
        <a href='#home' class='w3-bar-item w3-button w3-wide'>Home</a>
        <!-- Hide right-floated links on small screens and replace them with a menu icon ( Responsive ) -->

        <a href='javascript:void(0)' class='w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium' onclick='w3_open()'>
            <i class='fa fa-bars'></i>
        </a>
    </div>
</div>

<!-- Header with full-height image -->
<header class='bgimg-1 w3-display-container w3-grayscale-min' id='home'>
    <div class='w3-display-left w3-text-white' style='padding:48px'>
        <span class='w3-jumbo w3-hide-small'>Movie Theater - Staff Portal</span><br>
        <span class='w3-xxlarge w3-hide-large w3-hide-medium'>Movie Theater Small Screen</span><br>

        <?php
        session_start();

        //check session
        if(isset($_SESSION['account'])) {
            if($_SESSION['account']['username']=="admin") {
                header("Location: staff_portal_admin.php");
                exit();
            }
            header("Location: staff_portal.php");
            exit();
        }

        $error_message = "";

        if (isset($_POST['username'])) {
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                if ($account = auth(($_POST['username']), $_POST['password'])) {
                    $_SESSION['account'] = $account;
                    if ($_SESSION['account']['usernamer'] == "admin") {
                        header("Location: staff_portal_admin");
                    }
                    header("Location: staff_portal.php");
                } else {
                    $error_message = "Username or password is incorrect. Please Try again.";
                }
            }
        }
        ?>
        <?php if ($error_message) {
            echo $error_message;
        } ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="login" style="border:none">
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <input name="submit" type="submit" value="Login" />
        </form>

    </div>
</header>
<?php require SHARED_PATH . '/page_footer.php'; ?>