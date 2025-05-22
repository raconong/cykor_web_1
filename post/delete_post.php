<?php
include '../db/db.php';
include '../auth/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['id']; //문서 데이터 받아오기 

    // 게시글 소유자 확인 (보안)
    $check = $connection->prepare("SELECT user_id FROM posts WHERE id = ?"); //게시글의 user id 받아오기 
    $check->bind_param("i", $post_id);
    $check->execute();
    $check->bind_result($author_id);
    $check->fetch();
    $check->close();

    if ($_SESSION['user_id'] == $author_id) { //본인 글일 경우 삭제 수행 
        $stmt = $connection->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        echo "게시글 삭제 ";
    } else {
        echo "권한 없음";
    }
}
?>
<a href="list_post.php">게시글 목록으로 돌아가기</a>
