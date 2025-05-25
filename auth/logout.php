<?php
session_start();       // 기존 세션 불러오기
session_unset();       // 세션 변수 모두 삭제
session_destroy();     // 세션 파괴

// 로그인 페이지로 리디렉션
header("Location: /index.php");
exit;
?>