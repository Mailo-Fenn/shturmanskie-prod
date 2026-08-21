<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $USER;

if (!$USER->IsAuthorized()) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Пользователь не авторизован']);
    exit;
}

$userId = $USER->GetID();
$productId = (int)$_REQUEST["id"];

$rsUser = CUser::GetByID($userId);
$arUser = $rsUser->Fetch();

$favoriteProducts = $arUser["UF_FAVORITE_PRODUCTS"];
if (!is_array($favoriteProducts)) {
    $favoriteProducts = [];
}

$status = 'added';
if (!in_array($productId, $favoriteProducts)) {
    $favoriteProducts[] = $productId;
} else {
    $favoriteProducts = array_diff($favoriteProducts, [$productId]);
    $status = 'removed';
}

$USER->Update($userId, ['UF_FAVORITE_PRODUCTS' => $favoriteProducts]);

echo json_encode(['status' => $status, 'message' => '']);
