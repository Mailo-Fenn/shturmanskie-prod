<?php
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

    global $USER;

    if($_GET['id'] && $_GET['quantity']){
        $itemId = intval($_GET['id']);
        $quantity = intval($_GET['quantity']);

        if ($itemId > 0 && $quantity > 0) {
            if (CModule::IncludeModule("sale")) {
                $arFields = array(
                    "QUANTITY" => $quantity
                );
                $result = CSaleBasket::Update($itemId, $arFields);
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Quantity updated']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update quantity']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Sale module not included']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid item id or quantity']);
        }
    }
