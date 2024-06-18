function fetchProducts() {
  fetch('../api/product.php')
    .then(response => response.json())
    .then(products => {
      const tableBody = document.getElementById('productsTable')
      tableBody.innerHTML = ''
      products.forEach(product => {
        const row = tableBody.insertRow()
        row.insertCell(0).innerText = product.id
        row.insertCell(1).innerText = product.name
        row.insertCell(2).innerText = product.description
        row.insertCell(3).innerText = product.price
        const actionsCell = row.insertCell(4)
        const editButton = document.createElement('a')
        editButton.href = `edit_product_form.php?id=${product.id}`
        editButton.classList.add('button', 'is-small', 'is-info')
        editButton.innerText = 'Edit'
        actionsCell.appendChild(editButton)
        const deleteButton = document.createElement('button')
        deleteButton.classList.add('button', 'is-small', 'is-danger')
        deleteButton.innerText = 'Delete'
        deleteButton.onclick = function () {
          if (confirm('Are you sure you want to delete this product?')) {
            fetch(`../api/product.php?id=${product.id}`, {
              method: 'DELETE'
            })
              .then(response => response.json())
              .then(data => {
                alert(data.message)
                fetchProducts()
              })
          }
        }
        actionsCell.appendChild(deleteButton)
      })
    })
}

window.onload = fetchProducts