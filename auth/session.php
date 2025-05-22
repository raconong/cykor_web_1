<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "로그인 필요";
    exit;
}
?>
