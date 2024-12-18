<?php
    session_start();
    if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] !=1)){
        header("Location: login-page.php");
        exit();
    }
?>
<?php include('header-admin.php'); ?>
<?php include('nav-admin.php'); ?>
<link rel="stylesheet" href="css/styles.css">

<section class="form-wrapper">
    <div class="transparent-div">
        <h2>Delete User Record</h2>
        <?php
        if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
            $id = $_GET['id'];
        } elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
            $id = $_POST['id'];
        } else {
            echo '<div class="error-container"><p>Invalid action. Go back to <a href="index.php">home</a>.</p></div>';
            exit();
        }

        require('mysqli_connect.php');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['sure'] == 'yes') {
                $q = "DELETE FROM users WHERE user_id = $id";
                $result = @mysqli_query($dbcon, $q);
                if (mysqli_affected_rows($dbcon) == 1) {
                    echo '<p>Deleted successfully.</p>';
                    echo '<p><a href="index.php">Home</a> | <a href="register-view-users.php">User List</a></p>';
                } else {
                    echo '<p>Contact the administrator for assistance.</p>';
                }
            } else {
                echo '<p>Record was not deleted. Go back to <a href="register-view-users.php">user list</a>.</p>';
            }
        } else {
            $q = "SELECT CONCAT(first_name, ' ', last_name) FROM users WHERE user_id = $id";
            $result = @mysqli_query($dbcon, $q);
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_NUM);
                echo "<h3>Are you sure you want to delete $row[0]?</h3>";
                echo '
                <form action="delete-user.php" method="post">
                    <input class="btn small-btn" type="submit" name="sure" value="yes">
                    <input class="btn small-btn" type="submit" name="sure" value="no">
                    <input type="hidden" name="id" value="' . $id . '">
                </form>
                ';
            } else {
                echo '<h3>User not found. Register <a href="register-page.php">here</a>.</h3>';
            }
        }
        mysqli_close($dbcon);
        ?>
    </div>
</section>

<?php include('footer.php'); ?>
