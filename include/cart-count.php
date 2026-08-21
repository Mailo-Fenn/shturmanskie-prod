<?php
    if (CModule::IncludeModule("sale")){
        $arBasketItems = array();
        $dbBasketItems = CSaleBasket::GetList(
            array("NAME" => "ASC","ID" => "ASC"),
            array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"),
            false,
            false,
            array("ID","MODULE","PRODUCT_ID","QUANTITY",)
        );
        
        while ($arItems=$dbBasketItems->Fetch()){
            $arItems=CSaleBasket::GetByID($arItems["ID"]);
            $arBasketItems[]=$arItems;   
            $cart_num+=$arItems['QUANTITY'];
        }
        
        if (empty($cart_num))
            $cart_num="0";

        echo $cart_num;
    }