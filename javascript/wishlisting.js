async function removeEvent(e) {
    // Check if item is to be removed
    if (!(this.classList.contains('remove_from_wishlist') || this.classList.contains('remove-from-wishlist2'))) return;

    // Call API to remove item from wishlsit
    const response = await fetch('../api/remove_from_wishlist.php?item=' + this.getAttribute('data-itemid'));
    if (await response.text() == 'ERROR') return;

    // Change button visual and class
    if (this.classList.contains('remove_from_wishlist')) {
        this.classList.remove('remove_from_wishlist');
        this.classList.add('wishlist');
    } else {
        this.classList.remove('remove-from-wishlist2');
        this.classList.add('add-to-wishlist2');
    }
    this.src = "../assets/wishlist.svg";

    // Change event handler to addEvent
    this.removeEventListener('click', removeEvent);
    this.addEventListener('click', addEvent);
}

async function removeAndDeleteEvent(e) {
    // Call API to remove item from wishlsit
    const response = await fetch('../api/remove_from_wishlist.php?item=' + this.getAttribute('data-itemid'));
    if (await response.text() == 'ERROR') return;

    // Delete item from wishlist Page
    const article = this.closest('.display_item');
    if (article) article.remove();

    // Update Item Number
    const text = document.querySelector('h2');
    text.textContent = document.querySelectorAll('.display_item').length + ' item(s)';

    // Change to empty page if last element is removed
    if (document.querySelectorAll('.display_item').length === 0) {
        window.location.href = "wishlist_empty.php";
    }
}

async function addEvent(e) {
    // Call API to add item to wishlsit
    const response = await fetch('../api/add_to_wishlist.php?item=' + this.getAttribute('data-itemid'));
    if (await response.text() == 'ERROR') return;

    // Change button visual and class
    if (this.classList.contains('wishlist')) {
        this.classList.remove('wishlist');
        this.classList.add('remove_from_wishlist');
    } else {
        this.classList.remove('add-to-wishlist2');
        this.classList.add('remove-from-wishlist2');
    }
    this.src = "../assets/wishlisted.svg";

    // Change event handler to removeEvent
    this.removeEventListener('click', addEvent);
    this.addEventListener('click', removeEvent);

    // If item is in cart remove it and change button
    const cartButton = this.closest('section').querySelector('button');
    if (cartButton.textContent = "REMOVE") {
        removeFromCartEvent.call(cartButton);
    }
}

async function addAndDeleteEvent(e) {
    // Call API to add item to wishlsit
    const response = await fetch('../api/add_to_wishlist.php?item=' + this.getAttribute('data-itemid'));
    if (await response.text() == 'ERROR') return;

    // Call API to remove item from cart
    const response2 = fetch('../api/remove_from_cart.php?item=' + this.getAttribute('data-itemid'));

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
}

const wishlistAddButtons = document.querySelectorAll('#categories_page .wishlist, .add-to-wishlist2');
const wishlistRemoveButtons = document.querySelectorAll('#categories_page .remove_from_wishlist, .remove-from-wishlist2');
const wishlistAddAndDeleteButtons =  document.querySelectorAll('.add-to-wishlist');
const wishlistRemoveAndDeleteButtons = document.querySelectorAll('#main-wishlist .wishlist');

// Adding event Listeners
for (const button of wishlistAddButtons) {
    button.addEventListener("click", addEvent);
}

for (const button of wishlistRemoveButtons) {
    button.addEventListener("click", removeEvent);
}

for (const button of wishlistAddAndDeleteButtons) {
    button.addEventListener("click", addAndDeleteEvent);
}

for (const button of wishlistRemoveAndDeleteButtons) {
    button.addEventListener("click", removeAndDeleteEvent);
}
