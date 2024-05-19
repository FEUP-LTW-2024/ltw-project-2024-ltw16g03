<?php
    declare(strict_types = 1);
?>

<?php function output_item_display(array $items) { ?>
    <button class="left_arrow" data-number="0" hidden>
        <img src="../assets/left_arrow.png" alt="Button Image">
    </button>
    <section class="images">
        <?php for ($i = 0; $i < min(3, count($items)); $i++) {
        $item = $items[$i] ?>
        <a href="../pages/item.php?id=<?=urlencode($item->ItemID)?>" class="item_image">
            <img class = "item_img" src="../assets/uploads_item/<?=$item->ItemID?>.jpg" alt="A image representative of the item being sold" height = "400"/>
        </a>
        <?php } ?>
    </section>
    <?php if (count($items) > 3) { ?>
    <button class="right_arrow" data-number="3" data-max-number="<?=count($items)?>">
        <img src="../assets/right_arrow.png" alt="Button Image">
    </button>
    <?php } ?>
<?php } ?>