<?php        
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/type.class.php'); 
    require_once(__DIR__ . '/../database/condition.class.php'); 
    require_once(__DIR__ . '/../database/item.class.php'); 
    $session = new Session();
    
    if (!$session->isLoggedIn()) die(header('Location: ../pages/login.php'));

    $form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
    unset($_SESSION['form_data']);

    $db = getDatabaseConnection();
    $types = Type_::getAllTypes($db);
    $conditions = Condition::getAllConditions($db); 
    $item = Item::getItem($db, (int) $_GET['ItemID']);
?>
    <?=drawHeader($session);?>

        <main id="sell_information">
            <h1 class="sub_title">EDIT ITEM</h1>
            <?php foreach ($session->getMessages() as $messsage) { ?>
                    <article class="<?=$messsage['type']?>">
                    <?=$messsage['text']?>
                    </article>
                    <?php } ?>
            <form class="sell_form" enctype="multipart/form-data" action="../actions/action_edit_item.php?ItemID=<?=$item->ItemID?>" method="post">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <section class="description">
                    <img id="previewImage" name="image" class="item_img" src="../assets/uploads_item/<?=$item->ItemID?>.jpg" alt="Upload a Image"/>

                    <input type="file" name="image" id="fileInput">
                    <label for="fileInput" class="upload_label"></i> Upload Image</label>

                    <h2>Description</h2>
                    <textarea name="description" rows="4" cols="40"><?=$item->Detail?></textarea>
                </section>
                <aside class="filters_container">
                    <label>NAME
                        <input class="input_underlined" type="text" name="name" value="<?=$item->ItemName?>">
                    </label>

                    <h2>CATEGORIES</h2>
                    <label><input type="radio" name="CATEGORIES" value="1" <?= ($item->CategoryID == 1) ? 'checked' : '' ?> onchange="toggleSizes(this)">Women</label>
                    <label><input type="radio" name="CATEGORIES" value="2" <?= ($item->CategoryID == 2) ? 'checked' : '' ?> onchange="toggleSizes(this)">Men</label>
                    <label><input type="radio" name="CATEGORIES" value="3" <?= ($item->CategoryID == 3) ? 'checked' : '' ?> onchange="toggleSizes(this)">Kids</label>
                    <label><input type="radio" name="CATEGORIES" value="4" <?= ($item->CategoryID == 4) ? 'checked' : '' ?> onchange="toggleSizes(this)">Baby</label>

                    <div id="sizeOptionsSell" class="size-options"></div>

                    <h2>TYPE</h2>
                    <?php foreach ($types as $type): ?>
                        <label>
                            <input type="radio" name="TYPE" value="<?=$type['TypeID']?>" <?php if ($item->TypeID == $type['TypeID']) echo 'checked'; ?>>
                            <?= $type['TypeName']; ?>
                        </label>
                    <?php endforeach; ?>

                    <h2>CONDITION</h2>
                    <?php foreach ($conditions as $condition): ?>
                        <label>
                            <input type="radio" name="CONDITION" value="<?=$condition['ConditionID']?>" <?php if ($item->Condition == $condition['ConditionID']) echo 'checked'; ?>>
                            <?= $condition['ConditionName']; ?>
                        </label>
                    <?php endforeach; ?>      
                    
                    <h2>COLOUR</h2>
                    <section class="colour_sell">
                        <?php 
                        $colors = ['red', 'yellow', 'blue', 'green', 'orange', 'purple', 'pink', 'brown', 'gray', 'black', 'white', 'rainbow'];
                        foreach ($colors as $color): 
                        ?>
                        <input type="radio" id="<?= $color ?>" name="color" value="<?= $color ?>" <?= ($item->Color == $color) ? 'checked' : '' ?> hidden>
                        <label class="color-swatch <?= $color ?>" for="<?= $color ?>"></label>
                        <?php endforeach; ?>
                    </section>

                    <section class="price_brand">
                        <label id="minPriceLabel">PRICE
                            <input class="input_underlined" type="text" name="price" value="<?=$item->Price?>">
                        </label>
                        <label id="maxPriceLabel">BRAND
                            <input class="input_underlined" type="text" name="brand" value="<?=$item->Brand?>">
                        </label>
                    </section>
                </aside>
                <button type="submit">Submit</button>
            </form>
        </main>
        
        <?=drawFooter();?>