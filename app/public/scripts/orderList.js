function fetchOrders() {
  fetch('../api/order.php')
    .then(response => response.json())
    .then(orders => {
      const tableBody = document.getElementById('ordersTable')
      tableBody.innerHTML = ''
      orders.forEach(order => {
        const row = tableBody.insertRow()
        row.insertCell(0).innerText = order.id
        row.insertCell(1).innerText = order.product_id
        row.insertCell(2).innerText = order.user_name
        row.insertCell(3).innerText = order.user_email
        row.insertCell(4).innerText = order.user_phone
        row.insertCell(5).innerText = order.order_date
      })
    })
}

window.onload = fetchOrders