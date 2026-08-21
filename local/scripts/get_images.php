<?php
    $url = explode('?', $_SERVER['REQUEST_URI'])[0];
    $SECTION_ID = 0;
    $IMAGES_LIST = [];

    switch($url){
        case '/service/maintenance/':
            $SECTION_ID = 35;
            break;
        case '/shipping/':
            $SECTION_ID = 34;
            break;
        case '/returns/':
            $SECTION_ID = 33;
            break;
        case '/custom-watches/':
            $SECTION_ID = 37;
            break;
        case '/warranty/':
            $SECTION_ID = 32;
            break;
        case '/about/collaboration/':
            $SECTION_ID = 31;
            break;
        case '/about/manufacture/':
            $SECTION_ID = 30;
            break;
        case '/':
            $SECTION_ID = 28;
            break;
        case '/about/':
            $SECTION_ID = 29;
            break;
        case '/personal/':
            $SECTION_ID = 39;
            break;


    }

    CModule::IncludeModule('iblock'); 

    $arSelect = Array("ID", "PREVIEW_PICTURE");  
	$arFilter = Array(
        "IBLOCK_ID"=>13,
        "IBLOCK_SECTION_ID"=>$SECTION_ID
    );  
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);  
	while($ob = $res->GetNextElement())  {  
		$arFields = $ob->GetFields();  
        $IMAGES_LIST[$arFields['ID']] = CFile::GetPath($arFields["PREVIEW_PICTURE"]);
	}  
?>