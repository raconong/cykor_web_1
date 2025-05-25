<?php
include '../auth/session.php'; // 로그인 상태 확인
include '../db/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') { //post로 받아온 경우 
    $title = $_POST['title']; //제목
    $content = $_POST['content']; //내용
    $user_id = $_SESSION['user_id']; //작성자의 id
    $is_private = isset($_POST['is_private']) ? 1 : 0; // is_private 체크 

    $statement = $connection->prepare("INSERT INTO posts (title, content, user_id, is_private) VALUES (?, ?, ?, ?)");
    $statement->bind_param("ssii", $title, $content, $user_id, $is_private); //각각 문자열, 문자열, int 이다 
    $statement->execute(); //쿼리문 실행 
    //echo "게시글 등록 완료";
    header('Location: list_post.php');
    exit;
}

include '../header.php';
?>
<h2>글 작성</h2>
<form method="POST">
    제목: <input name="title" required><br> 
    내용: <textarea name="content" required></textarea><br>
    <label><input type="checkbox" name="is_private" value="1"> 나만 보기</label><br>
    <button type="submit">글 등록</button>
</form>
