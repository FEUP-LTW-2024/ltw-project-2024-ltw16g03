<?php        
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    $form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
    unset($_SESSION['form_data']);
?>

<?=drawHeader($session);?>

        <main>
            <form class="register_inputs" action="../actions/action_register.php" method="post" enctype="multipart/form-data">  
                <img id="previewImage" class="profile_picture" src="../assets/uploads_item/default.jpeg" alt="Upload a Image"/>
                <section class="input_fields">
                    <input type="file" id="fileInput" name="image" id="previewImage">
                    <label for="fileInput" class="upload_label"></i> Upload Image</label>
                    <input class="input_info" type="text" name="RealName" placeholder="name" value="<?php echo isset($form_data['RealName']) ? htmlspecialchars($form_data['RealName']) : ''; ?>">
                    <input class="input_info" type="email" name="Email" placeholder="email" value="<?php echo isset($form_data['Email']) ? htmlspecialchars($form_data['Email']) : ''; ?>">
                    <input class="input_info" type="text" name="Username" placeholder="username" value="<?php echo isset($form_data['Username']) ? htmlspecialchars($form_data['Username']) : ''; ?>">
                    <input class="input_info" type="password" name="Password" placeholder="password">
                    <input class="input_info" type="password" name="confirm_password" placeholder="confirm password">
                </section>
                <?php foreach ($session->getMessages() as $message) { ?>
                <article class="<?=$message['type']?>">
                <?=$message['text']?>
                </article>
                <?php } ?>
                <button type="submit">Sign Up</button>
            </form>    
        </main>

<?=drawFooter();?>