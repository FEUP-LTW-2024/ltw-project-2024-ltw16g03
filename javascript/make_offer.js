// Add to cart from proposal buttons
const addToCartProposal = document.querySelectorAll(".add_proposal");
const removeFromCartProposal = document.querySelectorAll(".remove_proposal");

// Add "Add to cart" event to buttons on message pages
for (const button of addToCartProposal) {
    button.addEventListener("click", addProposal);
}

// Add "Remove from cart" event to buttons on message pages
for (const button of removeFromCartProposal) {
    button.addEventListener("click", removeProposal);
}

function addProposal() {
    // Call API to add item to cart (properly encode json string)
    const response = fetch('../api/add_to_cart.php?item=' + encodeURIComponent(this.getAttribute('data-item')));
    
    // Change button to Remove from Cart
    this.classList.remove('add_proposal');
    this.classList.add('remove_proposal');
    this.textContent = 'REMOVE FROM CART';

    // Change event handler to removeFromCartEvent
    this.removeEventListener('click', addProposal);
    this.addEventListener('click', removeProposal);
}

function removeProposal() {
    // Parse the JSON string to a JavaScript object
    const itemObject = JSON.parse(this.getAttribute('data-item'));
    // Call API to add item to cart (properly encode json string)
    const response = fetch('../api/remove_from_cart.php?item=' + itemObject.ItemID);

    // Change button to Remove from Cart
    this.classList.remove('remove_proposal');
    this.classList.add('add_proposal');
    this.textContent = 'ADD TO CART';

    // Change event handler to removeFromCartEvent
    this.removeEventListener('click', removeProposal);
    this.addEventListener('click', addProposal);
}

// Accept and Reject Buttons
const acceptButtons = document.querySelectorAll(".accept_proposal");
const rejectButtons = document.querySelectorAll(".reject_proposal");

// Add "Accept" event to buttons on message pages
for (const button of acceptButtons) {
    button.addEventListener("click", acceptProposal);
}

// Add "Reject" event to buttons on message pages
for (const button of rejectButtons) {
    button.addEventListener("click", rejectProposal);
}

function acceptProposal() {
    const proposalID = this.getAttribute('data-proposal');
    const response = fetch('../api/accept_proposal.php?proposal=' + proposalID);

    // Modify text
    const proposal = this.closest("article");
    proposal.querySelector("h1").textContent = "ACCEPTED";
    
    // Remove Buttons
    const buttons = proposal.querySelectorAll('button');
    for (const button of buttons) {
        button.parentNode.removeChild(button);
    }

    // Remove article and place it at the bottom
    const inputField = document.querySelector("#main_messages .input_info");
    document.querySelector("main").insertBefore(proposal.parentElement, inputField.parentElement);
}

function rejectProposal() {
    const proposalID = this.getAttribute('data-proposal');
    const response = fetch('../api/reject_proposal.php?proposal=' + proposalID);

    // Modify text
    const proposal = this.closest("article");
    proposal.querySelector("h1").textContent = "REJECTED";
    
    // Remove Buttons
    const buttons = proposal.querySelectorAll('button');
    for (const button of buttons) {
        button.parentNode.removeChild(button);
    }

    // Remove article and place it at the bottom
    const inputField = document.querySelector("#main_messages .input_info");
    document.querySelector("main").insertBefore(proposal.parentElement, inputField.parentElement);
}

const makeOfferPopUp = document.querySelector('#item_page .pop_up');

// Add "Make Offer" event to submit button
const submit = document.querySelector('#item_page .offer button');
if (submit) {
    submit.addEventListener("click", makeOffer);
}

function makeOffer() {
    // Check if input file is empty or not
    const proposal = makeOfferPopUp.querySelector("input");
    if (proposal.value == "") return;
    
    const currentPrice = parseFloat(makeOfferPopUp.querySelector("p").textContent.replace('€', ' '));
    const proposedPrice = parseFloat(proposal.value);
    // Check if value is whitin bounds
    if (proposedPrice <= 0 || proposedPrice >= currentPrice) return;

    // Make proposal
    // Get the URL of the current page
    var url = window.location;

    // Create a URLSearchParams object with the query string parameters
    var params = new URLSearchParams(url.search);

    // Get the value of the 'id' parameter
    var id = params.get('id');

    // Call api to make proposal
    const response = fetch('../api/make_offer.php?id=' + params.get('id') + '&price=' + proposedPrice);
    
    // Hide pop up
    makeOfferPopUp.style.display = 'none';
    // Activate background buttons
    const header = document.querySelector('header');
    const mainNodes = document.querySelectorAll('main > *');
    header.style.pointerEvents = "auto";
    for (node of mainNodes) {
        if (!node.classList.contains("pop_up")) {
            node.style.pointerEvents = "auto";
        }
    }
}

// Handling popUp
// Add "Make Offer Pop Up" event to button
const makeOfferButton = document.querySelector('#item_page .make-offer');
if (makeOfferButton) {
    makeOfferButton.addEventListener("click", showMakeOfferPopUp);
}

function showMakeOfferPopUp() {
    // Show Pop Up
    makeOfferPopUp.style.display = 'flex';

    // Deactivate background buttons
    const header = document.querySelector('header');
    const mainNodes = document.querySelectorAll('main > *');
    header.style.pointerEvents = "none";
    for (node of mainNodes) {
        if (!node.classList.contains("pop_up")) {
            node.style.pointerEvents = "none";
        }
    }
}

if (makeOfferPopUp) {
    const closeButton = makeOfferPopUp.querySelector('img');
    closeButton.addEventListener("click", function(e) {
        // Hide pop up
        makeOfferPopUp.style.display = 'none';
        // Activate background buttons
        const header = document.querySelector('header');
        const mainNodes = document.querySelectorAll('main > *');
        header.style.pointerEvents = "auto";
        for (node of mainNodes) {
            if (!node.classList.contains("pop_up")) {
                node.style.pointerEvents = "auto";
            }
        }
    });
}
