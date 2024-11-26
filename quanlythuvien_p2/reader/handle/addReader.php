<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $student_number = trim($_POST["reader_code"] ?? '');
    $student_name = trim($_POST["reader_name"] ?? '');
    $st_address = trim($_POST["reader_address"] ?? '');
    $email = trim($_POST["reader_email"] ?? '');
    $phone = trim($_POST["reader_phone"] ?? '');


    if (empty($student_number) || empty($student_name) || empty($st_address) || empty($email) || empty($phone)) {
        header("Location: ../../index.php?action=get_form_add_Reader&err=thiếu dữ liệu");
        exit;
    }
    try {
        require_once(dirname(dirname(__DIR__)) . "/database/database.php");
        $conn = getDatabaseConnection();
        $stmt = $conn->prepare('INSERT INTO students (student_number,student_name,dayOfBirth,st_address,email,phone) values (:student_number,:student_name,:dayOfBirth,:st_address,:email,:phone)');

        $stmt->execute([
            ':student_number' => $student_number,
            ':student_name' => $student_name,
            ':dayOfBirth' => $dayOfBirth ?? null,
            ':st_address' => $st_address,
            ':email' => $email,
            ':phone' => $phone,
        ]);
        header("Location: ../../index.php?action=get_form_add_Reader&err=thêm thành công");
        exit;
    } catch (Exception $e) {
        $err = $e->getMessage();
        header("Location: ../../index.php?action=get_form_add_Reader&err=$err");
        exit;
    }
}
