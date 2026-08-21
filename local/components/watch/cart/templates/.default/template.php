<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
use Bitrix\Catalog\Model\Price;

global $LENGUAGE;
require(__DIR__ . "/../../lang/$LENGUAGE/template.php");

// Получаем актуальную корзину пользователя
global $APPLICATION;
$basketItems = [];
$basketCount = 0;
$basketSum = 0;

if (CModule::IncludeModule("sale")) {
    // Получаем актуальные скидки для товаров в корзине
    $fUserId = CSaleBasket::GetBasketUserID();
    $productIds = [];
    $basketItemsRaw = [];

    // Сначала получим все товары корзины (без свойств) для применения скидок
    $dbBasketItemsForDiscount = CSaleBasket::GetList(
        array(),
        array(
            "FUSER_ID" => $fUserId,
            "LID" => SITE_ID,
            "ORDER_ID" => "NULL"
        ),
        false,
        false,
        array(
            "ID",
            "PRODUCT_ID",
            "NAME",
            "QUANTITY",
            "PRICE",
            "CURRENCY"
        )
    );

    while ($arItem = $dbBasketItemsForDiscount->Fetch()) {
        $productIds[] = $arItem["PRODUCT_ID"];
        $basketItemsRaw[$arItem["PRODUCT_ID"]] = $arItem;
    }

    // Применяем скидки к товарам корзины
    if (!empty($productIds) && CModule::IncludeModule("catalog") && CModule::IncludeModule("sale")) {
        $userGroups = $USER->GetUserGroupArray();
        foreach ($productIds as $pid) {
            $arPrice = CCatalogProduct::GetOptimalPrice($pid, $basketItemsRaw[$pid]['QUANTITY'], $userGroups, 'N');

            if ($LENGUAGE == 'ru') {
                if ($arPrice && isset($arPrice['RESULT_PRICE']['DISCOUNT_PRICE'])) {
                    $basketItemsRaw[$pid]['BASE_PRICE'] = $arPrice['RESULT_PRICE']['BASE_PRICE'];
                    $basketItemsRaw[$pid]['PRICE'] = $arPrice['RESULT_PRICE']['DISCOUNT_PRICE'];
                    $basketItemsRaw[$pid]['DISCOUNT'] = $arPrice['RESULT_PRICE']['DISCOUNT'];
                } else {
                    $basketItemsRaw[$pid]['BASE_PRICE'] = $basketItemsRaw[$pid]['PRICE'];
                    $basketItemsRaw[$pid]['DISCOUNT'] = 0;
                }
            } else {
                $basketItemsRaw[$pid]['BASE_PRICE'] = $arPrice['PRICE']['PRICE'];
                $basketItemsRaw[$pid]['DISCOUNT'] = 0;
            }
        }
    }

    // Теперь собираем массив basketItems с учетом скидок и свойств
    foreach ($basketItemsRaw as $arItem) {
        if (CModule::IncludeModule("iblock")) {
            $arSelectProps = array();
            $arFilterProps = array("ID" => $arItem["PRODUCT_ID"]);
            $resProps = CIBlockElement::GetList(array(), $arFilterProps, false, false, $arSelectProps);
            if ($obProps = $resProps->GetNextElement()) {
                $basketItems[] = array(
                    "ITEM" => $arItem,
                    "FIELDS" => $obProps->GetFields(),
                    "PROPS" => $obProps->GetProperties()
                );
            }
        }
        $basketCount += $arItem["QUANTITY"];
        $basketSum += $arItem["PRICE"] * $arItem["QUANTITY"];
    }
}
?>

<section class="cart">
    <div class="container cart-size top-mid bottom-mid first">
        <h2 class="cart-title uppercase"><?= count($basketItems) > 0 ? $MESS['CART'] : $MESS['EMPTY_CART_TEXT']; ?></h2>
        <?php if (count($basketItems) > 0) { ?>
            <p class="cart-count uppercase"><?= $basketCount; ?>     <?= $MESS['CART_COUNT']; ?></p>
        <?php } ?>

        <?php if (count($basketItems) > 0) { ?>
            <div class="grid">
                <div class="cart-list">
                    <?php
                    foreach ($basketItems as $item) {
                        ?>
                        <div class="cart-product">
                            <div class="cart-product__image">
                                <img src="<?= CFile::GetPath($item['FIELDS']['PREVIEW_PICTURE']); ?>" />
                            </div>
                            <div class="cart-product__content">
                                <p class="cart-product__code"><?= $item['PROPS']['ARTNUMBER']['VALUE']; ?></p>
                                <p class="cart-product__type">
                                    <?= $LENGUAGE == 'ru' ? $item['PROPS']['CALIBRE']['VALUE'] : $item['PROPS']['CALIBRE_ENG']['VALUE']; ?>
                                </p>
                                <h3 class="cart-product__name">
                                    <?= $LENGUAGE == 'ru' ? $item['FIELDS']['NAME'] : $item['PROPS']['NAME_ENG']['VALUE']; ?>
                                </h3>
                                <p class="cart-product__price"><?= number_format($item['ITEM']['PRICE'], 2, '.', ''); ?>
                                    <?= $LENGUAGE == 'ru' ? ' ₽' : ' €'; ?></p>
                                <div class="cart-product__count">
                                    <span><?= $MESS['QTY']; ?>:</span>
                                    <input value="<?= $item['ITEM']['QUANTITY']; ?>" type="number" min="1" step="1"
                                        data-id="<?= $item['ITEM']['ID']; ?>" />
                                    <a href="/cart/?del=<?= $item['ITEM']['ID']; ?>">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.375 3.75V16.5H14.625V3.75H3.375Z" stroke="black" stroke-opacity="0.85"
                                                stroke-width="1.5" stroke-linejoin="round" />
                                            <path d="M7.5 7.5V12.375" stroke="black" stroke-opacity="0.85" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M10.5 7.5V12.375" stroke="black" stroke-opacity="0.85" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M1.5 3.75H16.5" stroke="black" stroke-opacity="0.85" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M6 3.75L7.23337 1.5H10.7914L12 3.75H6Z" stroke="black"
                                                stroke-opacity="0.85" stroke-width="1.5" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="cart-summary">
                    <div class="cart-summary__wrapper">
                        <h2 class="cart-summary__title center uppercase"><?= $MESS['SUMMARY']; ?></h2>
                        <img class="cart-summary__payments pc" src="/images/summary_payment.svg" />
                        <img class="cart-summary__payments mob" src="/images/payment-cart_mob.svg" />

                        <!-- <div class="cart-summary__sum uppercase">
                            <div class="cart-summary__sum-name"><?= $MESS['SHIPPING_COST']; ?></div>
                            <div class="cart-summary__sum-payment">0 <?= $LENGUAGE == 'ru' ? '₽' : '€'; ?></div>
                        </div>
                        <div class="cart-summary__sum uppercase" style="display: none;">
                            <div class="cart-summary__sum-name"><?= $MESS['SUBTOTAL']; ?></div>
                            <div class="cart-summary__sum-payment">430 <?= $LENGUAGE == 'ru' ? '₽' : '€'; ?></div>
                        </div>
                        <div class="cart-summary__sum uppercase" style="display: none;">
                            <div class="cart-summary__sum-name"><?= $MESS['TAX']; ?></div>
                            <div class="cart-summary__sum-payment">0 <?= $LENGUAGE == 'ru' ? '₽' : '€'; ?></div>
                        </div> -->
                        <div class="cart-summary__sum uppercase">
                            <div class="cart-summary__sum-name"><?= $MESS['ORDER_TOTAL']; ?></div>
                            <div class="cart-summary__sum-payment"><?= number_format($basketSum, 2, '.', ''); ?>
                                <?= $LENGUAGE == 'ru' ? '₽' : '€'; ?></div>
                        </div>

                        <a class="cart-summary__buy center uppercase" href="/cart/order/">
                            <?= $MESS['PROCEED_TO_CHECKOUT']; ?> </a>
                    </div>

                    <a class="cart-summary__empty" href="/cart/?clear=1">
                        <?= $MESS['EMPTY_CART']; ?>
                        <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.875 3.75V16.5H15.125V3.75H3.875Z" stroke="black" stroke-opacity="0.85"
                                stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M8 7.5V12.375" stroke="black" stroke-opacity="0.85" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M11 7.5V12.375" stroke="black" stroke-opacity="0.85" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2 3.75H17" stroke="black" stroke-opacity="0.85" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6.5 3.75L7.73337 1.5H11.2914L12.5 3.75H6.5Z" stroke="black" stroke-opacity="0.85"
                                stroke-width="1.5" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<section class="to-catalog">
    <div class="container cart-size zero-padding bottom-five">
        <a href="/catalog/">
            <?= $LENGUAGE == 'ru' ? 'Продолжить покупки' : 'Continue shopping'; ?>
            <svg width="17" height="12" viewBox="0 0 17 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 5.99973H16M16 5.99973L11.2727 1.27246M16 5.99973L11.2727 10.727" stroke="white" />
            </svg>
        </a>
    </div>
</section>