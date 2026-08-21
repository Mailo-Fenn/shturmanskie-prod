<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

    global $USER; 
    global $LENGUAGE;

    if($USER->IsAuthorized()){
        header("Location: /personal/", true, 301);  
        exit();  
    }
    
    require(__DIR__."/lang/$LENGUAGE/template.php");
 
    if($_POST && !$USER->IsAuthorized()){ 
        if(isset($_POST['USER_EMAIL']) && !empty($_POST['USER_EMAIL'])) {
            $email = trim($_POST['USER_EMAIL']);

            if (check_email($email)) {
                $arResult = CUser::SendPassword($email, $email);
          
                if($arResult["TYPE"] == "OK") {
                    $arResult["MSG"] = $MESS['SUCCESS'];
                } else {
                    $arResult["MSG"] = $MESS['ERROR'];
                }
            } else {
                $arResult["MSG"] = $MESS['ERROR'];
            }
        }

        if(isset($_POST['change_password']) && !empty($_POST['change_password'])){
            if(isset($_POST['password']) && isset($_POST['confirm_password']) && $_POST['password'] == $_POST['confirm_password'] && isset($_POST['login']) && isset($_POST['key'])){
                $arResult = $USER->ChangePassword($_POST['login'], $_POST['key'], $_POST['password'], $_POST['password']);
 
                if($arResult["TYPE"] == "OK") {
                    $arResult["MSG"] = $MESS['SUCCESS_CHANGE_PASSWORD'];
                } else {
                    $arResult["MSG"] = $MESS['ERROR_CHANGE_PASSWORD'];
                }
            } else {
                $arResult["MSG"] = $MESS['ERROR_CHANGE_PASSWORD'];
            }
        }
    }

    $this->IncludeComponentTemplate();