<?php
include_once('models/productModels.php');
include_once('config/database.php');
class ProductControllerr
{
    private $models;
    public function __construct()
    {
        try {
            $this->models = new ProductModels(getDatabaseConnection());
        } catch (Exception $e) {

            throw new Exception("Không thể khởi tạo ProductModels: " . $e->getMessage());
        }
    }
    public function validateNotEmpty($filedname, &$value)
    {
        $value = trim($value);
        if (empty($value)) throw new Exception("$filedname can not empty");
    }

    public  function index()
    {
        try {
            $models = $this->models;
            $result = $models->selectAll();
            $products =  $result['data'];
            include_once('views/index.php');
        } catch (Exception $e) {
            header("Location: index.php?err=" . $e->getMessage());
            exit();
        }
    }
    public function AddProduct()
    {
        try {
            $fields = [
                'name' => $_POST['name'] ?? null,
                'price' => $_POST['price'] ?? null,
                'des' => $_POST['des'] ?? null,
                'producer' => $_POST['producer'] ?? null,
            ];
            foreach ($fields as $fieldName => $value) {
                $this->validateNotEmpty($fieldName, $value);
            }
            $this->models->name = $fields['name'];
            $this->models->price = $fields['price'];
            $this->models->des = $fields['des'];
            $this->models->producer = $fields['producer'];
            $respond = $this->models->create();
            header("Location: index.php?action=get_add_form&err=" . $respond['message']);
            exit();
        } catch (Exception $e) {
            header("Location: index.php?action=get_add_form&err=" . $e->getMessage());
            exit();
        }
    }
    public function UpdateProduct()
    {
        try {
            $fields = [
                'id' => $_POST['id'] ?? null,
                'name' => $_POST['name'] ?? null,
                'price' => $_POST['price'] ?? null,
                'des' => $_POST['des'] ?? null,
                'producer' => $_POST['producer'] ?? null,
            ];
            foreach ($fields as $fieldName => $value) {
                $this->validateNotEmpty($fieldName, $value);
            }
            $this->models->name = $fields['name'];
            $this->models->price = $fields['price'];
            $this->models->des = $fields['des'];
            $this->models->producer = $fields['producer'];
            $respond = $this->models->update($fields['id']);
            header("Location: index.php?action=get_add_form&err=" . $respond['message']);
            exit();
        } catch (Exception $e) {
            header("Location: index.php?action=get_add_form&err=" . $e->getMessage());
            exit();
        }
    }
    public function DeleteProduct()
    {
        try {
            $id = $_GET['id'];
            $this->validateNotEmpty('id', $id);
            $respond = $this->models->delete($id);
            $mess = $respond['message'];
            echo "<script>
            alert('$mess');
            window.location.href = 'index.php';
        </script>";
        } catch (Exception $e) {
            $mess = $e->getMessage();
            echo "<script>
            alert('$mess');
            window.location.href = 'index.php';
        </script>";
        }
    }
    public function get_add_form()
    {
        include_once('views/add_form.php');
    }
    public function get_edit_form()
    {
        try {
            $id = $_GET['id'];
            $this->validateNotEmpty('id', $id);
            $respond = $this->models->selectOne($id);
            $product = $respond['data'];
            include_once('views/edit_form.php');
        } catch (Exception $e) {
            header("Location: index.php?action=get_edit_form&id=$id&err=" . $e->getMessage());
            exit();
        }
    }
}
