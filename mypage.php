<?php
include 'session.php'; // 로그인 확인
?>

<h2>마이페이지</h2>
<p>안뇽안뇽<?php echo $_SESSION['username']; ?> 님!</p>
<p><a href="logout.php">로그아웃</a></p>
