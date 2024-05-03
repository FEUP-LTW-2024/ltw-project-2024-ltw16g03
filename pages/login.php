<?php        
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    if ($session->isLoggedIn()) die(header('Location: ../pages/profile.php'));
?>
    <?=drawHeader($session);?>

    <main>
        <form class="login_inputs" action="../actions/action_login.php" method="post">   
            <img src="../assets/disco ball.png" alt="disco ball"/>
            <section class="input_fields">
                <input class="input_info" type="text" name="username" placeholder="username">
                <input class="input_info" type="password" name="password" placeholder="password">
            </section>
            <input type="submit" name="submit" value="submit">

            <p>Don't have an account yet? <a href="register.php"><mark>Sign Up.</mark></a></p>
        </form>
    </main>

    <?=drawFooter();?>