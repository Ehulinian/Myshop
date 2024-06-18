<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Product</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
  <link rel="stylesheet" href="../public/styles/editProductForm.css">
</head>

<body>
  <section class="section">
    <div class="container">
      <h1 class="title">Edit Product</h1>
      <nav class="menu">
        <ul class="menu-list">
          <li><a href="../index.php">Home</a></li>
          <li><a href="list_products.php">Product List</a></li>
          <li><a href="list_orders.php">Order List</a></li>
          <li><a href="order_form.php">Place Order</a></li>
        </ul>
      </nav>
      <form id="editProductForm">
        <input type="hidden" id="id" name="id">

        <div class="field">
          <label class="label" for="name">Name:</label>
          <div class="control">
            <input class="input" type="text" id="name" name="name" required>
          </div>
        </div>
        <div class="field">
          <label class="label" for="description">Description:</label>
          <div class="control">
            <textarea class="textarea" id="description" name="description" required></textarea>
          </div>
        </div>
        <div class="field">
          <label class="label" for="price">Price:</label>
          <div class="control">
            <input class="input" type="text" id="price" name="price" required>
          </div>
        </div>
        <div class="field">
          <div class="control">
            <button class="button is-primary" type="submit">Edit Product</button>
          </div>
        </div>
      </form>
      <script src="../public/scripts/editProduct.js"></script>
    </div>
  </section>
</body>

</html>