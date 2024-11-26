<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["category_id"])) {
        $id = $_POST["category_id"];
        if (!empty($_POST["category_name"])) {
            try {
                require_once(dirname(dirname(__DIR__)) . "/database/database.php");
                $conn = getDatabaseConnection();
                $stmt = $conn->prepare('UPDATE categories SET category_name = :category_name WHERE category_id = :category_id');

                $stmt->bindParam(':category_name', $category_name);
                $stmt->bindParam(':category_id', $category_id);


                $category_name = trim($_POST["category_name"]);
                $category_id = trim($_POST["category_id"]);
                $stmt->execute();
                header("Location: ../../index.php?action=get_edit_form__categories&updateId=$category_id&err=update thành công");
                exit;
            } catch (Exception $e) {
                $err = $e->getMessage();
                header("Location: ../../index.php?action=get_edit_form__categories&updateId= $id&err=$$err");
                exit;
            }
        } else {

            header("Location: ../../index.php?action=get_edit_form&updateId=$id&err=thiếu dữ liệu");
            exit;
        }
    } else {
        header("Location: ../../index.php?action=get_edit_form&updateId= $id&err=thiếu id");
        exit;
    }
}
