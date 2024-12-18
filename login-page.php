<?php include('header-index.php'); ?>
<?php include('nav-index.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css"> 
</head>
<body>
    <center>
        <div id="content">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                require('mysqli_connect.php'); // Database connection

                // Initialize variables
                $e = $p = '';

                // Validate email
                if (empty($_POST['email'])) {
                    echo '<p class="error">Please input your email address.</p>';
                } else {
                    $e = mysqli_real_escape_string($dbcon, trim($_POST['email']));
                }

                // Validate password
                if (empty($_POST['psword'])) {
                    echo '<p class="error">Please input your password.</p>';
                } else {
                    $p = mysqli_real_escape_string($dbcon, trim($_POST['psword']));
                }

                $q = "SELECT user_id, first_name, user_level, psword FROM users WHERE email = '$e'";
                $result = @mysqli_query($dbcon, $q);
                
                if (@mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    if (password_verify($p, $row['psword'])) {
                        // if password ay pareho, start the session
                        session_start();
                        $_SESSION = $row;
                        $_SESSION['user_level'] = (int) $_SESSION['user_level'];
                
                        $url = ($_SESSION['user_level'] === 1) ? 'admin-page.php' : 'members-page.php';
                        mysqli_free_result($result);
                        mysqli_close($dbcon);
                
                        header('Location: ' . $url);
                        exit();
                    } else {
                        echo '<p class="error">Invalid email or password. Please try again.</p>';
                    }
                } else {
                    echo '<p class="error">Invalid email or password. Please try again.</p>';
                }
                

                // Close the database connection
                mysqli_close($dbcon);
            }
            ?>
        </div>
    </center>
    <div class="form-wrapper">
        <div class="form-container">
            <h2>Login</h2>
            <form id="loginForm" action="login-page.php" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="psword">Password:</label>
                    <input type="password" id="psword" name="psword" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Yahiya. All rights reserved.</p>
    </footer>
</body>
</html>
