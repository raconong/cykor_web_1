<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "로그인이 필요합니다.";
    exit;
}
?>
