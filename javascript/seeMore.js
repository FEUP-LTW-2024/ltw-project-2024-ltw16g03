const sellingSeeMore = document.querySelector('.selling_see_more');
if (sellingSeeMore) {
    sellingSeeMore.addEventListener("click", async function(e) {
        const currNum = parseInt(this.getAttribute('data-number'));
        const max = parseInt(this.getAttribute('data-max-number'));
        // Get More items from database based on how many are currently showing
        //const response = await fetch('../api/get_selling.php?number=' + this.getAttribute('data-number') + '&id=' + this.getAttribute('data-id'));

        // Display Items

        // Update See More Button
        if (max < currNum+5) {
            this.style.display = "none";
        } else {
            this.setAttribute('data-number', currNum+5);
        }
    });
}