<?php
    CModule::IncludeModule('iblock'); 
    
    $IMAGES_LIST = [];
    $arSelect = Array("ID", "PREVIEW_PICTURE");  
	$arFilter = Array(
        "IBLOCK_ID"=>13,
        "IBLOCK_SECTION_ID"=>38
    );  
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);  
	while($ob = $res->GetNextElement())  {  
		$arFields = $ob->GetFields();  
        $IMAGES_LIST[$arFields['ID']] = CFile::GetPath($arFields["PREVIEW_PICTURE"]);
	}     
?>
<div class="two-article__wrapper">
    <div class="">
        <div class="two-article__image" style="background-image: url('<?=$IMAGES_LIST[473]; ?>');"></div>
    </div>
    <div class="">
        <div class="two-article__image" style="background-image: url('<?=$IMAGES_LIST[474]; ?>');"></div>
    </div>
</div>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include", 
    ".default", 
    array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => "/components/article_01.php"
    ),
    false
);?> 
<a href="/retailers/" class="two-article__more">
    Найти Магазин
</a>