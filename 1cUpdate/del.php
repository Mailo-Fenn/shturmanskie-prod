<?php
    /*
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("catalog");
    
    $idBlock = 2;

    $arSelect = Array();
    $arFilter = Array("IBLOCK_ID"=> $idBlock);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($arElem = $res->GetNextElement()){
        $arFields = $arElem->GetFields();
        $arProps = $arElem->GetProperties();


        $delArray = array();
        if (is_array($arProps['MORE_PHOTO']['VALUE'])) {
            foreach ($arProps['MORE_PHOTO']['VALUE'] as $photoId) {
                $delArray['MORE_PHOTO'][$photoId] = array(
                    "MODULE_ID" => "iblock",
                    "del" => "Y"  
                );
            }
        }
        $elUpdate = CIBlockElement::SetPropertyValuesEx($arFields['ID'], false, $delArray);


        $delArray = array();
        if (is_array($arProps['DOP_IMAGE']['VALUE'])) {
            foreach ($arProps['DOP_IMAGE']['VALUE'] as $photoId) {
                $delArray['DOP_IMAGE'][$photoId] = array(
                    "MODULE_ID" => "iblock",
                    "del" => "Y"  
                );
            }
        }
        $elUpdate = CIBlockElement::SetPropertyValuesEx($arFields['ID'], false, $delArray);


        CIBlockElement::SetPropertyValueCode($arFields['ID'], 'IMAGES_IDS', array()); 
    }  