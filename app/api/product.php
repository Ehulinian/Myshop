<?php
include_once '../config/Database.php';
include_once '../models/Product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
  case 'POST':
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data['name']) && isset($data['description']) && isset($data['price'])) {
      if ($product->create($data['name'], $data['description'], $data['price'])) {
        echo json_encode(['message' => 'Product created successfully.']);
      } else {
        echo json_encode(['message' => 'Product creation failed.']);
      }
    } else {
      echo json_encode(['message' => 'Missing required fields.']);
    }
    break;

  case 'GET':
    if (isset($_GET['id'])) {
      $product->id = $_GET['id'];
      $product->readOne();
      echo json_encode(['id' => $product->id, 'name' => $product->name, 'description' => $product->description, 'price' => $product->price]);
    } else {
      $stmt = $product->read();
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($products);
    }
    break;

  case 'PUT':
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data['id']) && isset($data['name']) && isset($data['description']) && isset($data['price'])) {
      if ($product->update($data['id'], $data['name'], $data['description'], $data['price'])) {
        echo json_encode(['message' => 'Product updated successfully.']);
      } else {
        echo json_encode(['message' => 'Product update failed.']);
      }
    } else {
      echo json_encode(['message' => 'Missing required fields.']);
    }
    break;

  case 'DELETE':
    if (isset($_GET['id'])) {
      $product->id = $_GET['id'];
      if ($product->delete()) {
        echo json_encode(['message' => 'Product deleted successfully.']);
      } else {
        echo json_encode(['message' => 'Product deletion failed.']);
      }
    } else {
      echo json_encode(['message' => 'Missing required fields.']);
    }
    break;

  default:
    echo json_encode(['message' => 'Invalid request method.']);
    break;
}
