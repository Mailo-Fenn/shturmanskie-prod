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
            <span><?=$MESS['FIRST_NAME']; ?> *</span>
            <input name="f_name" required placeholder="<?=$MESS['FIRST_NAME']; ?>" />
        </label>
                
        <label>
            <span><?=$MESS['LAST_NAME']; ?> *</span>
            <input name="l_name" required placeholder="<?=$MESS['LAST_NAME']; ?>" />
        </label>

        <label>
            <span><?=$MESS['EMAIL']; ?> *</span>
            <input name="email" required type="email" placeholder="<?=$MESS['EMAIL']; ?>" />
        </label>

        <label class="password">
            <span><?=$MESS['PASSWORD']; ?> *</span>
            <div class="password-format"></div>
            <input name="password" required placeholder="<?=$MESS['PASSWORD_PLACEHOLDER']; ?>" minlength="8" type="password" />
        </label>

        <label class="password">
            <span><?=$MESS['CONF_PASSWORD']; ?> *</span>
            <div class="password-format"></div>
            <input name="conf_password"  required placeholder="<?=$MESS['PASSWORD_PLACEHOLDER']; ?>" minlength="8" type="password" />
        </label>
 
        <div class="country-list address-input">
            <label>
                <span><?=$MESS['LOCATION']; ?></span>
                <input name="LOCATION" type="text" class="country-input" placeholder="<?=$MESS['COUNTRY']; ?>" />
            </label>
            <div class="country-list__list address-input__list" style="display: none"></div>
        </div>
        

        <div class="city-list address-input">
            <label>
                <span><?=$MESS['CITY']; ?></span>
                <input name="CITY" type="text" class="city-input" placeholder="<?=$MESS['CITY']; ?>" />
            </label>
            <div class="city-list__list address-input__list" style="display: none"></div>
        </div>
        
        <label>
            <span><?=$MESS['ADDRESS']; ?></span>
            <input name="ADRESS" type="text" placeholder="<?=$MESS['ENTER_ADDRESS']; ?>" />
        </label>

        <label>
            <span><?=$MESS['POST_CODE']; ?></span>
            <input name="POSTAL_CODE" type="text" placeholder="<?=$MESS['ENTER_POST_CODE']; ?>" />
        </label>

        <label class="last checkbox">
            <input type="checkbox" required>
            <div><?=$MESS['CHECKBOX']; ?></div>
        </label>
    </div>
    <div class="flex">
        <button class="circle-button" id="register-button"><?=$MESS['REGISTER']; ?></button>
    </div>        
</form>

<script>
    document.getElementById('register-button').addEventListener('click', function() {
        document.querySelectorAll('label.checkbox').forEach(function(label) {

            if(
                !label.querySelector('input[type="checkbox"]').checked && 
                label.querySelector('input[type="checkbox"]').required
            ){
                label.classList.add('error');
            } else{
                label.classList.remove('error');
            }
        })
    });
</script>

<style>
    label.checkbox.error:before {
        border: 1px solid #ff3b3b !important;
    }
</style>

