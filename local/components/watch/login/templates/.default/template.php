<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
    global $LENGUAGE;
    require(__DIR__."/../../lang/$LENGUAGE/template.php");

?>

<form class="grid" method="post">
    <div class="login-inputs">
        <? if($arResult["MSG"]){ ?>
            <div class="form-notification"><?=$arResult["MSG"]; ?></div>
        <? } ?>

        <label>
            <span><?=$MESS['EMAIL']; ?></span>
            <input type="email" name="email" required placeholder="<?=$MESS['EMAIL']; ?>" />
        </label>
        <label class="last password">
            <span><?=$MESS['PASSWORD']; ?></span>
            <div class="password-format"></div>
            <input 
                required  
                placeholder="<?=$MESS['ADD_PASSWORD']; ?>" 
                type="password" 
                name="password"
                minlength="8"
            />
            <a href="/login/password/" class="login-link"><?=$MESS['UPDATE_PASSWORD']; ?></a>
        </label>
    </div>
    <div class="flex">
        <button class="circle-button"><?=$MESS['SINGIN']; ?></button>
    </div>
</form>