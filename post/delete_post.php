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

      if ($_SESSION['user_id'] == $author_id || $_SESSION['role'] === 'admin') {
        $statement = $connection->prepare("DELETE FROM posts WHERE id = ?");
        $statement->bind_param("i", $post_id);
        $statement->execute();
    }

    header('Location: list_post.php');
    exit;
}
?>

