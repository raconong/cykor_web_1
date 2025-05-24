<?php
include '../auth/session.php';  // 로그인 확인
include '../db/db.php';         // DB 연결
include '../header.php';        // 공통 헤더
?>

<?php

// 게시글 + 작성자 이름을 가져오는 쿼리
//게시물 id,제목, 내용, 생성 시간등 표시 
$sql = "SELECT posts.id, posts.title, posts.content, posts.created_at, users.username  
        FROM posts
        JOIN users ON posts.user_id = users.id 
        ORDER BY posts.created_at DESC";

//게시글의 작성자 id와 실재 user_id가 같은 행만 가져옴
//작성 시간순 내림차순 

$result = $connection->query($sql); //쿼리문 전송 및 저장 
?>

<h2>게시글 목록</h2>

<?php if ($result->num_rows > 0): ?>  <!-- 게시물이 존재하는 경우 -->
    <?php while ($row = $result->fetch_assoc()): ?> <!-- 전체 게시물을 반복하며 내용 출력 -->
        <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
            <h3>
                <a href="view_post.php?id=<?php echo $row['id']; ?>">
                    <?php echo htmlspecialchars($row['title']); ?>
                </a>
            </h3>
            <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
            <p><strong>작성자:</strong> <?php echo htmlspecialchars($row['username']); ?></p>
            <p><small><?php echo $row['created_at']; ?></small></p>
        </div> <!-- content의 내용을 html 테그 방지, nlbr로 줄바꿈 표시 -->
    <?php endwhile; ?>
<?php else: ?>
    <p>게시글이 없습니다.</p>
<?php endif; ?>
