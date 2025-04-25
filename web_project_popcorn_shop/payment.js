function payNow() {
    const cart = JSON.parse(localStorage.getItem("cart")) || []
  
    if (cart.length === 0) {
      alert("Your cart is empty!")
      return
    }
  
    const totalAmount = cart.reduce((sum, item) => sum + item.price * item.quantity, 0)
      if (confirm(`Proceed to pay ₹${totalAmount}?`)) {
      fetch("process_order.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          items: cart,
          total: totalAmount,
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            alert(`Payment Successful! Your order #${data.order_id} has been placed.`)
  
            localStorage.removeItem("cart")
            window.location.href = "menu.php"
          } else {
            alert(`Payment failed: ${data.message}`)
          }
        })
        .catch((error) => {
          console.error("Error:", error)
          alert("An error occurred during payment processing. Please try again.")
        })
    }
  }
  