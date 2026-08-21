<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

    global $USER; 
    global $LENGUAGE;

    if($_POST && $USER->IsAuthorized() && CModule::IncludeModule('iblock')){

        if($_POST['UF_FNAME']){
            $USER->Update($USER->GetID(), array(
                'UF_FNAME' => $_POST['UF_FNAME'],
                'UF_LNAME' => $_POST['UF_LNAME'],
                'UF_PHONE' => $_POST['UF_PHONE'],
            ));
        }

        if($_POST['UF_LOCATION']){
            $USER->Update($USER->GetID(), array(
                'UF_LOCATION' => $_POST['UF_LOCATION'],
                'UF_CITY' => $_POST['UF_CITY'],
                'UF_ADRESS' => $_POST['UF_ADRESS'],
                'UF_POSTAL_CODE' => $_POST['UF_POSTAL_CODE'],
            ));
        }
               
        header("Location: /personal/?page=info#menu");
        die();
    }
 
    // Загрузи UF поля пользователя
    if ($USER->IsAuthorized()) {
        $userId = $USER->GetID();
        $rsUser = CUser::GetByID($userId);
        if ($arUser = $rsUser->Fetch()) {
            $arResult["OBJECT"] = array(
                'UF_FNAME' => $arUser['UF_FNAME'],
                'UF_LNAME' => $arUser['UF_LNAME'],
                'UF_PHONE' => $arUser['UF_PHONE'],
                'UF_LOCATION' => $arUser['UF_LOCATION'],
                'UF_CITY' => $arUser['UF_CITY'],
                'UF_ADRESS' => $arUser['UF_ADRESS'],
                'UF_POSTAL_CODE' => $arUser['UF_POSTAL_CODE'],
            );
        }
    }
 

    $this->IncludeComponentTemplate();