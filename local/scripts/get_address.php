<?php
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

    $arLocations = getLocationsList();

    echo json_encode($arLocations);
?>
