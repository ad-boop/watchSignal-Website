"use strict";



//Get Cart from session storage or create one if it does not exist
function getCart(){
    let Cart;
    if(sessionStorage.Cart === undefined || sessionStorage.Cart === ""){
        Cart = [];
    }
    else {
        Cart = JSON.parse(sessionStorage.Cart);
    }
    return Cart;
}



//Adds an item to the Cart
function addToCart(prodID, prodName,prodGender,prodImage,prodPrice){
    let Cart = getCart();//Load or create Cart
    
    //Add product to Cart
    Cart.push({id: prodID, watch_name: prodName, watch_gender:prodGender, watch_image:prodImage, price:prodPrice});
    
    //Store in local storage
    sessionStorage.Cart = JSON.stringify(Cart);
    alert("Product added to Cart.");
    //Display Cart in page.
    loadCart();      
}




