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
<body>
		<div class="container">
					
			<div class="card">
				<div class="imgBx">
					<a href="#">
					<img src="sua.jpg">
					</a>
				
					<h2>Sua</h2>
					<p><br>One of the first two participants to be introduced in Round 1, singing the song "MY CLEMATIS" alongside Mizi 
					</p>
					
				</div>
			</div>
		
			<div class="card">
				<div class="imgBx">
					<a href="#">
					<img src="mizi.jpg">
					</a>
					<h2>Mizi</h2>
					<p><br>One of the first two contestants to appear in Round 1, where she performed a duet with Sua, performing "MY CLEMATIS". 
					</p>					

				</div>	
			</div>	
			
            <div class="card">
				<div class="imgBx">
					<a href="#">
					<img src="hyuna.jpg">
					</a>
					<h2>Hyuna</h2>
					<p><br>The third participant introduced in ALIEN STAGE: Prologue. His song, "Unknown (Till The End...)", shows his complex past.
					</p>
				</div>	
			</div>	

            <div class="card">
				<div class="imgBx">
					<a href="#">
					<img src="ivan.jpg">
					</a>
					<h2>Ivan</h2>
					<p><br>The third participant introduced in ALIEN STAGE: Prologue. His song, "Unknown (Till The End...)", shows his complex past.
					</p>
				</div>	
			</div>	

			<div class="card">
				<div class="imgBx">
					<a href="#">
					<img src="till.jpg">
					</a>
					<h2>Till</h2>
					<p><br>The third participant introduced in ALIEN STAGE: Prologue. His song, "Unknown (Till The End...)", shows his complex past.
					</p>
				</div>	
			</div>	

            <div class="card">
				<div class="imgBx">
					<a href="#">
					<img src="luka.png">
					</a>
					<h2>Luka</h2>
					<p><br>The third participant introduced in ALIEN STAGE: Prologue. His song, "Unknown (Till The End...)", shows his complex past.
					</p>
				</div>	
			</div>	

		</div>	
 
 		

 
 </body>
 </html>