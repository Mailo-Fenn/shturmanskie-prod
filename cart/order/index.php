<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>

<section class="checkout">
    <? $APPLICATION->IncludeComponent(
        "bitrix:sale.order.ajax",
        "main",
        [
            "PAY_FROM_ACCOUNT" => "Y",
            "COUNT_DELIVERY_TAX" => "N",
            "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
            "ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
            "ALLOW_AUTO_REGISTER" => "Y",
            "SEND_NEW_USER_NOTIFY" => "Y",
            "DELIVERY_NO_AJAX" => "N",
            "TEMPLATE_LOCATION" => "popup",
            "PROP_1" => "",
            "PATH_TO_BASKET" => "/cart/",
            "PATH_TO_PERSONAL" => "/cart/order/",
            "PATH_TO_PAYMENT" => "/cart/order/payment/",
            "PATH_TO_ORDER" => "/cart/order/",
            "SET_TITLE" => "Y",
            "SHOW_ACCOUNT_NUMBER" => "Y",
            "DELIVERY_NO_SESSION" => "Y",
            "COMPATIBLE_MODE" => "N",
            "BASKET_POSITION" => "before",
            "BASKET_IMAGES_SCALING" => "adaptive",
            "SERVICES_IMAGES_SCALING" => "adaptive",
            "USER_CONSENT" => "Y",
            "USER_CONSENT_ID" => "1",
            "USER_CONSENT_IS_CHECKED" => "Y",
            "USER_CONSENT_IS_LOADED" => "Y",
            "SHOW_TOTAL_ORDER_BUTTON" => "Y",
            "COMPONENT_TEMPLATE" => "main",
            "ALLOW_APPEND_ORDER" => "Y",
            "SHOW_NOT_CALCULATED_DELIVERIES" => "L",
            "SPOT_LOCATION_BY_GEOIP" => "Y",
            "DELIVERY_TO_PAYSYSTEM" => "d2p",
            "SHOW_VAT_PRICE" => "Y",
            "USE_PREPAYMENT" => "Y",
            "USE_PRELOAD" => "Y",
            "ALLOW_USER_PROFILES" => "N",
            "ALLOW_NEW_PROFILE" => "N",
            "TEMPLATE_THEME" => "site",
            "SHOW_ORDER_BUTTON" => "final_step",
            "SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
            "SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
            "SHOW_DELIVERY_LIST_NAMES" => "Y",
            "SHOW_DELIVERY_INFO_NAME" => "Y",
            "SHOW_DELIVERY_PARENT_NAMES" => "Y",
            "SHOW_STORES_IMAGES" => "Y",
            "SKIP_USELESS_BLOCK" => "Y",
            "SHOW_BASKET_HEADERS" => "N",
            "DELIVERY_FADE_EXTRA_SERVICES" => "N",
            "SHOW_NEAREST_PICKUP" => "N",
            "DELIVERIES_PER_PAGE" => "9",
            "PAY_SYSTEMS_PER_PAGE" => "9",
            "PICKUPS_PER_PAGE" => "5",
            "SHOW_PICKUP_MAP" => "Y",
            "SHOW_MAP_IN_PROPS" => "N",
            "PICKUP_MAP_TYPE" => "yandex",
            "SHOW_COUPONS" => "Y",
            "SHOW_COUPONS_BASKET" => "Y",
            "SHOW_COUPONS_DELIVERY" => "Y",
            "SHOW_COUPONS_PAY_SYSTEM" => "Y",
            "PROPS_FADE_LIST_1" => [
            ],
            "ACTION_VARIABLE" => "soa-action",
            "PATH_TO_AUTH" => "/auth/",
            "DISABLE_BASKET_REDIRECT" => "N",
            "EMPTY_BASKET_HINT_PATH" => "/",
            "USE_PHONE_NORMALIZATION" => "Y",
            "PRODUCT_COLUMNS_VISIBLE" => [
                0 => "PREVIEW_PICTURE",
                1 => "PROPS",
            ],
            "ADDITIONAL_PICT_PROP_2" => "-",
            "PRODUCT_COLUMNS_HIDDEN" => [
            ],
            "HIDE_ORDER_DESCRIPTION" => "N",
            "USE_YM_GOALS" => "N",
            "USE_ENHANCED_ECOMMERCE" => "N",
            "USE_CUSTOM_MAIN_MESSAGES" => "N",
            "USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
            "USE_CUSTOM_ERROR_MESSAGES" => "N"
        ],
        false
    ); ?>
</section>

<style>
    label[data-property-id-row="5"] {
        display: none;
    }
</style>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>