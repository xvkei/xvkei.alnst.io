<?php
    session_start();
    if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] !=1)){
        header("Location: login-page.php");
        exit();
    }
?>
<?php include('header-admin.php'); ?>
<?php include('nav-admin.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Registered Users</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <section class="info">
        <center><h1>Registered Users</h1></center>

        <div class="table-container">
            <?php
            require("mysqli_connect.php");

            // Query to get data
            $q = "SELECT first_name, last_name, email, DATE_FORMAT(registration_date, '%M %d, %Y') AS regdat, user_id FROM users ORDER BY user_id ASC";
            $result = @mysqli_query($dbcon, $q);

            // If query is successful
            if ($result) {
                echo '<table class="user-table">
                        <tr>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>DATE REGISTERED</th>
                            <th colspan="2">ACTIONS</th>
                        </tr>';

                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo '<tr>
                            <td>' . $row['last_name'] . ', ' . $row['first_name'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['regdat'] . '</td>
                            <td><a href="edit-user.php?id=' . $row['user_id'] . '"><img src="edit.png" alt="Edit" width="20" height="20"></a></td>
                            <td><a href="delete-user.php?id=' . $row['user_id'] . '"><img src="delete.png" alt="Delete" width="20" height="20"></a></td>
                          </tr>';
                }

                echo '</table>';
            } else {
                echo '<p class="error">The current users could not be retrieved.</p>';
            }

            mysqli_close($dbcon);
            ?>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2024 Yahiya. All rights reserved.</p>
    </footer>
</body>
</html>
