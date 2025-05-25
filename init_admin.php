<?php
include './db/db.php'; // 경로 확인 필요: 현재 같은 디렉토리면 ./db.php

$username = 'admin';
$raw_password = 'admin123';
$password = password_hash($raw_password, PASSWORD_DEFAULT); // 안전하게 해시
$role = 'admin';

// 중복 방지용 기존 admin 제거 (있을 경우)
$connection->query("DELETE FROM users WHERE username = 'admin'");

// admin 계정 삽입
$stmt = $connection->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $password, $role);
$stmt->execute();

echo "✅ admin 계정 등록 완료 (비밀번호: admin123)";
?>
