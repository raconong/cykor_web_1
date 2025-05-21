<?php
session_start();            // 기존 세션 불러오기
session_unset();            // 모든 세션 변수 제거
session_destroy();          // 세션 파괴

// 로그아웃 후 메시지 출력 또는 리디렉션
echo "로그아웃 됨 <a href='login.php'>다시 로그인</a>";
?>
