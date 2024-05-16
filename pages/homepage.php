<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();?>

    <?=drawHeader($session);?>
    
    <main>
    <section class="big-image">
        <img src="../assets/homepage_big.jpg" alt="Two well dressed people sitting with drinks">
        <a class="slogan">READY TO UP-LIFT YOUR OUTFIT?</a>
    </section>

    <?=drawSHOPNOW();?>

    <section class="items-homepage">
    <a href="categories.php?category=Women" class="category-link">
        <img src="../assets/women.png" alt="women-geral">
        <span class="category-text">WOMEN</span>
    </a>
    <a href="categories.php?category=Men" class="category-link">
        <img src="../assets/men.png" alt="men-geral">
        <span class="category-text">MEN</span>
    </a>
    <a href="categories.php?category=Kids" class="category-link">
        <img src="../assets/kids.png" alt="kids-geral">
        <span class="category-text">KIDS</span>
    </a>
    <a href="categories.php?category=Baby" class="category-link">
        <img src="../assets/baby.png" alt="baby-geral">
        <span class="category-text">BABY</span>
    </a>
    </section>
    </main>

    <?=drawFooter();?>