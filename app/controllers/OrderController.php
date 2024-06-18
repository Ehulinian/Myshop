<?php
include_once '../config/Database.php';
include_once '../models/Order.php';

class OrderController
{
  private $db;
  private $order;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->getConnection();
    $this->order = new Order($this->db);
  }

  public function read()
  {
    $stmt = $this->order->read();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $orders;
  }

  public function create($product_id, $user_name, $user_email, $user_phone)
  {
    $this->order->product_id = $product_id;
    $this->order->user_name = $user_name;
    $this->order->user_email = $user_email;
    $this->order->user_phone = $user_phone;
    return $this->order->create();
  }
}
