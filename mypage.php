<?php
include 'auth/session.php';
include 'header.php'; 
?>

<h2>마이페이지</h2>
<p>안뇽안뇽 <?php echo htmlspecialchars($_SESSION['username']); ?> 님!</p>
<p><a href="/web1/auth/logout.php">로그아웃</a></p>
