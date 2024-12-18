<?php
    session_start();
    if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] !=1)){
        header("Location: login-page.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'header-admin.php'; ?>
    <?php include 'nav-admin.php'; ?>

    <main>
        <section class="dashboard">
            <h2>Dashboard Content</h2>
            <p>This section is empty for now.</p>

            <!-- Add the picture -->
            <div class="dashboard-image">
                <img src="dashboard.jpg" alt="Admin Dashboard Image">
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
