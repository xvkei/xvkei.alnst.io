<?php
$dbcon = @mysqli_connect('localhost', 'myahiya', 'myahiya', 'members_yahiya')
OR die('Could not connect to MySQL: ' . mysqli_connect_error());
mysqli_set_charset($dbcon, 'utf8');
?>
