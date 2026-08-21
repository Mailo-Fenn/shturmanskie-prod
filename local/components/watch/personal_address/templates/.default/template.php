<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
    global $LENGUAGE;
    require(__DIR__."/../../lang/$LENGUAGE/template.php");

?>
 
<section class="account-form login">
    <div class="container shiping-top bottom-tree top-max form">

        <form class="grid address-item form-addresses" method="POST" style="border-bottom: none;">
            <div class="login-inputs info">
                <div class="account-form__title">
                    <?=$MESS['SHIPPING_INFO']; ?>
                </div> 
                <p><?=$MESS['USER_NAME']; ?>: <?=$arResult['OBJECT']['UF_LNAME']; ?> <?=$arResult['OBJECT']['UF_FNAME']; ?></p>
                <p><?=$MESS['PHONE']; ?>: <?=$arResult['OBJECT']['UF_PHONE']; ?></p>
            </div>
            <div class="login-inputs form" style="display: none;">
                <div class="account-form__title">
                    <?=$MESS['SHIPPING_INFO']; ?>
                </div> 
                <label>
                    <span><?=$MESS['FIRST_NAME']; ?></span>
                    <input name="UF_FNAME" placeholder="<?=$MESS['FIRST_NAME']; ?>" value="<?=$arResult['OBJECT']['UF_FNAME']; ?>">
                </label>
                <label>
                    <span><?=$MESS['LAST_NAME']; ?></span>
                    <input name="UF_LNAME" placeholder="<?=$MESS['LAST_NAME']; ?>" value="<?=$arResult['OBJECT']['UF_LNAME']; ?>">
                </label>
                <label>
                    <span><?=$MESS['PHONE']; ?></span>
                    <input name="UF_PHONE" placeholder="<?=$MESS['PHONE']; ?>" value="<?=$arResult['OBJECT']['UF_PHONE']; ?>">
                </label>
            </div>
            <div class="flex">
                <button save="<?=$MESS['SAVE']; ?>" class="circle-button"><?=$MESS['EDIT']; ?></button>
            </div>
        </form>

        <?php
            $clearFlag = true;

            if($arResult['OBJECT']['UF_LOCATION'] || $arResult['OBJECT']['UF_CITY'] || $arResult['OBJECT']['UF_ADRESS']){
                $clearFlag = false;
            }
        ?>

        <form class="grid address-item form-addresses" method="POST" style="border-bottom: none;"> 
            <div class="login-inputs info">
                <div class="account-form__title">
                    <?=$MESS['ADDRESS']; ?>
                </div> 
                <p><?=$MESS['LOCATION']; ?>: <?=$arResult['OBJECT']['UF_LOCATION']; ?></p>
                <p><?=$MESS['CITY']; ?>: <?=$arResult['OBJECT']['UF_CITY']; ?></p>
                <p><?=$MESS['ADDRESS']; ?>: <?=$arResult['OBJECT']['UF_ADRESS']; ?></p>
                <p><?=$MESS['POSTAL']; ?>: <?=$arResult['OBJECT']['UF_POSTAL_CODE']; ?></p>
            </div>
            <div class="login-inputs form" style="display: none;">
                <div class="account-form__title">
                    <?=$MESS['ADDRESS']; ?>
                </div> 

                <div class="country-list address-input">
                    <label>
                        <span><?=$MESS['LOCATION']; ?></span>
                        <input name="UF_LOCATION"  class="country-input" placeholder="<?=$MESS['COUNTRY']; ?>" value="<?=$arResult['OBJECT']['UF_LOCATION']; ?>" required>
                    </label> 
                    <div class="country-list__list address-input__list" style="display: none"></div>
                </div>

                <div class="city-list address-input">
                    <label>
                        <span><?=$MESS['CITY']; ?></span>
                        <input name="UF_CITY" class="city-input" placeholder="<?=$MESS['CITY']; ?>" value="<?=$arResult['OBJECT']['UF_CITY']; ?>" required>
                    </label>
                    <div class="city-list__list address-input__list" style="display: none"></div>
                </div>

                <label>
                    <span><?=$MESS['ADDRESS']; ?></span>
                    <input name="UF_ADRESS" placeholder="<?=$MESS['ENTER_ADDRESS']; ?>" value="<?=$arResult['OBJECT']['UF_ADRESS']; ?>" required>
                </label>

                <label>
                    <span><?=$MESS['POSTAL']; ?></span>
                    <input name="UF_POSTAL_CODE" placeholder="<?=$MESS['ENTER_POSTAL']; ?>" value="<?=$arResult['OBJECT']['UF_POSTAL_CODE']; ?>">
                </label>
            </div>
            <div class="flex">
                <button save="<?=$MESS['SAVE']; ?>" class="circle-button"><?=$clearFlag ? $MESS['ADD_ADDRESS'] : $MESS['EDIT']; ?></button>
            </div>
        </form>
    </div>
</section>
 