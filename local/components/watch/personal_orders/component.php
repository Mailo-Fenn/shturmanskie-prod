<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
    
    if($_GET['del']){
        CModule::IncludeModule("sale");
        
        $itemId = intval($_GET['del']);
        if ($itemId > 0) CSaleBasket::Delete($itemId);
    }

    if($_GET['clear']){
        CModule::IncludeModule("sale");
        
        $res = CSaleBasket::GetList(array(), array(
            'FUSER_ID' => CSaleBasket::GetBasketUserID(),
            'LID' => SITE_ID,
            'ORDER_ID' => 'null',
            'DELAY' => 'N',
            'CAN_BUY' => 'Y')
        );

        while ($row = $res->fetch()) {
            CSaleBasket::Delete($row['ID']);
        }
    }

    $this->IncludeComponentTemplate();