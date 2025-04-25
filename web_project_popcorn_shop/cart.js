document.addEventListener("DOMContentLoaded", () => {
    loadCartItems()
  })
  
  function loadCartItems() {
    const cartItemsContainer = document.getElementById("cart-items")
    const totalPriceElement = document.getElementById("total-price")
    const payButton = document.getElementById("pay-button")
  
    const cart = JSON.parse(localStorage.getItem("cart")) || []
  
    cartItemsContainer.innerHTML = ""
  
    if (cart.length === 0) {
      cartItemsContainer.innerHTML =
        '<p class="empty-cart-message">Your cart is empty. Go to the <a href="menu.php">menu</a> to add items.</p>'
      totalPriceElement.textContent = "Total: ₹0"
      payButton.disabled = true
      return
    }
  
    payButton.disabled = false
  
    let totalPrice = 0
  
    cart.forEach((item, index) => {
      const itemTotal = item.price * item.quantity
      totalPrice += itemTotal
  
      const cartItemElement = document.createElement("div")
      cartItemElement.className = "cart-item"
      cartItemElement.innerHTML = `
              <div class="cart-item-details">
                  <span class="cart-item-name">${item.item}</span>
                  <span class="cart-item-price">₹${item.price}</span>
              </div>
              <div class="cart-item-quantity">
                  <button class="quantity-btn" onclick="decreaseQuantity(${index})">-</button>
                  <span>${item.quantity}</span>
                  <button class="quantity-btn" onclick="increaseQuantity(${index})">+</button>
                  <button class="cart-item-remove" onclick="removeItem(${index})">×</button>
              </div>
          `
  
      cartItemsContainer.appendChild(cartItemElement)
    })
  
    totalPriceElement.textContent = `Total: ₹${totalPrice}`
  }
  
  function increaseQuantity(index) {
    const cart = JSON.parse(localStorage.getItem("cart")) || []
    cart[index].quantity += 1
    localStorage.setItem("cart", JSON.stringify(cart))
    loadCartItems()
  }
  
  function decreaseQuantity(index) {
    const cart = JSON.parse(localStorage.getItem("cart")) || []
    if (cart[index].quantity > 1) {
      cart[index].quantity -= 1
      localStorage.setItem("cart", JSON.stringify(cart))
    } else {
      removeItem(index)
    }
    loadCartItems()
  }
  
  function removeItem(index) {
    const cart = JSON.parse(localStorage.getItem("cart")) || []
    cart.splice(index, 1)
    localStorage.setItem("cart", JSON.stringify(cart))
    loadCartItems()
  }
  
  function clearCart() {
    if (confirm("Are you sure you want to clear your cart?")) {
      localStorage.removeItem("cart")
      loadCartItems()
    }
  }
  