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
});

const mainCategories = document.querySelector('#categories_page');

if (mainCategories) { // If on Categories Page andd following event listeners
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', filterItems);
    });

    document.addEventListener('DOMContentLoaded', function () {
        filterItems();
    
        const priceInputs = document.querySelectorAll('input[type="number"]');
        priceInputs.forEach(input => {
            input.addEventListener('input', filterItems);
        });
    
        const urlParams = new URLSearchParams(window.location.search);
        const categoryParam = urlParams.get('category');
        const categoryMap = {'Women': '1', 'Men': '2', 'Kids': '3', 'House': '4'};
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

    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', filterItems);
        });
    
        const priceInputs = document.querySelectorAll('input[type="number"]');
        priceInputs.forEach(input => {
            input.addEventListener('input', filterItems);
        });
    });
}

function toggleSizes(checkbox) {
    var sizeOptions = document.getElementById("sizeOptions");
    sizeOptions.innerHTML = "";
    if (checkbox.checked) {
        var categoryName = checkbox.parentNode.textContent.trim();
        switch (categoryName) {
            case "Women":
            case "Men":
                sizeOptions.innerHTML = `
                <h2>SIZE</h2>
                <label><input type="checkbox" name="SIZE" value="XXL">XXL</label>
                <label><input type="checkbox" name="SIZE" value="XL">XL</label>
                <label><input type="checkbox" name="SIZE" value="L">L</label>
                <label><input type="checkbox" name="SIZE" value="M">M</label>
                <label><input type="checkbox" name="SIZE" value="S">S</label>
                <label><input type="checkbox" name="SIZE" value="XS">XS</label>
                <label><input type="checkbox" name="SIZE" value="XXS">XXS</label>
                <label><input type="checkbox" name="SIZE" value="37">37</label>
                <label><input type="checkbox" name="SIZE" value="38">38</label>
                <label><input type="checkbox" name="SIZE" value="39">39</label>
                <label><input type="checkbox" name="SIZE" value="40">40</label>
                <label><input type="checkbox" name="SIZE" value="41">41</label>
                <label><input type="checkbox" name="SIZE" value="42">42</label>
                <label><input type="checkbox" name="SIZE" value="43">43</label>
                <label><input type="checkbox" name="SIZE" value="44">44</label>
                <label><input type="checkbox" name="SIZE" value="45">45</label>
                <label><input type="checkbox" name="SIZE" value="46">46</label>
                <label><input type="checkbox" name="SIZE" value="47">47</label>
                <label><input type="checkbox" name="SIZE" value="48">48</label>
                <label><input type="checkbox" name="SIZE" value="49">49</label>
                <label><input type="checkbox" name="SIZE" value="50">50</label>
                `;
                break;
            case "Kids":
                sizeOptions.innerHTML = `
                <h2>SIZE</h2>
                <label><input type="checkbox" name="SIZE" value="0-3 months">0-3 months</label>
                <label><input type="checkbox" name="SIZE" value="3-6 months">3-6 months</label>
                <label><input type="checkbox" name="SIZE" value="6-9 months">6-9 months</label>
                <label><input type="checkbox" name="SIZE" value="9-12 months">9-12 months</label>
                <label><input type="checkbox" name="SIZE" value="12-18 months">12-18 months</label>
                <label><input type="checkbox" name="SIZE" value="18-24 months">18-24 months</label>
                <label><input type="checkbox" name="SIZE" value="2-3 years">2-3 years</label>
                <label><input type="checkbox" name="SIZE" value="3-4 years">3-4 years</label>
                <label><input type="checkbox" name="SIZE" value="4-5 years">4-5 years</label>
                <label><input type="checkbox" name="SIZE" value="5-6 years">5-6 years</label>
                <label><input type="checkbox" name="SIZE" value="6-7 years">6-7 years</label>
                <label><input type="checkbox" name="SIZE" value="7-8 years">7-8 years</label>
                <label><input type="checkbox" name="SIZE" value="9-10 years">9-10 years</label>
                <label><input type="checkbox" name="SIZE" value="10-11 years">10-11 years</label>
                <label><input type="checkbox" name="SIZE" value="11-12 years">11-12 years</label>
                <label><input type="checkbox" name="SIZE" value="12-13 years">12-13 years</label>
                <label><input type="checkbox" name="SIZE" value="13-14 years">13-14 years</label>
                <label><input type="checkbox" name="SIZE" value="14-15 years">14-15 years</label>
                <label><input type="checkbox" name="SIZE" value="15-16 years">15-16 years</label>
                <label><input type="checkbox" name="SIZE" value="15">15</label>
                <label><input type="checkbox" name="SIZE" value="16">16</label>
                <label><input type="checkbox" name="SIZE" value="17">17</label>
                <label><input type="checkbox" name="SIZE" value="18">18</label>
                <label><input type="checkbox" name="SIZE" value="19">19</label>
                <label><input type="checkbox" name="SIZE" value="20">20</label>
                <label><input type="checkbox" name="SIZE" value="21">21</label>
                <label><input type="checkbox" name="SIZE" value="22">22</label>
                <label><input type="checkbox" name="SIZE" value="23">23</label>
                <label><input type="checkbox" name="SIZE" value="24">24</label>
                <label><input type="checkbox" name="SIZE" value="25">25</label>
                <label><input type="checkbox" name="SIZE" value="26">26</label>
                <label><input type="checkbox" name="SIZE" value="27">27</label>
                <label><input type="checkbox" name="SIZE" value="28">28</label>
                <label><input type="checkbox" name="SIZE" value="29">29</label>
                <label><input type="checkbox" name="SIZE" value="30">30</label>
                <label><input type="checkbox" name="SIZE" value="31">31</label>
                <label><input type="checkbox" name="SIZE" value="32">32</label>
                <label><input type="checkbox" name="SIZE" value="33">33</label>
                <label><input type="checkbox" name="SIZE" value="34">34</label>
                <label><input type="checkbox" name="SIZE" value="35">35</label>
                <label><input type="checkbox" name="SIZE" value="36">36</label>
                `;
                break;
            default:
                break;
        }

        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', filterItems);
        });
    }
}

function filterItems() {
    const categories = Array.from(document.querySelectorAll('input[name="CATEGORIES"]:checked')).map(checkbox => checkbox.value);
    const sizes = Array.from(document.querySelectorAll('input[name="SIZE"]:checked')).map(checkbox => checkbox.value);
    const colors = Array.from(document.querySelectorAll('input[name="color"]:checked')).map(checkbox => checkbox.value);
    const types = Array.from(document.querySelectorAll('input[name="TYPE"]:checked')).map(checkbox => checkbox.value); 
    const minPrice = document.getElementById('minPrice').value.trim() || 0;
    const maxPrice = document.getElementById('maxPrice').value.trim() || 99999;
    const items = document.querySelectorAll('.display_item');

    items.forEach(item => {
        const category = item.dataset.category;
        const size = item.dataset.size;
        const color = item.dataset.color;
        const type = item.dataset.type;
        const price = parseFloat(item.querySelector('.item_info p:first-child').textContent.trim());

        if (
            (categories.length === 0 || categories.includes(category)) &&
            (sizes.length === 0 || sizes.includes(size)) &&
            (colors.length === 0 || colors.includes(color)) &&
            (types.length === 0 || types.includes(type))  &&
            (price >= minPrice && price <= maxPrice)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}