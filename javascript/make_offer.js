// Add "Make Offer" event to button
const makeOffer = document.querySelector('#item_page .make-offer');
if (makeOffer) {
    makeOffer.addEventListener("click", showMakeOfferPopUp);
}

// Handling popUp
const makeOfferPopUp = document.querySelector('#item_page .pop_up');
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