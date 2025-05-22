<?php
include 'db.php';
include 'session.php'; // 로그인 상태 확인

$id = $_GET['id']; //문서 번호를 가져온다다

$statement = $connection->prepare("SELECT posts.title, posts.content, posts.created_at, posts.user_id, users.username
                              FROM posts
                              JOIN users ON posts.user_id = users.id
                              WHERE posts.id = ?"); //게시글, 작성자 
$statement->bind_param("i", $id); //게시물 id 바인딩 
$statement->execute(); //sql 쿼리 실행 
$result = $statement->get_result();

if ($row = $result->fetch_assoc())://실행 결과가 존재하는 경우 row에 정보 저장 
?>
    <h2><?php echo htmlspecialchars($row['title']); ?></h2> <!-- 특수문자 escape 처리 -->
    <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
    <p><strong>작성자:</strong> <?php echo htmlspecialchars($row['username']); ?></p>
    <p><small><?php echo $row['created_at']; ?></small></p>

    <!-- 로그인한 사용자와 글 작성자가 같을 때만 수정/삭제 버튼 표시 -->
    <?php if ($_SESSION['user_id'] == $row['user_id']): ?> 
        <form action="edit_post.php" method="GET" style="display:inline;">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit">수정</button>
        </form>

        <form action="delete_post.php" method="POST" style="display:inline;" onsubmit="return confirm('정말 삭제하시겠습니까?');">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit">삭제</button>
        </form>
    <?php endif; ?>
<?php else: ?>
    <p>게시글을 찾을 수 없습니다</p>
<?php endif; ?>
