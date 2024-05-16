<?php        
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();
?>

<?=drawHeader($session);?>

        <main>
            <form class="register_inputs" action="../actions/action_register.php" method="post" enctype="multipart/form-data">  
                <img id="previewImage" class="profile_picture" src="../assets/uploads_item/default.jpeg" alt="Upload a Image"/>
                <section class="input_fields">
                    <input type="file" id="fileInput" name="image" id="previewImage">
                    <label for="fileInput" class="upload_label"></i> Upload Image</label>
                    <input class="input_info" type="text" name="RealName" placeholder="name">
                    <input class="input_info" type="email" name="Email" placeholder="email">
                    <input class="input_info" type="text" name="Username" placeholder="username">
                    <input class="input_info" type="password" name="Password" placeholder="password">
                    <input class="input_info" type="password" name="confirm_password" placeholder="confirm password">
                </section>
                <?php foreach ($session->getMessages() as $messsage) { ?>
                <article class="<?=$messsage['type']?>">
                <?=$messsage['text']?>
                </article>
                <?php } ?>
                <button type="submit">Sign Up</button>
            </form>    
        </main>

<?=drawFooter();?>