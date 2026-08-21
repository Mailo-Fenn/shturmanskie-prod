<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    
    $category_name = "Мужские часы";
    $category_id = 56;
    $APPLICATION->SetTitle("Мужские часы");

    include($_SERVER["DOCUMENT_ROOT"]."/catalog/base-category.php");
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");