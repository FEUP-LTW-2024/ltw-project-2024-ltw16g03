<?php
    declare(strict_types = 1);
?>

<?php function output_item_display() { ?>
    <button class="left_arrow">
        <img src="../assets/left_arrow.png" alt="Button Image">
    </button>
    <section class="images">
        <a href="#" class="item_image">
            <img class = "item_img" src="https://picsum.photos/500" alt="A image representative of the item being sold" height = "400"/>
        </a>
        <a href="#" class="item_image">
            <img class = "item_img" src="https://picsum.photos/500" alt="A image representative of the item being sold" height = "400"/>
        </a>
        <a href="#" class="item_image">
            <img class = "item_img" src="https://picsum.photos/500" alt="A image representative of the item being sold" height = "400"/>
        </a>
    </section>
    <button class="right_arrow">
        <img src="../assets/right_arrow.png" alt="Button Image">
    </button>
<?php } ?>