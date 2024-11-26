<?php

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (!empty($_GET["deleteId"])) {
        try {
            require_once(dirname(dirname(__DIR__)) . "/database/database.php");
            $conn = getDatabaseConnection();
            $stmt = $conn->prepare('DELETE FROM students WHERE student_number = :reader_id');
            $stmt->bindParam(':reader_id', $reader_id);
            $reader_id = trim($_GET["deleteId"]);

            $stmt->execute();
            echo "<script>
            alert('Xóa độc giả thành công');
            window.location.href = '../../index.php?action=get_readers';
            </script>";
            exit;
        } catch (Exception $e) {

            $err = $e->getMessage();
            echo "<script>
            alert('Lỗi: $err');
            window.location.href = '../../index.php?action=get_readers';
            </script>";
            exit;
        }
    } else {

        echo "<script>
        alert('Thiếu ID độc giả');
        window.location.href = '../../index.php';
        </script>";
        exit;
    }
}
