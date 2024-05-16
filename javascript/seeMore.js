const sellingSeeMore = document.querySelector('#selling_see_more');
if (sellingSeeMore) {
    sellingSeeMore.addEventListener("click", async function(e) {
        seeMore.call(this, '../api/get_selling.php?number=');
    });
}

const soldSeeMore = document.querySelector('#sold_see_more');
if (soldSeeMore) {
    soldSeeMore.addEventListener("click", async function(e) {
        seeMore.call(this, '../api/get_sold.php?number=');
    });
}

async function seeMore(path) {
    const newItemsNumber = 5;
    const currNum = parseInt(this.getAttribute('data-number'));
    const newNumber = currNum + newItemsNumber;
    const max = parseInt(this.getAttribute('data-max-number'));
    // Get More items from database based on how many are currently showing
    const response = await fetch(path + newNumber);
    const items = await response.json();
    
    // Display Items
    const generalSection = this.parentNode;

    // Delete Previous Items
    // Get all child nodes of generalSection
    var childNodes = generalSection.childNodes;
    // Remove all child nodes except the last one
    while (generalSection.firstChild && generalSection.firstChild !== this) {
        generalSection.removeChild(generalSection.firstChild);
    }

    for (const item of items) {
        const article = document.createElement('article');
        // Append Image to article
        const img = document.createElement('img');
        img.src = item.ImageUrl;
        img.width = 200;
        img.height = 200;
        article.appendChild(img);
        // Create Section
        const section = document.createElement('section');
        section.classList.add('info');
        // Create Price, Name and Tags Section
        const price = document.createElement('p');
        price.classList.add('price');
        price.textContent = item.Price + ' €';
        const name = document.createElement('p');
        name.classList.add('name');
        name.textContent = item.ItemName;
        const tagsSection = document.createElement('section');
        tagsSection.classList.add('tags');
        // Building Tags Section
        const colorSquare = document.createElement('tag');
        colorSquare.classList.add('color-square', item.Color);
        tagsSection.appendChild(colorSquare);
        const sizeSquare = document.createElement('tag');
        sizeSquare.classList.add('size-square', 'gray');
        sizeSquare.textContent = item.Dimension;
        tagsSection.appendChild(sizeSquare);
        const div = document.createElement('div');
        div.classList.add('edit-button');
        const button = document.createElement('button');
        button.classList.add('edit-button');
        button.textContent = 'EDIT';
        div.appendChild(button);
        tagsSection.appendChild(div);
        // Combinning tags
        section.appendChild(price);
        section.appendChild(name);
        section.appendChild(tagsSection);
        article.appendChild(section);
        generalSection.insertBefore(article, this);
    }
    this.setAttribute('data-number', newNumber); 

    // Update See More Button
    if (max < newNumber) {
        this.style.display = "none";
    } else {
        this.setAttribute('data-number', newNumber);
    }
}