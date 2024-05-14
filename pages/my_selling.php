<?php
    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    if (!$session->isLoggedIn()) die(header('Location: ../pages/login.php'));

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/item.class.php'); 

    require_once(__DIR__ . '/../templates/common.tpl.php');

    $db = getDatabaseConnection();

    $sellingItems = Item::getUserSellingItems($db, $session->getID());
    $soldItems = Item::getUserSoldItems($db, $session->getID());


    drawHeader($session);
?>
        <main>
            <h1 class="sub_title">SELLING</h1>
            <section class="selling_items">
                <?php if (empty($sellingItems)) { ?>
                    <?=drawEmpty("YOUR SELLING LIST IS EMPTY", "Sell some items here!", false, true)?>
                <?php } ?>
                <?php foreach ($sellingItems as $item) { ?>
                <article>
                    <img src="<?=$item->ImageURL?>" alt="template" height = "200" width = "200"/>
                    <section class="info">
                    <p class="price"><?=$item->Price?> $</p>
                        <p class="name"><?=$item->ItemName?></p>
                        <section class="tags">
                            <span class="color-square <?=$item->Color?>"></span>
                            <span class="size-square gray"><?=$item->Dimension?></span>
                            <div class="edit-button"><button class="edit-button">EDIT</button></div>
                        </section>
                    </section>
                </article>    
                <?php } ?>
            </section>
            <h1 class="sub_title2">SOLD</h1>
            <section class="selling_items">
                <?php if (empty($soldItems)) { ?>
                    <?=drawEmpty("YOUR SELLING LIST IS EMPTY", "", false, false)?>
                <?php } ?>
                <?php foreach ($soldItems as $item) { ?>
                <article>
                    <img src="<?=$item->ImageURL?>" alt="template" height = "200" width = "200"/>
                    <section class="info">
                    <p class="price"><?=$item->Price?> $</p>
                        <p class="name"><?=$item->ItemName?></p>
                        <section class="tags">
                            <span class="color-square <?=$item->Color?>"></span>
                            <span class="size-square gray"><?=$item->Dimension?></span>
                            <div class="edit-button"><button class="edit-button">EDIT</button></div>
                        </section>
                    </section>
                </article>    
                <?php } ?>
            </section>
        </main>
<?php drawFooter(); ?>