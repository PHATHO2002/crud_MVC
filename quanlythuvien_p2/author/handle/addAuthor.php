<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $author_code = trim($_POST["author_code"] ?? '');
    $author_name = trim($_POST["author_name"] ?? '');
    $author_des = trim($_POST["author_des"] ?? '');
    $author_image = trim($_POST["author_image"] ?? '');


    if (empty($author_code) || empty($author_name) || empty($author_des)) {
        header("Location: ../../index.php?action=get_form_add_Author&err=Thiếu dữ liệu");
        exit;
    }
    try {
        require_once(dirname(dirname(__DIR__)) . "/database/database.php");
        $conn = getDatabaseConnection();

        $stmt = $conn->prepare('INSERT INTO authors (author_code, author_name, author_des, author_image) VALUES (:author_code, :author_name, :author_des, :author_image)');

        $stmt->execute([
            ':author_code' => $author_code,
            ':author_name' => $author_name,
            ':author_des' => $author_des,
            ':author_image' => $author_image,
        ]);

        header("Location: ../../index.php?action=get_form_add_Author&err=Thêm tác giả thành công");
        exit;
    } catch (Exception $e) {
        $err = $e->getMessage();
        header("Location: ../../index.php?action=get_form_add_Author&err=$err");
        exit;
    }
}
