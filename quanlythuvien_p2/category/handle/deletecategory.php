<?php


if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (!empty($_GET["deleteId"])) {
        try {
            require_once(dirname(dirname(__DIR__)) . "/database/database.php");
            $conn = getDatabaseConnection();
            $stmt = $conn->prepare('DELETE FROM categories WHERE category_id = :category_id');
            $stmt->bindParam(':category_id', $category_id);
            $stmt->execute();
            $category_id = trim($_GET["deleteId"]);
            $stmt->execute();

            echo "<script>
            alert('Xóa thành công');
            window.location.href = '../../index.php?action=get_categories';
        </script>";
            exit;
        } catch (Exception $e) {
            $err = $e->getMessage();
            echo "<script>
            alert('$err');
            window.location.href = '../../index.php';
        </script>";

            exit;
        }
    } else {
        echo "<script>
        alert('thiếu id');
        window.location.href = '../../index.php';
    </script>";
        exit;
    }
}
