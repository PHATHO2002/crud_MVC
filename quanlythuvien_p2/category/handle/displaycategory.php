<h1>Category list</h1>
<table border="1">
    <thead>
        <tr>
            <th>Code</th>
            <th>Category Name</th>
            <th>action</th>

        </tr>
    </thead>

    <tbody>
        <?php
        try {
            require_once(dirname(dirname(__DIR__)) . "/database/database.php");
            $conn = getDatabaseConnection();
            $stmt = $conn->prepare("SELECT * FROM categories ");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $id = $row["category_id"];
                $name = $row["category_name"];
                echo "<tr>
                <td>$id</td>
                <td>$name</td>
                <td>  <a href='index.php?action=get_edit_form__categories&updateId=$id'>update</a></td>
                <td>  <a href='category/handle/deletecategory.php?deleteId=$id'>delete</a></td>            
                </tr>";
            }
        } catch (Exception $e) {
            echo "An error occurred in displaycategory: " . $e->getMessage();
        }
        ?>


    </tbody>

</table>
<a href="index.php?action=get_form_add_categories">Add new category</a>