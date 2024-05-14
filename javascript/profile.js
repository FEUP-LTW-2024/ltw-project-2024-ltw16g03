const leftSelling = document.querySelector('.selling .left_arrow');
const rightSelling = document.querySelector('.selling .right_arrow');
const leftSold = document.querySelector('.previous-orders .left_arrow');
const rightSold = document.querySelector('.previous-orders .right_arrow');

// Add event listener to left arrow on selling section
if (leftSelling) {
    leftSelling.addEventListener("click", async function(e) {
        arrow.call(this, '../api/get_range_selling.php', true);
    });
}

// Add event listener to left arrow on sold section
if (leftSold) {
    leftSold.addEventListener("click", async function(e) {
        arrow.call(this, '../api/get_range_sold.php', true);
    });
}

// Add event listener to right arrow on selling section
if (rightSelling) {
    rightSelling.addEventListener("click", async function(e) {
        arrow.call(this, '../api/get_range_selling.php', false);
    });
}

// Add event listener to right arrow on sold section
if (rightSold) {
    rightSold.addEventListener("click", async function(e) {
        arrow.call(this, '../api/get_range_sold.php', false);
    });
}

async function arrow(path, left) {
    const newItemsNumber = 3;
    const currNum = parseInt(this.getAttribute('data-number'));
    if (!left) {
        const newNumber = currNum + newItemsNumber;
        const max = parseInt(this.getAttribute('data-max-number'));

        // Get More items from database based on how many are currently showing
        const response = await fetch(path + '?number=' + currNum);
        const items = await response.json();

        displayItems.call(this, items);

        // Update buttons
        this.setAttribute('data-number', newNumber);
        if (max < newNumber) this.style.display = "none";
        const leftArrow = this.parentNode.querySelector('.left_arrow');
        console.log(leftArrow);
        const currLeftArrow = parseInt(leftArrow.getAttribute('data-number'));
        leftArrow.setAttribute('data-number', currLeftArrow + newItemsNumber);
        leftArrow.style.display = "block";
    } else {
        const newNumber = currNum - newItemsNumber;
        if (newNumber < 0) newNumber = 0;

        // Get More items from database based on how many are currently showing
        const response = await fetch(path + '?number=' + newNumber);
        const items = await response.json();

        displayItems.call(this, items);

        // Update buttons
        this.setAttribute('data-number', newNumber);
        if (newNumber <= 0) this.style.display = "none";
        const rightArrow = this.parentNode.querySelector('.right_arrow');
        console.log(this);
        const currRightArrow = parseInt(rightArrow.getAttribute('data-number'));
        rightArrow.setAttribute('data-number', currRightArrow - newItemsNumber);
        rightArrow.style.display = "block";
    }
}

function displayItems(items) {
    // Display Items
    const generalSection = this.parentNode.querySelector('section');

    // Delete Items
    generalSection.innerHTML = '';

    for (const item of items) {
        const link = document.createElement('a');
        link.href = "../pages/item.php?id=" + item.ItemID;
        link.classList.add('item_image');
        const image = document.createElement('img');
        image.classList.add('item_img');
        image.src = item.ImageURL;
        image.alt = "A image representative of the item being sold"
        image.height = 400;
        link.appendChild(image);
        generalSection.appendChild(link);
    }
}