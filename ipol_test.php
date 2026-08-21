<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context;
$request = Context::getCurrent()->getRequest();

CModule::IncludeModule("sale");
cmodule::includeModule('ipol.sdek');


global $USER;

if($USER->isAuthorized()) {
		
	$user_id = $USER->GetID();
	
	$id = 8;
	
	$dTS = Bitrix\Sale\Delivery\Services\Table::getList(array(
		'order'  => array('SORT' => 'ASC', 'NAME' => 'ASC'),
		'filter' => array('ID' => $id)
	))->Fetch();
	$delivery = $dTS['CODE'];
	
	$cityDef = COption::GetOptionString('sale','location',false);
	
	echo $cityDef;
	
	echo $delivery;

}
else {
	
	echo 'no auth';
	
}



?>