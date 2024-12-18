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
    <div class="form-container">
        <h1>Edit User Record</h1>
        <?php
        if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
            $id = $_GET['id'];
        } elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
            $id = $_POST['id'];
        } else {
            echo '<div class="error-container"><p>Invalid action. Go back to <a href="admin-page.php">home</a>.</p></div>';
            exit();
        }

        require('mysqli_connect.php');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $first_name = mysqli_real_escape_string($dbcon, trim($_POST['first_name']));
            $last_name = mysqli_real_escape_string($dbcon, trim($_POST['last_name']));
            $email = mysqli_real_escape_string($dbcon, trim($_POST['email']));

            if ($first_name && $last_name && $email) {
                $q = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email' WHERE user_id=$id";
                $result = @mysqli_query($dbcon, $q);
                if (mysqli_affected_rows($dbcon) == 1) {
                    echo '<p>Record updated successfully.</p>';
                    echo '<p><a href="admin-page.php">Home</a> | <a href="register-view-users.php">User List</a></p>';
                } else {
                    echo '<p class="error">Record update failed. Please try again.</p>';
                    echo '<p><a href="admin-page.php">Home</a> | <a href="register-view-users.php">User List</a></p>';
                }
            } else {
                echo '<p class="error">Please fill out all fields.</p>';
            }
        } else {
            $q = "SELECT first_name, last_name, email FROM users WHERE user_id=$id";
            $result = @mysqli_query($dbcon, $q);
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                echo '
                <form action="edit-user.php" method="post">
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" name="first_name" value="' . $row['first_name'] . '" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" name="last_name" value="' . $row['last_name'] . '" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" value="' . $row['email'] . '" required>
                    </div>
                    <input class="btn" type="submit" value="Update">
                    <input type="hidden" name="id" value="' . $id . '">
                </form>';
            } else {
                echo '<h3>User not found. Register <a href="register-page.php">here</a>.</h3>';
            }
        }
        mysqli_close($dbcon);
        ?>
    </div>
</section>

<?php include('footer.php'); ?>