<table border="1" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th>name</th>
            <th>price</th>
            <th>des</th>
            <th>producer</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($products as $product) {
            $id = $product['id'];
            $name = $product['name'];
            $price = $product['price'];
            $des = $product['des'];
            $producer = $product['producer'];
            echo "
            <tr>
            <td> $name</td>
            <td> $price</td>
            <td>$des</td>
            <td>$producer</td>
            <td><a href='index.php?action=get_edit_form&id=$id'>update</a> <a href='index.php?action=delete&id=$id'>delete</a></td>
            </tr>
            ";
        }
        ?>
    </tbody>
</table>
<a href="index.php?action=get_add_form">add new product</a>