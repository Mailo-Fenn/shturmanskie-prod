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
        $login_result = $USER->Login($_POST['email'], $_POST['password'], "Y");

        if($login_result['TYPE'] == "ERROR"){
            $arResult["MSG"] = $MESS['ERROR'];
        }else{
            header('Location: /personal/');
        }
    }

    $this->IncludeComponentTemplate();