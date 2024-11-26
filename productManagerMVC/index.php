<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include_once('controller/productController.php');
    $prdController = new ProductControllerr();
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if (isset($_GET["action"])) {
            switch ($_GET["action"]) {
                case "get_add_form":
                    $prdController->get_add_form();
                    break;
                case "get_edit_form":
                    $prdController->get_edit_form();
                    break;
                case 'delete':
                    $prdController->DeleteProduct();
                    break;
            }
        } else {
            $prdController->index();
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST["action"])) {
            switch ($_POST["action"]) {
                case "add":
                    $prdController->AddProduct();
                    break;
                case "update":
                    $prdController->UpdateProduct();
                    break;
                default:
                    break;
            }
        }
    }
    ?>
</body>

</html>