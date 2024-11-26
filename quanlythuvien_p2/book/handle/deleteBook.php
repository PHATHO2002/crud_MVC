<?php

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (!empty($_GET["deleteId"])) {
        try {
            require_once(dirname(dirname(__DIR__)) . "/database/database.php");
            $conn = getDatabaseConnection();
            $stmt = $conn->prepare('DELETE FROM books WHERE book_id = :book_id');
            $stmt->bindParam(':book_id', $book_id);
            $book_id = trim($_GET["deleteId"]);

            $stmt->execute();

            echo "<script>
            alert('Xóa sách thành công');
            window.location.href = '../../index.php?action=get_books';
            </script>";
            exit;
        } catch (Exception $e) {

            $err = $e->getMessage();
            echo "<script>
            alert('Lỗi: $err');
            window.location.href = '../../index.php';
            </script>";
            exit;
        }
    } else {

        echo "<script>
        alert('Thiếu ID sách');
        window.location.href = '../../index.php';
        </script>";
        exit;
    }
}
