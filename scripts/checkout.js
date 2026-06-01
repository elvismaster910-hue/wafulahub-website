import { cart, removeProduct } from "../data/cart.js";
import { products } from "../data/product.js";
import { currencyFormat } from "./utility/money.js"
let cartSUmmaryHTML = '';
cart.forEach((cartItem) => {
  let productId = cartItem.productId;
  let matchingItem;
  products.forEach((product) => {
    if (product.id === productId) {
      matchingItem = product;
    }
  })
  cartSUmmaryHTML += `<div class="product-container js-cart-item-container-${matchingItem.id}">

          <div class="delivery-main-date">
            Delivery date: Friday, June 5
          </div>

          <div class="product-grid">

            <!-- IMAGE -->

            <div class="product-image-container">
              <img class="product-image"
              src="${matchingItem.image}">
            </div>

            <!-- DETAILS -->

            <div>

              <div class="product-name">
                ${matchingItem.name}
              </div>

              <div class="product-price">
                $${currencyFormat(matchingItem.priceCent)}
              </div>

              <div class="product-quantity">
                Quantity: ${cartItem.Quantity}
                <span class="js-update-btn">Update</span>
                <span class="js-delete-btn" data-product-id="${matchingItem.id}">Delete</span>
              </div>

            </div>

            <!-- DELIVERY -->

            <div>

              <div class="delivery-title">
                Choose a delivery option:
              </div>

              <label class="delivery-option">

                <input type="radio" name="${matchingItem.id}" checked>

                <div>
                  <div class="delivery-date">
                    Friday, June 5
                  </div>

                  <div class="delivery-shipping">
                    FREE Shipping
                  </div>
                </div>

              </label>

              <label class="delivery-option">

                <input type="radio" name="${matchingItem.id}">

                <div>
                  <div class="delivery-date">
                    Monday, June 1
                  </div>

                  <div class="delivery-shipping">
                    $4.99 - Shipping
                  </div>
                </div>

              </label>

            </div>

          </div>

        </div>`;

})
document.querySelector('.products-container').innerHTML = cartSUmmaryHTML;
document.querySelectorAll('.js-delete-btn').forEach((link) => {
  link.addEventListener('click', () => {
    let productId = link.dataset.productId;
    removeProduct(productId);
    const container = document.querySelector(`.js-cart-item-container-${productId}`);
    container.remove();
  })
})
document.querySelectorAll('.js-update-btn').forEach((link) => {
  link.addEventListener(('click'), () => {
    console.log('update');
  })
})
