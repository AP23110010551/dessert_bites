function addToCart(item, price) {
    const cart = JSON.parse(localStorage.getItem("cart")) || []
  
    const existingItemIndex = cart.findIndex((cartItem) => cartItem.item === item)
  
    if (existingItemIndex !== -1) {
      cart[existingItemIndex].quantity += 1
    } else {
      cart.push({ item, price, quantity: 1 })
    }
  
    localStorage.setItem("cart", JSON.stringify(cart))
  
    showNotification(`${item} added to cart!`)
  }
  
  function showNotification(message) {
    const notification = document.createElement("div")
    notification.className = "notification"
    notification.textContent = message
  
    document.body.appendChild(notification)
  
    setTimeout(() => {
      notification.classList.add("show")
    }, 10)
  
    setTimeout(() => {
      notification.classList.remove("show")
      setTimeout(() => {
        document.body.removeChild(notification)
      }, 300)
    }, 3000)
  }
  
  const style = document.createElement("style")
  style.textContent = `
      .notification {
          position: fixed;
          bottom: 20px;
          right: 20px;
          background-color: #e67e22;
          color: white;
          padding: 12px 20px;
          border-radius: 8px;
          box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
          transform: translateY(100px);
          opacity: 0;
          transition: transform 0.3s, opacity 0.3s;
          z-index: 1000;
      }
      
      .notification.show {
          transform: translateY(0);
          opacity: 1;
      }
  `
  document.head.appendChild(style)
  