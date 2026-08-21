<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
    global $LENGUAGE;
    require(__DIR__."/../../lang/$LENGUAGE/template.php");

?>

<form class="grid" method="post">
    <div class="login-inputs">
        <div class="login-tabs">
            <a href="" class=""><?=$_GET['change_password'] == 'yes' ? $MESS['UPDATE_TITLE'] : $MESS['TITLE']; ?></a>
        </div>
        <div class="login-description"><?=$_GET['change_password'] == 'yes' ? $MESS['UPDATE_DESCRIPTION'] : $MESS['DESCRIPTION']; ?></div>

        <? if($arResult["MSG"]){ ?>
            <div class="form-notification"><?=$arResult["MSG"]; ?></div>
        <? } ?>

        <? if($_GET['change_password'] == 'yes'){ ?>
            <input type="hidden" name="change_password" value="yes" />
            <input type="hidden" name="login" value="<?=$_GET['USER_LOGIN']; ?>" />
            <input type="hidden" name="key" value="<?=$_GET['USER_CHECKWORD']; ?>" />
            <label>
                <span><?=$MESS['PASSWORD']; ?></span>
                <input type="password" name="password" minlength="8" required placeholder="<?=$MESS['PASSWORD']; ?>" />
            </label>
            <label>
                <span><?=$MESS['CONFIRM_PASSWORD']; ?></span>
                <input type="password" name="confirm_password" minlength="8" required placeholder="<?=$MESS['CONFIRM_PASSWORD']; ?>" />
            </label>
        <? }else{ ?>
            <label>
                <span><?=$MESS['EMAIL']; ?></span>
                <input type="email" name="USER_EMAIL" required placeholder="<?=$MESS['EMAIL']; ?>" />
            </label>
        <? } ?>
    </div>
    <div class="flex">
        <button class="circle-button"><?=$MESS['BUTTON']; ?></button>
    </div>
</form>