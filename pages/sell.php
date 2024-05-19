<?php        
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/type.class.php'); 
    require_once(__DIR__ . '/../database/condition.class.php'); 

    $session = new Session();

    if (!$session->isLoggedIn()) die(header('Location: ../pages/login.php'));

    $form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
    unset($_SESSION['form_data']);

    $db = getDatabaseConnection();
    $types = Type_::getAllTypes($db);
    $conditions = Condition::getAllConditions($db);  
?>
    <?=drawHeader($session);?>

        <main id="sell_information">
            <h1 class="sub_title">SELL</h1>
            <?php foreach ($session->getMessages() as $messsage) { ?>
                    <article class="<?=$messsage['type']?>">
                    <?=$messsage['text']?>
                    </article>
                    <?php } ?>
            <form class="sell_form" enctype="multipart/form-data" action="../actions/action_sell.php" method="post">
                <section class="description">
                    <img id="previewImage" name="image" class="item_img" src="../assets/uploads_item/default.jpeg" alt="Upload a Image"/>

                    <input type="file" name="image" id="fileInput">
                    <label for="fileInput" class="upload_label"></i> Upload Image</label>

                    <h2>Description</h2>
                    <textarea name="description" rows="4" cols="40"><?php echo isset($form_data['description']) ? htmlspecialchars($form_data['description']) : ''; ?></textarea>
                </section>
                <aside class="filters_container">
                    <label>NAME
                        <input class="input_underlined" type="text" name="name" value="<?php echo isset($form_data['brand']) ? htmlspecialchars($form_data['brand']) : ''; ?>">
                    </label>

                    <h2>CATEGORIES</h2>
                    <label><input type="radio" name="CATEGORIES" value="1" onchange="filterItems()" <?php if ($form_data['CATEGORIES'] == '1') echo 'checked'; ?>>Women</label>
                    <label><input type="radio" name="CATEGORIES" value="2" onchange="filterItems()" <?php if ($form_data['CATEGORIES'] == '2') echo 'checked'; ?>>Men</label>
                    <label><input type="radio" name="CATEGORIES" value="3" onchange="filterItems()" <?php if ($form_data['CATEGORIES'] == '3') echo 'checked'; ?>>Kids</label>
                    <label><input type="radio" name="CATEGORIES" value="4" onchange="filterItems()" <?php if ($form_data['CATEGORIES'] == '4') echo 'checked'; ?>>Baby</label>

                    <div id="sizeOptionsSell" class="size-options"></div>
                    
                    <h2>TYPE</h2>
                    <?php foreach ($types as $type): ?>
                        <label>
                            <input type="radio" name="TYPE" value="<?php echo $type['TypeID']; ?>" <?php if ($form_data['CATEGORIES'] == $type['TypeID']) echo 'checked'; ?>>
                            <?php echo htmlspecialchars($type['TypeName']); ?>
                        </label>
                    <?php endforeach; ?>

                    <h2>CONDITION</h2>
                    <?php foreach ($conditions as $condition): ?>
                        <label>
                            <input type="radio" name="CONDITION" value="<?php echo $condition['ConditionID']; ?>" <?php if ($form_data['CONDITION'] == $condition['ConditionID']) echo 'checked'?>>
                            <?php echo htmlspecialchars($condition['ConditionName']); ?>
                        </label>
                    <?php endforeach; ?>
                    
                    <h2>COLOUR</h2>
                    <section class="colour_sell">
                    <?php
                    $colors = [
                        "red", "yellow", "blue", "green", "orange", 
                        "purple", "pink", "brown", "gray", "black", 
                        "white", "rainbow"
                    ];
                    foreach ($colors as $color) {?>
                        <input type="checkbox" id="<?=$color?>" name="color" value="<?=$color?>" hidden>
                        <label class="color-swatch <?=$color?>" for="<?=$color?>"></label>
                    <?php } ?>
                    </section>
                    <section class="price_brand">
                        <label id="minPriceLabel">PRICE
                            <input class="input_underlined" type="text" name="price" value="<?php echo isset($form_data['brand']) ? htmlspecialchars($form_data['brand']) : ''; ?>">
                        </label>
                        <label id="maxPriceLabel">BRAND
                            <input class="input_underlined" type="text" name="brand" value="<?php echo isset($form_data['brand']) ? htmlspecialchars($form_data['brand']) : ''; ?>">
                        </label>
                    </section>
                </aside>
                <button type="submit">Submit</button>
            </form>
        </main>
        
        <?=drawFooter();?>