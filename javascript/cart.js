function removeFromCartPageEvent(e) {
    e.addEventListener("click", function(e) {
        // Call API to remove item from cart
        const response = fetch('../api/remove_from_cart.php?item=' + this.getAttribute('data-itemid'));

        // Reduce Price displayed on page
        const info = document.querySelector('.items-total');
        const price = info.querySelector('.big-total');
        const article = this.closest('.item-background');

        // Get the span element containing the "TOTAL" text
        const boldTextElement = price.querySelector('.bold-text');
        const currentPrice = parseFloat(info.querySelector('.big-total').textContent.replace('€', '').substring('TOTAL'.length).trim());
        const removedPrice = parseFloat(article.querySelector('.price2').textContent.replace('€', '').trim());
        const newPrice = currentPrice - removedPrice;
        
        // Update the total price displayed on the page
        price.innerHTML = `${boldTextElement.outerHTML} ${newPrice.toFixed(2) + ' €'}`;

        // Remove article from page
        if (article) {
            article.remove();
        }
        
        // Update number of items
        const number = info.querySelector('p');
        number.textContent = document.querySelectorAll('.item-background').length + ' items';
        
        // Change to empty page if last element is removed
        if (document.querySelectorAll('.item-background').length === 0) {
            window.location.href = "shopping_cart_empty.php";
        }
    });
}

function removeFromCartEvent(e) {
    // Call API to remove item from cart
    const ItemID = JSON.parse(this.getAttribute('data-item')).ItemID; 
    const response = fetch('../api/remove_from_cart.php?item=' + ItemID);

    // Change button to Remove from Cart
    this.classList.remove('remove_from_cart', 'gray');
    this.classList.add('add-to-cart');
    this.textContent = 'ADD TO CART';

    // Change event handler to addToCartEvent
    this.removeEventListener('click', removeFromCartEvent);
    this.addEventListener('click', addToCartEvent);
}

function addToCartEvent(e) {
    // Call API to add item to cart (properly encode json string)
    const response = fetch('../api/api_add_to_cart.php?item=' + encodeURIComponent(this.getAttribute('data-item')));
    
    // Change button to Remove from Cart
    this.classList.remove('add-to-cart');
    this.classList.add('remove_from_cart', 'gray');
    this.textContent = 'REMOVE';

    // Change event handler to removeFromCartEvent
    this.removeEventListener('click', addToCartEvent);
    this.addEventListener('click', removeFromCartEvent);
}

// Add "Add to Cart" events to buttons
const addToCartButtons = document.querySelectorAll('.add-to-cart');
for (const button of addToCartButtons) {
    button.addEventListener("click", addToCartEvent);
}

// Add "Remove from Cart" event to cross on Cart page
const removeButtons = document.querySelectorAll('.eliminate-item');
for (const button of removeButtons) {
    removeFromCartPageEvent(button);
}

// Add "Remove from Cart" event to buttons
const removeButtons2 = document.querySelectorAll('.remove_from_cart');
for (const button of removeButtons2) {
    button.addEventListener("click", removeFromCartEvent);
}
