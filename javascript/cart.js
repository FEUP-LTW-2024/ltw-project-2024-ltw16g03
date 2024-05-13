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
    const response = fetch('../api/add_to_cart.php?item=' + encodeURIComponent(this.getAttribute('data-item')));
    
    // Change button to Remove from Cart
    this.classList.remove('add-to-cart');
    this.classList.add('remove_from_cart', 'gray');
    this.textContent = 'REMOVE';

    // Change event handler to removeFromCartEvent
    this.removeEventListener('click', addToCartEvent);
    this.addEventListener('click', removeFromCartEvent);

    // If item is in wishlist remove it and change button
    const wishlistButton = this.closest('section').querySelector('img');
    if (wishlistButton.src = "../assets/wishlist.svg") {
        removeEvent.call(wishlistButton);
    }
}

async function addToCartWishlistPageEvent(e) {
    console.log(this)
    // Call API to add item to cart (properly encode json string)
    const response = fetch('../api/add_to_cart.php?item=' + encodeURIComponent(this.getAttribute('data-item')));

    // Remove item
    const wishlistButton = this.closest('section').querySelector('img');
    removeAndDeleteEvent.call(wishlistButton);

    // Close Pop-Up
    popUp.style.display = 'none';
}

// Add "Add to Cart" events to buttons on Categories pages
const addToCartButtons = document.querySelectorAll('#categories_page .add-to-cart');
for (const button of addToCartButtons) {
    button.addEventListener("click", addToCartEvent);
}

// Add "Remove from Cart" event to buttons on Categories pages
const removeButtons = document.querySelectorAll('#categories_page .remove_from_cart');
for (const button of removeButtons) {
    button.addEventListener("click", removeFromCartEvent);
}

// Add "Add to Cart" event to buttons on Wishlist page
const addToCartWishlist = document.querySelectorAll('#main-wishlist .add-to-cart');
for (const button of addToCartWishlist) {
    button.addEventListener("click", showPopUp);
}

// Add "Remove from Cart" event to cross on Cart page
const removeButtons2 = document.querySelectorAll('.eliminate-item');
for (const button of removeButtons2) {
    removeFromCartPageEvent(button);
}

// Handling popUp
const popUp = document.querySelector('#main-wishlist .pop_up');
function showPopUp() {
    // Show Pop Up
    popUp.style.display = 'flex';
    const addToCart = this;

    // Create new button add correct event listeners and replace it
    const continueButton = popUp.querySelector('button');
    // Clone the element
    const clone = continueButton.cloneNode(true);
    
    // Add Correct event listener
    clone.addEventListener("click", function(e) {
        addToCartWishlistPageEvent.call(addToCart);
    });

    // Replace the original element with the clone
    continueButton.parentNode.replaceChild(clone, continueButton);
}

if (popUp) {
    const closeButton = popUp.querySelector('img');
    closeButton.addEventListener("click", function(e) {
        // Hide pop up
        popUp.style.display = 'none';
    });
}
