<?php
class ProductModels
{
    public $name;
    public $price;
    public $des;
    public $producer;
    private $conn;
    private $table_name = "product";
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function selectAll()
    {
        try {
            $query =  "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return [
                'errCode' => 200,
                'message' => 'select all thành công',
                'data' => $result
            ];
        } catch (Exception $e) {
            return [
                'errCode' =>  500,
                'message' => "database $e",
                'data' => null
            ];
        }
    }
    public function selectOne($id)
    {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return [
                'errCode' => 200,
                'message' => 'select one thành công',
                'data' => $result
            ];
        } catch (Exception $e) {
            return [
                'errCode' => 500,
                'message' => "Lỗi database: $e",
                'data' => null
            ];
        }
    }

    public function create()
    {
        try {
            $query = "INSERT INTO  $this->table_name (name, price, des, producer) VALUES (:name, :price, :des, :producer)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':des', $this->des);
            $stmt->bindParam(':producer', $this->producer);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return [
                'errCode' => 200,
                'message' => 'create thành công',
                'data' => $result
            ];
        } catch (Exception $e) {
            return [
                'errCode' =>  500,
                'message' => "database $e",
                'data' => null
            ];
        }
    }
    public function update($id)
    {
        try {
            $query = "UPDATE $this->table_name 
                  SET name = :name, price = :price, des = :des, producer = :producer 
                  WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':des', $this->des);
            $stmt->bindParam(':producer', $this->producer);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return [
                'errCode' => 200,
                'message' => 'update thành công',
                'data' => null
            ];
        } catch (Exception $e) {
            return [
                'errCode' => 500,
                'message' => "Lỗi database: $e",
                'data' => null
            ];
        }
    }
    public function delete($id)
    {
        try {
            $query = "DELETE FROM $this->table_name WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return [
                'errCode' => 200,
                'message' => 'Xóa thành công',
                'data' => null
            ];
        } catch (Exception $e) {
            return [
                'errCode' => 500,
                'message' => "Lỗi database: $e",
                'data' => null
            ];
        }
    }
}
