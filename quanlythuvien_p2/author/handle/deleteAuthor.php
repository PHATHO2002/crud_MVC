<?php

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $author_code = trim($_GET["deleteId"] ?? '');
    if (empty($author_code)) {
        echo "<script>
        alert('Thiếu ID tác giả');
        window.location.href = '../../index.php?action=get_authors';
        </script>";
        exit;
    }

    try {

        require_once(dirname(dirname(__DIR__)) . "/database/database.php");
        $conn = getDatabaseConnection();
        $stmt = $conn->prepare('DELETE FROM authors WHERE author_code = :author_code');

        $stmt->bindParam(':author_code', $author_code);
        $stmt->execute();
        echo "<script>
        alert('Xóa tác giả thành công');
        window.location.href = '../../index.php?action=get_authors';
        </script>";
        exit;
    } catch (Exception $e) {

        $err = $e->getMessage();
        echo "<script>
        alert('Lỗi: $err');
        window.location.href = '../../index.php?action=get_authors';
        </script>";
        exit;
    }
}
