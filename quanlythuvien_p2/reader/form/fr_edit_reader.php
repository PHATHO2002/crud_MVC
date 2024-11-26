<?php
if (isset($_GET['reader_code'])) {

    try {
        require_once(dirname(dirname(__DIR__)) . "/database/database.php");
        $conn = getDatabaseConnection();
        $reader_code = $_GET['reader_code'];
        $stmt = $conn->prepare("SELECT * FROM students WHERE student_number = :student_number");
        $stmt->execute([':student_number' => $reader_code]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        echo '
        <h1>update reader</h1>
        <form action="reader/handle/updateReader.php" method="POST">
            <div class="">
               
                <input name="reader_code"  style="display: none;" type="text" value="' . $row['student_number'] . '">
            </div>
            <div class="">
                <label for="reader_name"> reader name</label>
                <input name="reader_name" type="text"  value="' . $row['student_name'] . '" >
            </div>
            <div class="">
                <label for="reader_address">reader address</label>
                <input name="reader_address" type="text" value="' . $row['st_address'] . '">
            </div>
            <div class="">
                <label for="reader_email">reader email</label>
                <input name="reader_email" type="text" value="' . $row['email'] . '">
            </div>
            <div class="">
                <label for="reader_phone">reader phone</label>
                <input name="reader_phone" type="text" value="' . $row['phone'] . '">
            </div>
        
            <input type="submit" name="action" value="update">
        </form>
    ';
        if (isset($_GET['err'])) {
            $err = $_GET['err'];
            echo "<p>  $err</p>";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
