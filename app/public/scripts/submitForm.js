function fetchProducts() {
  fetch('../api/product.php')
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok')
      }
      return response.json()
    })
    .then(products => {
      const productSelect = document.getElementById('product_id')
      products.forEach(product => {
        const option = document.createElement('option')
        option.value = product.id
        option.innerText = `${product.name} - $${product.price}`
        productSelect.appendChild(option)
      })
    })
    .catch(error => {
      console.error('Error fetching products:', error)
      alert('Error fetching products. Please try again later.')
    })
}

document.addEventListener('DOMContentLoaded', function () {
  fetchProducts()

  document.getElementById('orderForm').addEventListener('submit', function (event) {
    event.preventDefault()

    const data = {
      product_id: document.getElementById('product_id').value,
      user_name: document.getElementById('user_name').value,
      user_email: document.getElementById('user_email').value,
      user_phone: document.getElementById('user_phone').value
    }

    fetch('../api/order.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok')
        }
        return response.json()
      })
      .then(responseData => {
        alert(responseData.message)
        if (responseData.message === "Order placed successfully.") {
          window.location.href = 'list_orders.php'
        }
      })
      .catch(error => {
        console.error('Error placing order:', error)
        alert('Error placing order. Please try again later.')
      })
  })
})
