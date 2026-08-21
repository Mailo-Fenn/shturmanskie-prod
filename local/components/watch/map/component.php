<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
    $APPLICATION->AddHeadScript("https://api-maps.yandex.ru/v3/?apikey=94679a00-268a-4973-8a94-7a3dfecbea94&lang=ru_RU");
    
    global $LENGUAGE;

    $arResult["REGIONS"] = array(); 
    $arResult["OBJECTS"] = array(); 

    $targetLengID = $LENGUAGE == 'ru' ? 44 : 43;
    $arFilter = Array("IBLOCK_ID"=>11, "PROPERTY_ITEM_TYPE"=>$targetLengID);
    $res = CIblockElement::GetList(Array("DATE_CREATE" => "DESC"), $arFilter, false, $arPages, Array());
    
    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
	    $arProps = $ob->GetProperties();

        $arResult["REGIONS"][$arFields['ID']] = array(
            'NAME' => $arFields['NAME'],
            'COORDINATES' => explode(",", $arProps['COORDINATES']['VALUE']),
            'OBJECTS' => array()
        );
    }

    $targetLengID = $LENGUAGE == 'ru' ? 46 : 45;
    $arFilter = Array("IBLOCK_ID"=>12, "PROPERTY_LANG"=>$targetLengID);
    $res = CIblockElement::GetList(Array("DATE_CREATE" => "DESC"), $arFilter, false, $arPages, Array());
    
    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
	    $arProps = $ob->GetProperties();


        $arResult["OBJECTS"][] = array(
            'ID' => $arFields['ID'],
            'NAME' => $arFields['NAME'],
            'REGION' => $arProps['SUBJECT']['VALUE'],
            'ADRESS' => $arProps['ADRESS']['VALUE'],
            'COORDINATES' => explode(",", $arProps['COORDINATES']['VALUE'])  
        );
    }

    $this->IncludeComponentTemplate();