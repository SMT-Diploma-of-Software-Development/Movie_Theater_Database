<?php
// require needed funcionts
require_once '../../private/initialize.php';
require_once '../../private/query_functions_portal.php';
require_once '../../private/staff_portal_auth.php';
?>

<!-- insert page header -->
<?php require SHARED_PATH . '/page_header.php'; ?>

<!-- Navbar (sit on top) (Responsive (less than 601px hide bar)) -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-card" id="myNavbar">
        <a href="#home" class="w3-bar-item w3-button w3-wide">Home</a>
        <!-- Right-sided navbar links -->
        <div class="w3-right w3-hide-small">
            <a href="#user" class="w3-bar-item w3-button"><i class="fa fa-th"></i>User</a>
            <a href="#register" class="w3-bar-item w3-button"><i class="fa fa-th"></i>Register</a>
            <a href="#member" class="w3-bar-item w3-button"><i class="fa fa-th"></i>Member</a>
        </div>
        <!-- Hide right-floated links on small screens and replace them with a menu icon (Responsive) -->

        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon (Responsive     Hide content on medium screens (larger than 601px)) -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
    <a href="#user" onclick="w3_close()" class="w3-bar-item w3-button">User</a>
    <a href="#register" class="w3-bar-item w3-button"><i class="fa fa-th"></i>Register</a>
    <a href="#member" onclick="w3_close()" class="w3-bar-item w3-button">Member</a>
</nav>

<!-- Header with full-height image -->
<header class="bgimg-1 w3-display-container w3-grayscale-min" id="home">
    <div class="w3-display-left w3-text-white" style="padding:48px">
        <span class="w3-jumbo w3-hide-small">Movie Theater - Admin</span><br>
        <span class="w3-xxlarge w3-hide-large w3-hide-medium">Movie Theater Small Screen</span><br>
    </div>
</header>

<!--Datatable of accounts members -->
<div class="w3-container" style="padding:128px 16px" id="user">
    <h2 class="w3-center">User</h2>
    <div class="w3-row-padding w3-center" style="margin-top:64px">
        <div class="w3-card-4">
            <div class="w3-container w3-brown">
                <h2>Users</h2>
            </div>

            <?php
            if (isset($_POST['id'])) {
                deleteUser($_POST['id']);
            }

            $result = getUsers();
            if ($result->num_rows > 0) {
                echo "<table class='table table-striped'>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>password</th>
                    <th>Control</th>
                </tr>";
                while ($user = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . $user['id'] . "</td>
                    <td>" . $user['username'] . "</td>
                    <td>" . $user['password'] . "</td>
                    <td>
                    <form action='" . $_SERVER['PHP_SELF'] . "'method='post' name='delete' style='border:none'> 
                    <input type='hidden' name='id' value='" . $user['id'] . "' />
                    <input name='submit' type='submit' value='Delete' />
                    </form>
                    </td>
                </tr>";
                }
            } else {
                echo "<h2>No subscribed member</h2>";
            }
            ?>
            </table>
        </div>
    </div>
</div>

<!--Registration for new user -->
<div class="w3-container" style="padding:128px 16px" id="register">
    <h2 class="w3-center">Register</h2>
    <div class="w3-row-padding w3-center" style="margin-top:64px">
        <div class="w3-card-4">
            <div class="w3-container w3-brown">
                <h2>Users</h2>
            </div>
            <?php
            if (isset($_POST['username'])) {
                register($_POST['username'], $_POST['password']);
            } ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="login" style="border:none">
                <input type="text" name="username" placeholder="Username" required />
                <input type="password" name="password" placeholder="Password" required />
                <input name="submit" type="submit" value="Register" />
            </form>
        </div>
    </div>
</div>




<!--Datatable of subscribed members -->
<div class="w3-container" style="padding:128px 16px" id="member">
    <h2 class="w3-center">Subscribed Members</h2>
    <div class="w3-row-padding w3-center" style="margin-top:64px">
        <div class="w3-card-4">
            <div class="w3-container w3-brown">
                <h2>Subscribed Members</h2>
            </div>

            <?php
            if (isset($_POST['username'])) {
                deleteMember($_POST['username'], $_POST['email']);
            }

            $result = getMembers();
            if ($result->num_rows > 0) {
                echo "<table class='table table-striped'>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Monthly Newsletter</th>
                    <th>Newsflash</th>
                    <th>Control</th>
                </tr>";
                while ($member = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . $member['username'] . "</td>
                    <td>" . $member['email'] . "</td>
                    <td>" . $member['monthly_newsletter'] . "</td>
                    <td>" . $member['newsflash'] . "</td>
                    <td>
                    <form action='" . $_SERVER['PHP_SELF'] . "'method='post' name='delete' style='border:none'> 
                    <input type='hidden' name='username' value='" . $member['username'] . "' />
                    <input type='hidden' name='email' value='" . $member['email'] . "' />
                    <input name='submit' type='submit' value='Delete' />
                    </form>
                    </td>
                </tr>";
                }
            } else {
                echo "<h2>No subscribed member</h2>";
            }
            ?>
            </table>

        </div>
    </div>
</div>

<?php require SHARED_PATH . '/page_footer.php'; ?>