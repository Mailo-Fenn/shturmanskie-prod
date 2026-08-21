<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Main;	
use Bitrix\Main\Context;
use Bitrix\Sale\Order;

Loader::includeModule('sale');


$request = Context::getCurrent()->getRequest();

global $USER;

if($USER->isAuthorized()) {
	
	$order_id = $p = $request->get('id');		
	$order = Order::load($order_id);	
	
	$propertyCollection = $order->getPropertyCollection();

	foreach ($propertyCollection as $property) {
		
		$code = $property->getField('CODE');
	
		if ($code == 'IS_CANCEL_ORDER') {
			
			$property->setValue('Y');
			
		}
		
	}
	
	//$prop = $propertyCollection->getItemByOrderPropertyId(15);
	//$prop->setValue('Y');	
	
	$order->save();	
	
	$arFields = array(
		"ORDER_ID" => $order_id		
	);

	CEvent::SendImmediate('APP_ORDER_CANCEL', SITE_ID, $arFields);
		
	echo 'success';
	
}
else {
	
	echo 'no auth';
	
}
?>