const deleteButton = document.getElementById('account_delete')
const popUp = document.querySelector('.delete_pop_up');
if (deleteButton) {
    deleteButton.addEventListener("click", function(e) {
        // Avoid a tag from refreshing the page
        e.preventDefault();
        // Show pop up
        popUp.style.display = 'flex';
        // Blurr background
        const header = document.querySelector('header');
        const footer = document.querySelector('footer');
        const mainNodes = document.querySelectorAll('main > *');
        header.style.filter = "blur(8px)";
        footer.style.filter = "blur(8px)";
        for (node of mainNodes) {
            console.log(node);
            if (!node.classList.contains("delete_pop_up")) node.style.filter = "blur(8px)";
        }
    });
}

if (popUp) {
    const closeButton = popUp.querySelector('img');
    closeButton.addEventListener("click", function(e) {
        // Clear inpuy field
        const inputField = popUp.querySelector('input');
        inputField.value = '';
        // Hide pop up
        popUp.style.display = 'none';
        // Un-blurr background
        const header = document.querySelector('header');
        const footer = document.querySelector('footer');
        const mainNodes = document.querySelectorAll('main > *');
        header.style.filter = "blur(0px)";
        footer.style.filter = "blur(0px)";
        for (node of mainNodes) {
            console.log(node);
            if (!node.classList.contains("delete_pop_up")) node.style.filter = "blur(0px)";
        }
    });
}