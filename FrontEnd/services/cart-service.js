var CartService = {
  addToCart: function (product) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    cart.push(product);
    localStorage.setItem("cart", JSON.stringify(cart));
    toastr.success("Product added to cart!");
  },

  loadCart: function () {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    $("#cart-items").empty();
    let total = 0;
    cart.forEach(product => {
      $("#cart-items").append(`
        <div class="list-group-item d-flex justify-content-between align-items-center">
          <span>${product.name}</span>
          <span>$${parseFloat(product.price).toFixed(2)}</span>
        </div>
      `);
      total += parseFloat(product.price);
    });
    $("#cart-total").text(`$${total.toFixed(2)}`);
  },

  checkout: function () {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    if (cart.length === 0) {
      toastr.warning("Your cart is empty!");
      return;
    }

    const order = {
      items: cart.map(product => ({
        product_id: product.id,
        quantity: 1
      }))
    };

    $.ajax({
      url: Constants.PROJECT_BASE_URL + "orders",
      type: "POST",
      data: JSON.stringify(order),
      contentType: "application/json",
      headers: {
        'Authorization': 'Bearer ' + localStorage.getItem("user_token")
      },
      success: function (response) {
        toastr.success("Order placed successfully!");
        localStorage.removeItem("cart");
        CartService.loadCart();
      },
      error: function (xhr) {
        toastr.error(xhr.responseText || "Error placing order");
      }
    });
  }
};
