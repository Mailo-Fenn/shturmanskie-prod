<?php
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

	CEvent::Send("SALE_STATUS_CHANGED_F", SITE_ID, array(
        "EMAIL" => 'hoksmi@yandex.ru'
    ));	
?>