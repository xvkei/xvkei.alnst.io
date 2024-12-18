<?php
    session_start();
    if (!isset($_SESSION['user_level']) || ($_SESSION['user_level'] != 0)) {
        header("Location: login-page.php"); 
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Page</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'header-members.php'; ?>
    <?php include 'nav-members.php'; ?>

    <main>
        <section class="your-content">
            <h2>Your content</h2>
            <p>No content yet</p>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
