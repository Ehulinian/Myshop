document.getElementById('addProductForm').addEventListener('submit', function (event) {
  event.preventDefault()
  const data = {
    name: document.getElementById('name').value,
    description: document.getElementById('description').value,
    price: document.getElementById('price').value
  }

  fetch('../api/product.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  })
    .then(response => response.json())
    .then(data => {
      alert(data.message)

      if (data.message === "Product created successfully.") {
        window.location.href = 'list_products.php'
      }
    })
    .catch(error => {
      console.error('Error:', error)
    })
})
