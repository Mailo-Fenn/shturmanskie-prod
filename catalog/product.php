<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Каталог");

    $APPLICATION->IncludeComponent(
        "watch:product",
        "",
        array(),
        false
    );

    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");