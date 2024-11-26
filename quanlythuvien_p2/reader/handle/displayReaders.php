<h1>Readers list</h1>
<table border="1">
    <thead>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Email</th>
            <th>Adress</th>
            <th>Phone</th>
            <th>Image</th>
        </tr>
    </thead>

    <tbody>
        <?php
        try {
            require_once(dirname(dirname(__DIR__)) . "/database/database.php");
            $conn = getDatabaseConnection();
            $stmt = $conn->prepare("SELECT * FROM students ");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $code = $row["student_number"];
                $name = $row["student_name"];
                $email = $row["email"];
                $address = $row["st_address"];
                $phone = $row["phone"];


                echo "<tr>
                <td>$code</td>
                <td>$name</td>
                <td>$email</td>
                <td>$address</td>
                <td>$phone</td>
                <td>  <a href='index.php?action=get_edit_form_reader&reader_code=$code'>update</a></td>
                <td>  <a href='reader/handle/deleteReader.php?deleteId=$code'>delete</a></td>            
                </tr>";
            }
        } catch (Exception $e) {
            echo "An error occurred in displaycategory: " . $e->getMessage();
        }
        ?>


    </tbody>

</table>
<a href="index.php?action=get_form_add_Reader">Add new Reader</a>