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
