<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: post/list_post.php'); // ← 정확한 경로로 수정
    exit;
} else {
    echo '<a href="auth/login.php">로그인</a> | <a href="auth/register.php">회원가입</a>';
}
?>