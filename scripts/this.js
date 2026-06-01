import { cart,addToCart,updateCartQuantity } from '../data/cart.js'
import { products } from '/data/product.js'
import {currencyFormat} from "./utility/money.js"
let productHTML = '';
products.forEach((products) => {
    productHTML += `
    <div class="product">
                <div class="product-image">
                    <img src="${products.image}" alt="">
                </div>

                <div class="product-name">
                    ${products.name}
                </div>

                <div>
                    <span class="product-rating-stars">
                        <img src="images/rating-${products.rating.stars * 10}.png" alt="">
                    </span>
                    <span class="product-rating-count">(${products.rating.count})</span>
                </div>

                <div class="product-price">$${currencyFormat(products.priceCent)}</div>
                <button class="btn add-to-cart" data-product-Id="${products.id}">Add to Cart</button>
            </div>
    `
    document.querySelector('.products').innerHTML = productHTML;
    document.querySelectorAll('.add-to-cart').forEach((button) => {
        button.addEventListener('click', () => {
            let productId = button.dataset.productId;
            addToCart(productId);
            updateCartQuantity();

        })
    })
});