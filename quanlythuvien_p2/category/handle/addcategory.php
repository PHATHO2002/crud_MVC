<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST["category_name"])) {
        try {
            require_once(dirname(dirname(__DIR__)) . "/database/database.php");
            $conn = getDatabaseConnection();
            $stmt = $conn->prepare('INSERT INTO categories (category_name) values (:category_name)');

            $stmt->bindParam(':category_name', $category_name);

            $category_name = trim($_POST["category_name"]);

            $stmt->execute();
            header("Location: ../../index.php?action=get_form_add_categories&err=thêm thành công");
            exit;
        } catch (Exception $e) {
            $err = $e->getMessage();
            header("Location: ../../index.php?action=get_form_add_categories&err=$err");
            exit;
        }
    } else {
        header("Location: ../../index.php?action=get_form_add_categories&err=thiếu dữ liệu");
        exit;
    }
}
