<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    
    $category_name = "Ограниченные серии";
    $category_id = 62;
    $APPLICATION->SetTitle("Ограниченные серии");

    include($_SERVER["DOCUMENT_ROOT"]."/catalog/base-category.php");
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");