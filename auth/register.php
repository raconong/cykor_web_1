<?php
include '../db/db.php'; // db.php를 통해 접속
include '../header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //사용자가 <form method="POST">로 요청을 보낸 경우 데이터 저장장
    $username = $_POST['username']; //사용자 입력 받아오기 
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // 비밀번호 해시화

    // 중복 사용자 확인
    $check = $connection->prepare("SELECT id FROM users WHERE username = ?"); //? 부분에 username을 넣을 예정이다 
    $check->bind_param("s", $username); //문자열이 ?자리에 들어간다 => username요소를 binding
    $check->execute(); //쿼리 실행 
    $check->store_result(); //쿼리 결과를 저장 

    if ($check->num_rows > 0) { //이미 해당 요소가 존재하는 경우(찾은 개수가 0보다 클때)
        echo "이미 존재하는 사용자";
    } else {
        // 새 사용자 등록
        $statement = $connection->prepare("INSERT INTO users (username, password) VALUES (?, ?)"); //DB에 저장하기 위한 쿼리문 준비 
        $statement->bind_param("ss", $username, $password);//모두 문자열로 binding
        $statement->execute();//쿼리문 실행
        echo "회원가입 완료";
    }
}
?>

<!-- 회원가입 폼 -->
<h2>회원가입</h2>
<form method="POST">
    사용자명: <input name="username" required><br>
    비밀번호: <input type="password" name="password" required><br>
    <button type="submit">회원가입</button>
</form>
