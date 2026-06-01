export let cart=JSON.parse(localStorage.getItem('cart'))||
[{
    'productId':'id2',
    Quantity: 1
},
{
    productId:'id3',
    Quantity:3
},
{
    'productId':'id4',
    Quantity:4
}
];
function saveToStorage(){
localStorage.setItem('cart',JSON.stringify(cart))
}
export  function addToCart(productId) {
        let matchingItem;
        cart.forEach((cartItem) => {
            if (productId === cartItem.productId) {
                matchingItem = cartItem;
            }
        })
        if (matchingItem) {
            matchingItem.Quantity += 1;
        }
        else {
            cart.push({
                'productId': productId,
                Quantity: 1
            }
            )
        }
        saveToStorage()
    }
    export function updateCartQuantity() {
        let Quantity = 0;
        cart.forEach((cartItem) => {
            Quantity += cartItem.Quantity;
        })
        document.querySelector('.card-quantity').innerHTML = Quantity;
    }
 export   function removeProduct(productId){
       let newCart=[];
        cart.forEach((cartItem)=>{
            if(cartItem.productId !==productId){
                newCart.push(cartItem);
            }
        })
        cart=newCart;
        saveToStorage()
    }
