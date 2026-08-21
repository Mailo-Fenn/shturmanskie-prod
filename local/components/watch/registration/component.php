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
        if($_POST['password'] == $_POST['conf_password']){
            $regResult = $USER->Register(
                $_POST['email'],
                $_POST['f_name'],
                $_POST['l_name'],
                $_POST['password'],
                $_POST['conf_password'],
                $_POST['email']
            );

            $arEventFields = array(
                "EMAIL_TO" => $_POST['email'],
				"EMAIL" => $_POST['email'],
            );

            CEvent::Send("AFTER_REGISTER", SITE_ID, $arEventFields);


            if($regResult['TYPE'] == 'OK'){                
                $USER->Update($regResult['ID'], array(
                    'UF_FIO' => $_POST['f_name'] . ' ' . $_POST['l_name'],
                    'UF_LOCATION' => $_POST['LOCATION'],
                    'UF_CITY' => $_POST['CITY'],
                    'UF_ADRESS' => $_POST['ADRESS'],
                    'UF_POSTAL_CODE' => $_POST['POSTAL_CODE'],
                ));
                $arResult["MSG"] = $MESS['SUCCESS'];

                header("Location: /personal/", true, 301);  
                exit();  
            }else{
                $arResult["MSG"] = $MESS['ERROR'];
            }
        }else{
            $arResult["MSG"] = $MESS['PASSWORD_ERROR'];
        }
    }

    $this->IncludeComponentTemplate();