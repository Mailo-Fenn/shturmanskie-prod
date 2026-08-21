<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
    
    global $USER; 
    global $LENGUAGE;
 
    require(__DIR__."/lang/$LENGUAGE/template.php");

    if(
        $USER->IsAuthorized() && 
        $_POST
    ) { 
        $user = new CUser;
        $userID = $USER->GetID();

         $fields = array(
            "NAME" => $_POST['NAME'],
            "LAST_NAME" => $_POST['LAST_NAME'],
            "PERSONAL_BIRTHDAY" => date('d.m.Y', strtotime($_POST['PERSONAL_BIRTHDAY']))
        );
    
        $user->Update($userID, $fields);
    }

    $this->IncludeComponentTemplate();