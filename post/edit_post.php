<?php
include '../db/db.php';
include '../auth/session.php';
include '../header.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // 수정할 게시글 ID를 가져옴
    $id = $_GET['id'];

    // 게시글 정보 조회
    $statement = $connection->prepare("SELECT title, content, user_id, is_private FROM posts WHERE id = ?");
    $statement->bind_param("i", $id);
    $statement->execute();
    $result = $statement->get_result();

    if ($row = $result->fetch_assoc()) {
        // 로그인된 id와 게시물의 id 비교 
        if ($_SESSION['user_id'] != $row['user_id'] && $_SESSION['role'] !== 'admin') {
            echo "권한 없음";
            exit;
        }

        $title = $row['title']; //게시물 내용 확인 
        $content = $row['content'];
    } else {
        echo "게시글 없음";
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') { //수정된 데이터 post
    // 수정된 데이터를 받아옴
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $is_private = isset($_POST['is_private']) ? 1 : 0;
    

    // 게시글 소유자 확인
    $check = $connection->prepare("SELECT user_id FROM posts WHERE id = ?"); //소유자 정보 확인 
    $check->bind_param("i", $id);
    $check->execute();
    $check->bind_result($author_id);
    $check->fetch();
    $check->close();

    if ($_SESSION['user_id'] != $author_id && $_SESSION['role'] !== 'admin') {
        echo "권한이 없음";
        exit;
    }

    // 수정 쿼리 실행
    $statement = $connection->prepare("UPDATE posts SET title = ?, content = ?, is_private = ? WHERE id = ?"); //게시물 수정 쿼리 
    $statement->bind_param("ssii", $title, $content, $is_private, $id);
    $statement->execute();

    header("Location: view_post.php?id=$id");
    exit;
}
?>

<!-- 게시글 수정 폼 -->
<h2>게시글 수정</h2>
<form method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
    제목: <input name="title" value="<?php echo htmlspecialchars($title); ?>" required><br>
    내용: <textarea name="content" required><?php echo htmlspecialchars($content); ?></textarea><br>
    <label>
        <input type="checkbox" name="is_private" <?php echo ($is_private ? 'checked' : ''); ?>>
        나만 보기
    </label><br>
    <button type="submit">수정 완료</button>
</form>
