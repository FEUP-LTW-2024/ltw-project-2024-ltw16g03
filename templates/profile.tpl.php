<?php
    declare(strict_types = 1);
?>

<?php function output_item_display(array $items) { ?>
    <button class="left_arrow">
        <img src="../assets/left_arrow.png" alt="Button Image">
    </button>
    <section class="images">
        <?php foreach($items as $item) { ?>
        <a href="../pages/item.php?id=<?=$item->ItemID?>" class="item_image">
            <img class = "item_img" src="../assets/uploads_profile/<?=$item->ItemID?>.jpg" alt="A image representative of the item being sold" height = "400"/>
        </a>
        <?php } ?>
    </section>
    <button class="right_arrow">
        <img src="../assets/right_arrow.png" alt="Button Image">
    </button>
<?php } ?>