<?php
    declare(strict_types = 1);
?>

<?php function output_item_display(array $items) { ?>
    <?php for ($i = 0; $i < min(5, count($items)); $i++) { 
    $item = $items[$i] ?>
    <article>
        <img src="<?=$item->ImageURL?>" alt="template" height = "200" width = "200"/>
        <section class="info">
        <p class="price"><?=$item->Price?> €</p>
            <p class="name"><?=$item->ItemName?></p>
            <section class="tags">
                <span class="color-square <?=$item->Color?>"></span>
                <span class="size-square gray"><?=$item->Dimension?></span>
                <a href="../pages/edit_item.php?ItemID=<?php echo $item->ItemID?>"> <div class="edit-button"><button class="edit-button">EDIT</button></div> </a>
            </section>
        </section>
    </article>    
    <?php } ?>
<?php } ?>