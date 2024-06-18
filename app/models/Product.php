<?php
class Product
{
  private $conn;
  private $table_name = "products";

  public $id;
  public $name;
  public $description;
  public $price;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function create($name, $description, $price)
  {
    $query = "INSERT INTO " . $this->table_name . " SET name=:name, description=:description, price=:price";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":price", $price);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  public function read()
  {
    $query = "SELECT * FROM " . $this->table_name;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  public function readOne()
  {
    $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->name = $row['name'];
    $this->description = $row['description'];
    $this->price = $row['price'];
  }

  public function update($id, $name, $description, $price)
  {
    $query = "UPDATE " . $this->table_name . " SET name = :name, description = :description, price = :price WHERE id = :id";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":price", $price);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  public function delete()
  {
    try {
      $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(1, $this->id);

      if ($stmt->execute()) {
        return true;
      }
      return false;
    } catch (PDOException $e) {
      if ($e->getCode() == 23000) {
        return false;
      }
      throw $e;
    }
  }
}
