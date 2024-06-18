<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product List</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
  <link rel="stylesheet" href="../public/styles/listProducts.css">
</head>

<body>
  <section class="section">
    <div class="container">
      <h1 class="title">Product List</h1>
      <nav class="menu">
        <ul class="menu-list">
          <li><a href="../index.php">Home</a></li>
          <li><a href="add_product_form.php">Add Product</a></li>
          <li><a href="list_orders.php">Order List</a></li>
          <li><a href="order_form.php">Place Order</a></li>
        </ul>
      </nav>
      <table class="table is-fullwidth is-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="productsTable">
        </tbody>
      </table>
      <script src="../public/scripts/productList.js"></script>
    </div>
  </section>
</body>

</html>