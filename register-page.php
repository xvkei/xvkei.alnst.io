<?php include('header-index.php'); ?>
<?php include('nav-index.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css"> 
</head>
<body>
    <main>
        <div class="form-wrapper">
            <div class="form-container">
                <h2>Register</h2>
                <?php
                require('mysqli_connect.php'); // Database connection

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $errors = array(); // Initialize an error array.

                    // Validate first name
                    if (empty($_POST['fname'])) {
                        $errors[] = 'Please enter your first name.';
                    } else {
                        $fn = mysqli_real_escape_string($dbcon, trim($_POST['fname']));
                    }

                    // Validate last name
                    if (empty($_POST['lname'])) {
                        $errors[] = 'Please enter your last name.';
                    } else {
                        $ln = mysqli_real_escape_string($dbcon, trim($_POST['lname']));
                    }

                    // Validate email
                    if (empty($_POST['email'])) {
                        $errors[] = 'Please enter your email.';
                    } else {
                        $email = mysqli_real_escape_string($dbcon, trim($_POST['email']));

                        // Check if email already exists
                        $q = "SELECT user_id FROM users WHERE email = '$email'";
                        $result = @mysqli_query($dbcon, $q);

                        if (mysqli_num_rows($result) > 0) {
                            $errors[] = 'The email address is already registered. Please use a different email.';
                        }
                    }

                    // Validate password
                    if (!empty($_POST['psword1'])) {
                        if ($_POST['psword1'] != $_POST['psword2']) {
                            $errors[] = 'Your passwords do not match.';
                        } else {
                            $p = trim($_POST['psword1']);
                        }
                    } else {
                        $errors[] = 'Please enter your password.';
                    }

                    // Check if there are no errors
                    if (empty($errors)) {
                        // Hash the password
                        $hashed_password = password_hash($p, PASSWORD_DEFAULT);

                        // Query to insert user into the database
                        $q = "INSERT INTO users (first_name, last_name, email, psword, registration_date) 
                              VALUES ('$fn', '$ln', '$email', '$hashed_password', NOW())";

                        $result = @mysqli_query($dbcon, $q);

                        if ($result) {
                            // Redirect to login page after successful registration
                            header("Location: login-page.php");
                            exit();
                        } else {
                            echo '<h2>System Error</h2><p class="error">You could not be registered due to a system error. Please try again later.</p>';
                            echo '<p>' . mysqli_error($dbcon) . '</p>';
                        }

                        mysqli_close($dbcon);
                        include('footer.php');
                        exit();
                    } else {
                        // Display errors
                        echo '<div class="error-container">';
                        echo '<h2>Error!</h2><p class="error">The following errors occurred:<br>';
                        foreach ($errors as $msg) {
                            echo "→ $msg<br>";
                        }
                        echo '</p><h4>Please try again</h4>';
                        echo '</div><br/><br/>';
                    }
                }
                ?>
                <form id="registerForm" action="register-page.php" method="post">
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" id="first_name" name="fname" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" id="last_name" name="lname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="psword1" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirm">Re-type Password:</label>
                        <input type="password" id="password_confirm" name="psword2" required>
                    </div>
                    <button type="submit" class="btn">Register</button>
                </form>
            </div>
        </div>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>
