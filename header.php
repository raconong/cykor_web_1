<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<?php if (isset($_SESSION['user_id'])): ?>
    <nav>
        <a href="/post/list_post.php">게시글 목록</a> |
        <a href="/post/create_post.php">글 작성</a> |
        <a href="/mypage.php">마이페이지</a> |
        <a href="/auth/logout.php">로그아웃</a>
    </nav>
    <hr>
<?php endif; ?>
