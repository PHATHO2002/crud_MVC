<h1>Authors list</h1>
<table border="1">
    <thead>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>des</th>
            <th>Image</th>
        </tr>
    </thead>

    <tbody>
        <?php
        try {
            require_once(dirname(dirname(__DIR__)) . "/database/database.php");
            $conn = getDatabaseConnection();
            $stmt = $conn->prepare("SELECT * FROM authors ");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $code = $row["author_code"];
                $name = $row["author_name"];
                $des = $row["author_des"];
                $image = $row["author_image"];


                echo "<tr>
                <td>$code</td>
                <td>$name</td>
                <td>$des</td>
                <td>$image</td>
                <td>  <a href='index.php?action=get_edit_form_update_author&updateCode=$code'>update</a></td>
                <td>  <a href='author/handle/deleteAuthor.php?deleteId=$code'>delete</a></td>            
                </tr>";
            }
        } catch (Exception $e) {
            echo "An error occurred in displaycategory: " . $e->getMessage();
        }
        ?>


    </tbody>

</table>
<a href="index.php?action=get_form_add_Author">Add new Author</a>