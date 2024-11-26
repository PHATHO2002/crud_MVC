<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {


    $author_code = trim($_POST["author_code"] ?? '');
    $author_name = trim($_POST["author_name"] ?? '');
    $author_des = trim($_POST["author_des"] ?? '');
    $author_image = trim($_POST["author_image"] ?? '');


    if (empty($author_code) || empty($author_name) || empty($author_des)) {
        header("Location: ../../index.php?action=get_edit_form_author&author_code=$author_code&err=Thiếu dữ liệu");
        exit;
    }

    try {

        require_once(dirname(dirname(__DIR__)) . "/database/database.php");
        $conn = getDatabaseConnection();


        $stmt = $conn->prepare('UPDATE authors 
                                SET author_name = :author_name, 
                                    author_des = :author_des, 
                                    author_image = :author_image 
                                WHERE author_code = :author_code');


        $stmt->execute([
            ':author_code' => $author_code,
            ':author_name' => $author_name,
            ':author_des' => $author_des,
            ':author_image' => $author_image,
        ]);


        header("Location: ../../index.php?action=get_edit_form_update_author&updateCode=$author_code&err=Cập nhật thành công");
        exit;
    } catch (Exception $e) {

        $err = $e->getMessage();
        header("Location: ../../index.php?action=get_edit_form_update_author&updateCode=$author_code&err=$err");
        exit;
    }
}
