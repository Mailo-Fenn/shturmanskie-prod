<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Корзина");

    $APPLICATION->IncludeComponent(
        "watch:order",
        "",
        array(),
        false
    );

    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");