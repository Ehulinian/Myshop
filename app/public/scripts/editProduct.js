const urlParams = new URLSearchParams(window.location.search)
const productId = urlParams.get('id')

fetch('../api/product.php?id=' + productId)
  .then(response => response.json())
  .then(product => {
    document.getElementById('id').value = product.id
    document.getElementById('name').value = product.name
    document.getElementById('description').value = product.description
    document.getElementById('price').value = product.price
  })

document.getElementById('editProductForm').addEventListener('submit', function (event) {
  event.preventDefault()
  const data = {
    id: document.getElementById('id').value,
    name: document.getElementById('name').value,
    description: document.getElementById('description').value,
    price: document.getElementById('price').value
  }
  fetch('../api/product.php', {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  })
    .then(response => response.json())
    .then(data => {
      alert(data.message)
      if (data.message === "Product updated successfully.") {
        window.location.href = 'list_products.php'
      }
    })
})