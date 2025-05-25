<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
include '../db/db.php'; // DB 연결

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //post를 통해서 데이터를 받아온 경우
    $username = $_POST['username'];
    $password = $_POST['password'];

    $statement = $connection->prepare("SELECT id, password, role FROM users WHERE username = ?"); //쿼리문 준비 
    $statement->bind_param("s", $username); //username 정보 문자열로 저장장
    $statement->execute(); //쿼리문 실행 
    $statement->store_result(); //실행결과 저장 

    if ($statement->num_rows === 1) { //해당 사용자가 1명 존재하는 경우 로그인 절차 확인 
        $statement->bind_result($id, $hashedPassword, $role); //위의 select 결과를 저장 
        $statement->fetch();

        if (password_verify($password, $hashedPassword)) { //비밀번호 비교 
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            header('Location: ../post/list_post.php');
            exit;
        } else {
            echo "비밀번호가 틀림";
        }
    } else {
        echo "사용자 없음";
    }
}
?>


<?php include '../header.php'; ?>

<!-- 로그인 폼 -->
<form method="POST">
    사용자명: <input name="username" required><br>
    비밀번호: <input type="password" name="password" required><br>
    <button type="submit">로그인</button>
</form>
