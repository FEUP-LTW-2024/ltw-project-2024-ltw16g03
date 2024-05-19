<?php
    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    if (!$session->isLoggedIn()) die(header('Location: ../pages/login.php'));

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/item.class.php'); 

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/my_selling.tpl.php');

    $db = getDatabaseConnection();

    $sellingItems = Item::getUserSellingItems($db, $session->getID());
    $soldItems = Item::getUserSoldItems($db, $session->getID());


    drawHeader($session);
?>
        <main>
            <h1 class="sub_title">SELLING</h1>
            <section class="selling_items">
                <?php if (empty($sellingItems)) { ?>
                    <?=drawEmpty("YOUR SELLING LIST IS EMPTY", "Sell some items here!", false, false, true)?>
                <?php } else { ?>
                    <?php output_item_display($sellingItems); ?>
                    <?php if (count($sellingItems) > 5) { ?> <a id="selling_see_more" class="option_link" data-number="5" data-max-number="<?=count($sellingItems)?>">Show More</a> <?php } ?>
                <?php } ?>
            </section>
            <h1 class="sub_title2">SOLD</h1>
            <section class="selling_items">
                <?php if (empty($soldItems)) { ?>
                    <?=drawEmpty("YOUR HAVEN'T SOLD ANYTHING YET", "", false, false, false)?>
                <?php } else { ?>
                    <?php output_item_display2($soldItems); ?>
                    <?php if (count($soldItems) > 5) { ?> <a id="sold_see_more" class="option_link" data-number="5">Show More</a> <?php } ?>
                <?php } ?> 
            </section>
        </main>
<?php drawFooter(); ?>