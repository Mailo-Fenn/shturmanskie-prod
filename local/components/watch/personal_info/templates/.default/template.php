<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
    global $LENGUAGE;
    require(__DIR__."/../../lang/$LENGUAGE/template.php");

    global $USER; 

    $userData = \Bitrix\Main\UserTable::getList(array(
        'filter' => array('ID'=>$USER->GetID()),
        'limit'=>1,
        'select'=>array('*','UF_*'),
    ))->fetch();

    // Получаем все группы пользователей
    $userGroups = CUser::GetUserGroup($USER->GetID());
?>

<section class="account-form shiping login">
    <div class="container bottom-max top-max form">
        <form class="grid" id="update-userInfo" method="POST">
            <div class="login-inputs info">
                <div class="account-form__title"><?=$MESS['YOUPROFILE']; ?></div> 
                <p><?=$MESS['NAME']; ?>: <?=$userData['LAST_NAME']; ?> <?=$userData['NAME']; ?></p>
                <p>Email: <?=$userData['EMAIL']; ?></p>
                <p><?=$MESS['BDAY']; ?>: <?=$userData['PERSONAL_BIRTHDAY']; ?></p>
            </div>
            <div class="login-inputs form" style="display: none;">
                <div class="account-form__title">
                    <?=$MESS['YOUPROFILE']; ?>
                </div> 
                
                <label>
                    <span><?=$MESS['F_NAME']; ?></span>
                    <input name="NAME" value="<?=$userData['NAME']; ?>" />
                </label>
                <label>
                    <span><?=$MESS['L_NAME']; ?></span>
                    <input name="LAST_NAME" value="<?=$userData['LAST_NAME']; ?>" />
                </label>
                <label>
                    <span><?=$MESS['BDAY']; ?></span>					
					<?					
					if(isset($userData['PERSONAL_BIRTHDAY']) && $userData['PERSONAL_BIRTHDAY'] != '') {
						
						if($LENGUAGE == 'ru') {							
							$dates = explode('.', $userData['PERSONAL_BIRTHDAY']);
						}
						else {							
							$dates = explode('/', $userData['PERSONAL_BIRTHDAY']);							
						}
						
						$userData['PERSONAL_BIRTHDAY'] = $dates[2].'-'.$dates[1].'-'.$dates[0];
					}
					?>
                    <input name="PERSONAL_BIRTHDAY" type="date" value="<?=$userData['PERSONAL_BIRTHDAY']; ?>" />
                </label>
            </div>
            <div class="flex">
                <button class="circle-button" save="<?=$MESS['SAVE']; ?>"><?=$MESS['EDIT']; ?></button>
            </div>
        </form>
    </div>
</section>

<section class="account-form login">
    <div class="container bottom-max top-min">
        <div class="account-form__checklist">
            <div>
                <div class="account-form__title">
                    <?=$MESS['SUBSCRIBE']; ?>
                </div> 
                <label class="last checkbox">
                    <input type="checkbox" id="news-subscribe" <?=in_array(9, $userGroups) ? 'checked' : ''; ?> />
                    <div><?=$MESS['NEWSLETTER']; ?></div>
                </label>
            </div>
            <div>
                <div class="account-form__title">
                    <?=$MESS['NEW_PRODUCT']; ?>
                </div> 
                <label class="last checkbox">
                    <input type="checkbox" id="new-products" <?=in_array(10, $userGroups) ? 'checked' : ''; ?> />
                    <div><?=$MESS['PROMOTION']; ?></div>
                </label>
            </div>
        </div>
    </div>
</section>