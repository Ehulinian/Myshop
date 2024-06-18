<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Place Order</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
  <link rel="stylesheet" href="../public/styles/formOrder.css">
</head>

<body>
  <section class="section">
    <div class="container">
      <h1 class="title">Place Order</h1>
      <nav class="menu">
        <ul class="menu-list">
          <li><a href="../index.php">Home</a></li>
          <li><a href="list_products.php">Product List</a></li>
          <li><a href="list_orders.php">Order List</a></li>
          <li><a href="add_product_form.php">Add Product</a></li>
        </ul>
      </nav>
      <form id="orderForm">
        <div class="field">
          <label class="label" for="product_id">Product:</label>
          <div class="control">
            <div class="select">
              <select id="product_id" name="product_id" required>
              </select>
            </div>
          </div>
        </div>
        <div class="field">
          <label class="label" for="user_name">Name:</label>
          <div class="control">
            <input class="input" type="text" id="user_name" name="user_name" required>
          </div>
        </div>
        <div class="field">
          <label class="label" for="user_email">Email:</label>
          <div class="control">
            <input class="input" type="email" id="user_email" name="user_email" required>
          </div>
        </div>
        <div class="field">
          <label class="label" for="user_phone">Phone:</label>
          <div class="control">
            <input class="input" type="text" id="user_phone" name="user_phone">
          </div>
        </div>
        <div class="field">
          <div class="control">
            <button class="button is-primary" type="submit">Place Order</button>
          </div>
        </div>
      </form>
      <script src="../public/scripts/submitForm.js"></script>
    </div>
  </section>
</body>

</html>