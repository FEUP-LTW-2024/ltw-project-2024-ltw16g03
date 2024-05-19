<?php        
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    $form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
    unset($_SESSION['form_data']);

    if ($session->isLoggedIn()) die(header('Location: ../pages/profile.php'));
?>
    <?=drawHeader($session);?>
    
    <main>
        <form class="login_inputs" action="../actions/action_login.php" method="post">   
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <img src="../assets/disco ball.png" alt="disco ball"/>
            <section class="input_fields">
                <input class="input_info" type="text" name="username" placeholder="username" value="<?php echo isset($form_data['username']) ? $form_data['username'] : ''; ?>">
                <input class="input_info" type="password" name="password" placeholder="password">
            </section>
            <section id="messages">
            <?php foreach ($session->getMessages() as $messsage) { ?>
                <article class="<?=$messsage['type']?>">
                <?=$messsage['text']?>
                </article>
            <?php } ?>
            </section>
            <button type="submit">Sign In</button>
            <p>Don't have an account yet? <a href="register.php"><mark>Sign Up.</mark></a></p>
        </form>


    </main>

    <?=drawFooter();?>
