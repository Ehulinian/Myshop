<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';
require '../../settings/config.php';

include_once '../config/Database.php';
include_once '../models/Order.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);

$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
  case 'POST':
    $data = json_decode(file_get_contents("php://input"), true);

    if (
      isset($data['product_id']) &&
      isset($data['user_name']) &&
      isset($data['user_email']) &&
      isset($data['user_phone'])
    ) {
      $order->product_id = htmlspecialchars(strip_tags($data['product_id']));
      $order->user_name = htmlspecialchars(strip_tags($data['user_name']));
      $order->user_email = htmlspecialchars(strip_tags($data['user_email']));
      $order->user_phone = htmlspecialchars(strip_tags($data['user_phone']));

      if ($order->create()) {
        if (sendOrderEmail($order->user_name, $order->user_email, $order->user_phone, $config)) {
          echo json_encode(['message' => 'Order placed successfully.']);
        } else {
          echo json_encode(['message' => 'Failed to send confirmation email.']);
        }
      } else {
        echo json_encode(['message' => 'Order placement failed.']);
      }
    } else {
      echo json_encode(['message' => 'Missing required fields.']);
    }
    break;

  case 'GET':
    $stmt = $order->read();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($orders);
    break;

  default:
    echo json_encode(['message' => 'Invalid request method.']);
    break;
}

function sendOrderEmail($name, $email, $phone, $config)
{
  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP();
    $mail->Host = $config['smtp_host'];
    $mail->SMTPAuth = true;
    $mail->Username = $config['smtp_username'];
    $mail->Password = $config['smtp_password'];
    $mail->SMTPSecure = $config['smtp_encryption'];
    $mail->Port = $config['smtp_port'];

    $mail->setFrom('noreply@example.com', 'Your Shop');
    $mail->addAddress($email, $name);

    $mail->isHTML(true);
    $mail->Subject = 'Your Order Confirmation';
    $mail->Body = "Dear $name,<br><br>Thank you for your order!<br><br>Order Details:<br>Name: $name<br>Email: $email<br>Phone: $phone<br><br>We will process your order shortly.";

    $mail->send();
    return true;
  } catch (Exception $e) {
    error_log('Mail error: ' . $mail->ErrorInfo);
    return false;
  }
}
