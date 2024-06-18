<?php
class Order
{
  private $conn;
  private $table_name = "orders";

  public $id;
  public $product_id;
  public $user_name;
  public $user_email;
  public $user_phone;
  public $order_date;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function read()
  {
    $query = "SELECT * FROM " . $this->table_name;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  public function create()
  {
    $query = "INSERT INTO " . $this->table_name . " (product_id, user_name, user_email, user_phone) VALUES (:product_id, :user_name, :user_email, :user_phone)";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":product_id", $this->product_id);
    $stmt->bindParam(":user_name", $this->user_name);
    $stmt->bindParam(":user_email", $this->user_email);
    $stmt->bindParam(":user_phone", $this->user_phone);

    return $stmt->execute();
  }
}
