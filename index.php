<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: post/list_post.php');
    exit;
} else {
    echo '<a href="auth/login.php">로그인</a> | <a href="auth/register.php">회원가입</a>';
}
?>