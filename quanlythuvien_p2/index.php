<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>


<body>

    <?php include 'layout/header.php'; ?>

    <div class="container">
        <?php

        if ($_SERVER['REQUEST_METHOD'] == "GET") {

            if (isset($_GET["action"])) {

                switch ($_GET["action"]) {
                    case "get_form_add_categories":
                        include_once 'category/form/frmaddcategory.php';
                        break;
                    case "get_edit_form__categories":
                        include_once 'category/form/edit_fr_category.php';
                        break;
                    case "get_categories":
                        include_once 'category/handle/displaycategory.php';
                        break;
                    case 'get_readers':
                        include_once 'reader/handle/displayReaders.php';
                        break;
                    case 'get_form_add_Reader':
                        include_once 'reader/form/fr_add_reader.php';
                        break;
                    case 'get_edit_form_reader':

                        include_once 'reader/form/fr_edit_reader.php';
                        break;
                    case 'get_authors':
                        include_once 'author/handle/displayAuthors.php';
                        break;
                    case 'get_form_add_Author':
                        include_once 'author/form/fr_add_author.php';
                        break;
                    case 'get_edit_form_update_author':
                        include_once 'author/form/fr_edit_author.php';
                        break;
                    case 'get_books':
                        include_once 'book/handle/displayBook.php';
                        break;
                    case 'get_add_form_books':
                        include_once 'book/form/fr_add_book.php';
                        break;
                    case 'get_edit_form_update_book':
                        include_once 'book/form/fr_edit_book.php';
                        break;
                    case 'get_form_add_book':
                        include_once 'book/form/fr_add_book.php';
                        break;
                    default:
                        break;
                }
            } else {
                include_once 'book/handle/displayBook.php';
            }
        }
        ?>

    </div>


    <?php include 'layout/footer.php'; ?>


</body>

</html>