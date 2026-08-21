<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
    

    if($_POST){
        global $USER, $APPLICATION, $LENGUAGE;

        if (CModule::IncludeModule('sale') && CModule::IncludeModule('catalog')) {
            // Получаем текущую корзину пользователя
            $basket = \Bitrix\Sale\Basket::loadItemsForFUser(
                \Bitrix\Sale\Fuser::getId(),
                \Bitrix\Main\Context::getCurrent()->getSite()
            );

            // Создаем новый заказ
            $order = \Bitrix\Sale\Order::create(
                \Bitrix\Main\Context::getCurrent()->getSite(),
                $USER->IsAuthorized() ? $USER->GetID() : \CSaleUser::GetAnonymousUserID()
            );

            $order->setPersonTypeId(1); // Обычно 1 - физ. лицо

            // Устанавливаем корзину в заказ
            $order->setBasket($basket);

            // Доставка
            $shipmentCollection = $order->getShipmentCollection();
            $shipment = $shipmentCollection->createItem();
            $service = \Bitrix\Sale\Delivery\Services\Manager::getById($_POST['delivery']); // ID службы доставки (замените на актуальный)
            if ($service) {
                $shipment->setFields([
                    'DELIVERY_ID' => $service['ID'],
                    'DELIVERY_NAME' => $service['NAME'],
                ]);
            }
            $shipmentItemCollection = $shipment->getShipmentItemCollection();
            foreach ($basket as $basketItem) {
                $item = $shipmentItemCollection->createItem($basketItem);
                $item->setQuantity($basketItem->getQuantity());
            }

            // Оплата
            $paymentCollection = $order->getPaymentCollection();
            $payment = $paymentCollection->createItem(
                \Bitrix\Sale\PaySystem\Manager::getObjectById($_POST['payment']) // ID платежной системы (замените на актуальный)
            );
            $payment->setField("SUM", $order->getPrice());
            $payment->setField("CURRENCY", $order->getCurrency());

            // Данные покупателя
            
            $propertyCollection = $order->getPropertyCollection();
            
            if ($prop = $propertyCollection->getPayerName())
                $prop->setValue($_POST['fname'] . ' ' . $_POST['lname']);

            if ($prop = $propertyCollection->getPhone())
                $prop->setValue($_POST['phone']);

            if ($prop = $propertyCollection->getUserEmail())
                $prop->setValue($_POST['email']);

            foreach ($propertyCollection as $property) {
                $code = $property->getField('CODE');
            
                if ($code == 'ADDRESS') 
                    $property->setValue($_POST['address']);
                
                if ($code == 'CITY') 
                    $property->setValue($_POST['city']);
                
                if ($code == 'ZIP') 
                    $property->setValue($_POST['postal_code']);
                
                if ($code == 'COUNTRY') 
                    $property->setValue($_POST['country']);
            }

            // Сохраняем заказ
            $result = $order->save();
            if ($result->isSuccess()) {
                // Очищаем корзину
                $basket->clearCollection();
                // Перенаправляем на страницу успешного оформления заказа
                LocalRedirect("/cart/confirm/?ORDER_ID=" . $order->getId());
                die();
            } else {
                $APPLICATION->ThrowException(implode("<br>", $result->getErrorMessages()));
            }
        }

        
    }

    

    $this->IncludeComponentTemplate();