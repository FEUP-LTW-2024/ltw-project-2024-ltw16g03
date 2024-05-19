// Show and Hide filter button
document.addEventListener("DOMContentLoaded", function() {
    var filterButton = document.getElementById("filter-button");
    var dropdown = document.getElementById("filter-dropdown");
    dropdown.style.display = "none";
    filterButton.addEventListener("click", function(event) {
        event.stopPropagation();
        if (dropdown.style.display === "none") {
            dropdown.style.display = "block";
        } else {
            dropdown.style.display = "none";
        }
    });

    document.body.addEventListener("click", function(event) {
        if (!dropdown.contains(event.target) && event.target !== filterButton) {
            dropdown.style.display = "none";
        }
    });

    const sizeOptionsSell = document.getElementById("sizeOptionsSell");
    const categoryRadios = document.querySelectorAll('input[name="CATEGORIES"]');
    categoryRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            const selectedCategory = document.querySelector('input[name="CATEGORIES"]:checked');
            if (selectedCategory && sizeOptionsSell) {
                const categoryId = selectedCategory.value;
                fetchSizes(categoryId);
            }
            filterItems();
        });
    });

    const sizeCheckboxes = document.querySelectorAll('input[name="SIZE"]'); 
    sizeCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('input', filterItems);
    });

    const priceInputs = document.querySelectorAll('input[type="number"]');
    priceInputs.forEach(input => {
        input.addEventListener('input', filterItems);
    });

    const initialCategory = document.querySelector('input[name="CATEGORIES"]:checked');
    if (initialCategory) {
        fetchSizes(initialCategory.value);
    }
    
});

function fetchSizes(categoryId) {
    fetch('sizes.php?category_id=' + categoryId)
        .then(response => response.json())
        .then(data => {
            const sizeOptionsSell = document.getElementById("sizeOptionsSell");
            sizeOptionsSell.innerHTML = "";
            const heading = document.createElement('h2');
            heading.textContent = 'SIZES';
            sizeOptionsSell.appendChild(heading);

            const isSellPage = window.location.pathname.includes('sell.php') || window.location.pathname.includes('edit_item.php');

            data.forEach(size => {
                const label = document.createElement('label');
                const input = document.createElement('input');
                if (isSellPage) {
                    input.type = 'radio'; 
                } else {
                    input.type = 'checkbox'; 
                }
                input.name = 'SIZE';
                input.value = size.SizeName;

                label.appendChild(input);
                label.appendChild(document.createTextNode(size.SizeName));
                sizeOptionsSell.appendChild(label);
            });
            const sizeCheckboxes = document.querySelectorAll('input[name="SIZE"]');
            sizeCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('input', filterItems);
            });
        })
}

const mainCategories = document.querySelector('#categories_page');

if (mainCategories) { // If on Categories Page andd following event listeners
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', filterItems);
    });
    const priceInputs = document.querySelectorAll('input[type="number"]');
        priceInputs.forEach(input => {
            input.addEventListener('input', filterItems);
        });

    document.addEventListener('DOMContentLoaded', function () {
        filterItems();
    
        const priceInputs = document.querySelectorAll('input[type="number"]');
        priceInputs.forEach(input => {
            input.addEventListener('input', filterItems);
        });
        
        
        const urlParams = new URLSearchParams(window.location.search);
        const categoryParam = urlParams.get('category');
        const categoryMap = {'Women': '1', 'Men': '2', 'Kids': '3', 'Baby': '4'};
        if (categoryParam && categoryMap.hasOwnProperty(categoryParam)) {
            const categoryValue = categoryMap[categoryParam];
            const categoryCheckbox = document.querySelector(`input[name="CATEGORIES"][value="${categoryValue}"]`);
            if (categoryCheckbox) {
                categoryCheckbox.checked = true;
                filterItems();
                toggleSizes(categoryCheckbox);
            }
        }
    });
}

function toggleSizes(checkbox) {
    var sizeOptionsSell = document.getElementById("sizeOptionsSell");
    sizeOptionsSell.innerHTML = "";
    if (checkbox.checked) {
        const categoryId = checkbox.value;
        fetchSizes(categoryId);
    }
}

function filterItems() {
    const selectedCategory = document.querySelector('input[name="CATEGORIES"]:checked');
    const category = selectedCategory ? selectedCategory.value : null;
    const sizes = Array.from(document.querySelectorAll('input[name="SIZE"]:checked')).map(checkbox => checkbox.value);
    const colors = Array.from(document.querySelectorAll('input[name="color"]:checked')).map(checkbox => checkbox.value);
    const types = Array.from(document.querySelectorAll('input[name="TYPE"]:checked')).map(checkbox => checkbox.value); 
    const conditions = Array.from(document.querySelectorAll('input[name="CONDITION"]:checked')).map(checkbox => checkbox.value); 
    const minPrice = document.getElementById('minPrice').value.trim() || 0;
    const maxPrice = document.getElementById('maxPrice').value.trim() || 99999;
    const items = document.querySelectorAll('.display_item');
    
    items.forEach(item => {
        const categoryValue = item.dataset.category;
        const size = item.dataset.size;
        const color = item.dataset.color;
        const type = item.dataset.type;
        const condition = item.dataset.condition;
        const price = parseFloat(item.querySelector('.item_info p:first-child').textContent.trim());

        if (
            (category === null || category === categoryValue) &&
            (sizes.length === 0 || sizes.includes(size)) &&
            (colors.length === 0 || colors.includes(color)) &&
            (types.length === 0 || types.includes(type))  &&
            (conditions.length === 0 || conditions.includes(condition))  &&
            (price >= minPrice && price <= maxPrice)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}