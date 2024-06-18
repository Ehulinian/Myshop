<?php
include_once '../config/Database.php';
include_once '../models/Product.php';

class ProductController
{
  private $db;
  private $product;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->getConnection();
    $this->product = new Product($this->db);
  }

  public function read()
  {
    $stmt = $this->product->read();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $products;
  }

  public function readOne($id)
  {
    $this->product->id = $id;
    $this->product->readOne();
    return $this->product;
  }

  public function create($name, $description, $price)
  {
    return $this->product->create($name, $description, $price);
  }

  public function update($id, $name, $description, $price)
  {
    return $this->product->update($id, $name, $description, $price);
  }

  public function delete($id)
  {
    $this->product->id = $id;
    return $this->product->delete();
  }
}
