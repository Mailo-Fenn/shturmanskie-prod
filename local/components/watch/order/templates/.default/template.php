<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
    use Bitrix\Catalog\Model\Price;

    global $LENGUAGE;
    require(__DIR__."/../../lang/$LENGUAGE/template.php");   

// Получаем актуальную корзину пользователя
    global $APPLICATION;
    $basketItems = [];
    $basketCount = 0;
    $basketSum = 0;

    if (CModule::IncludeModule("sale")) {
        $fUserId = CSaleBasket::GetBasketUserID();
        $dbBasketItems = CSaleBasket::GetList(
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
                "CURRENCY", 
                "DETAIL_PAGE_URL", 
                "CAN_BUY", 
                "DELAY", 
                "LID", 
                "BASE_PRICE"
            )
        );
        while ($arItem = $dbBasketItems->Fetch()) {
            if (CModule::IncludeModule("iblock")) {
                $arSelectProps = Array();
                $arFilterProps = Array("ID" => $arItem["PRODUCT_ID"]);
                $resProps = CIBlockElement::GetList(Array(), $arFilterProps, false, false, $arSelectProps);
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

    $userInfo = getUserInfo();
?>
 
 
 <section class="checkout">
    <div class="container zero-padding first">
        <form method="POST">
            <div class="checkout-grid">
                <div class="checkout-form form">
                    <h2 class="section-title"><?=$MESS['CHECKOUT']; ?></h2>                   
                    <h3 class="margened-title"><?=$MESS['SHIPPING_ADRESS']; ?></h3>
                    <div class="login-inputs">
                        <label>
                            <span><?=$MESS['FIRST_NAME']; ?>*</span>
                            <input name="fname" placeholder="<?=$MESS['FIRST_NAME']; ?>" value="<?=$userInfo['UF_FNAME']; ?>" required>
                        </label>
        
                        <label>
                            <span><?=$MESS['LAST_NAME']; ?>*</span>
                            <input name="lname" placeholder="<?=$MESS['LAST_NAME']; ?>" value="<?=$userInfo['UF_LNAME']; ?>" required>
                        </label>
        
                        <label>
                            <span><?=$MESS['EMAIL']; ?>*</span>
                            <input name="email" type="email" placeholder="<?=$MESS['EMAIL']; ?>" value="<?=$userInfo['UF_EMAIL']; ?>" required>
                        </label>
        
                        <label>
                            <span><?=$MESS['PHONE']; ?>*</span>
                            <input name="phone" placeholder="<?=$MESS['YOUR_PHONE']; ?>" value="<?=$userInfo['UF_PHONE']; ?>" required />
                        </label>

                        <div class="country-list address-input">
                        <label>
                            <span><?=$MESS['COUNTRY']; ?>*</span>
                                <input name="country" class="country-input" placeholder="<?=$MESS['STATE']; ?>" value="<?=$userInfo['UF_LOCATION']; ?>" required />
                            </label>
                            <div class="country-list__list address-input__list" style="display: none"></div>
                        </div>
                        </label>

                        <div class="city-list address-input">
                            <label>
                                <span><?=$MESS['CITY']; ?>*</span>
                                <input name="city" class="city-input" placeholder="<?=$MESS['CITY']; ?>" value="<?=$userInfo['UF_CITY']; ?>" required />
                            </label>
                            <div class="city-list__list address-input__list" style="display: none"></div>
                        </div>

                        <label>
                            <span><?=$MESS['ADRESS']; ?> 1*</span>
                            <input name="address" placeholder="<?=$MESS['ENTER_ADRESS']; ?>" value="<?=$userInfo['UF_ADRESS']; ?>" required>
                        </label>
        
                        <label>
                            <span><?=$MESS['ADRESS']; ?> 2 (<?=$MESS['OPTIONAL']; ?>)</span>
                            <input name="address2" placeholder="<?=$MESS['ENTER_ADRESS']; ?>">
                        </label>
        
                        <label>
                            <span><?=$MESS['POSTAL_CODE']; ?>*</span>
                            <input name="postal_code" placeholder="<?=$MESS['YOUR_POSTAL_CODE']; ?>" value="<?=$userInfo['UF_POSTAL_CODE']; ?>" required />
                        </label>
 
                        <div class="checkout-delivery checkout-section"> 
                            <h2 class="section-title"><?=$MESS['DELIVERY']; ?></h2>
                            <div class="checkout-section__list">   
                                <label>
                                    <div>
                                        <img src="/images/truck.svg" />
                                    </div>
                                    <p><?=$LENGUAGE == 'ru' ? 'Доставка Курьером' : 'Delivery by courier'; ?></p>
                                    <input type="radio" name="delivery" value="2" checked />
                                </label>

								<label>
                                    <div>
                                        <img src="https://static.boomin.ru/upload/company/logos/d84/sdeklogo.png" />
                                    </div>
                                    <p><?=$LENGUAGE == 'ru' ? 'СДЭК(Доставка курьером (СДЕК))' : 'Delivery by courier'; ?></p>
                                    <input type="radio" name="delivery" value="8" />
                                </label>

								<label>
                                    <div>
                                        <img src="https://static.boomin.ru/upload/company/logos/d84/sdeklogo.png" />
                                    </div>
                                    <p><?=$LENGUAGE == 'ru' ? 'СДЭК(Самовывоз (СДЕК))' : 'Delivery by courier'; ?></p>
                                    <input type="radio" name="delivery" value="9" />
                                </label>
                            </div>
                        </div>

                        <div class="checkout-payment checkout-section">
                            <h2 class="section-title"><?=$MESS['PAYMENT_METHOD']; ?></h2>
                            <div class="checkout-section__list">
								<label>
                                    <div>
                                        <img src="/upload/sale/paysystem/logotip/06d/3jql17d64740tdunhnr9vbh2mg5y4aq0.jpg" />
                                    </div>
                                    <p><?=$LENGUAGE == 'ru' ? 'Рассрочка от Сбербанка' : 'Cash'; ?></p>
                                    <input type="radio" name="payment" value="9" checked />
                                </label> 

								<label>
                                    <div>
                                        <img src="/upload/sale/paysystem/logotip/ad2/vjtrdy3hw4vrhux2e2g046pq00dme6zd.gif" />
                                    </div>
                                    <p><?=$LENGUAGE == 'ru' ? 'Онлайн оплата (картой)' : 'Cash'; ?></p>
                                    <input type="radio" name="payment" value="10" />
                                </label>

								<label>
                                    <div>
                                        <img src="/upload/sale/paysystem/logotip/5b3/lm842lz7vyu5oqbq3k7o8ouajsvowcfr.png" />
                                    </div>
                                    <p><?=$LENGUAGE == 'ru' ? 'Сплит—оплата частями' : 'Cash'; ?></p>
                                    <input type="radio" name="payment" value="12" />
                                </label>  
                            </div>
                        </div>
                    </div> 
                </div>

                <div class="checkout-summary">
                    <div class="checkout-summary__wrapper">
                        <h2 class="section-title"><?=$MESS['ORDER_SUMMARY']; ?></h2>
                        <div class="checkout-summary__list">
                            <?php foreach($basketItems as $item){ ?> 
                                <div class="checkout-summary__product">
                                    <div class="checkout-summary__product-image">
                                        <img src="<?=CFile::GetPath($item['FIELDS']['PREVIEW_PICTURE']); ?>" />
                                    </div>
                                    <div class="checkout-summary__product-content">
                                        <h3 class="checkout-summary__product-name"><?=$LENGUAGE == 'ru' ? $item['FIELDS']['NAME'] : $item['PROPS']['NAME_ENG']['VALUE']; ?></h3>
                                        <p class="checkout-summary__product-price"><?=number_format($item['ITEM']['PRICE'], 2, '.', ''); ?> <?=$LENGUAGE == 'ru' ? '₽' : '€'; ?></p>
                                        <div class="checkout-summary__product-count">
                                            <span><?=$MESS['QTY']; ?>:</span>
                                            <input type="number" min="1" step="1" value="<?=$item['ITEM']['QUANTITY']; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="cart-summary__sum uppercase">
                            <div class="cart-summary__sum-name"><?=$MESS['SHIPPING_COST']; ?></div>
                            <div class="cart-summary__sum-payment"><span>0</span> <?=$LENGUAGE == 'ru' ? '₽' : '€'; ?></div>
                        </div>

                        <div class="cart-summary__sum uppercase">
                            <div class="cart-summary__sum-name"><?=$MESS['SUBTOTAL']; ?></div>
                            <div class="cart-summary__sum-payment"><span><?=number_format($basketSum, 2, '.', ''); ?></span> <?=$LENGUAGE == 'ru' ? '₽' : '€'; ?></div>
                        </div>

                        <div class="cart-summary__sum uppercase" style="display: none;">
                            <div class="cart-summary__sum-name"><?=$MESS['TAX']; ?></div>
                            <div class="cart-summary__sum-payment"><span>0</span> <?=$LENGUAGE == 'ru' ? '₽' : '€'; ?></div>
                        </div>

                        <div class="cart-summary__sum uppercase">
                            <div class="cart-summary__sum-name"><?=$MESS['ORDER_TOTAL']; ?></div>
                            <div class="cart-summary__sum-payment"><span><?=number_format($basketSum, 2, '.', ''); ?></span> <?=$LENGUAGE == 'ru' ? '₽' : '€'; ?></div>
                        </div>

                        <label class="last checkbox">
                            <input type="checkbox" required />
                            <div><?=$MESS['PERSONAL_DATA']; ?></div>
                        </label>

                        <label class="last checkbox" style="margin-top: 20px;">
                            <input type="checkbox" required />
                            <div style="line-height: 17px;">
                                <?=$MESS['AGREEMENT']; ?>
                            </div>
                        </label>
                        <button class=""><?=$MESS['ORDER']; ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?php
    function getUserInfo(){
        global $USER; 

        $arResult = array(
            'UF_FNAME' => '',
            'UF_LNAME' => '',
            'UF_PHONE' => '',
            'UF_EMAIL' => '',
            'UF_LOCATION' => '',
            'UF_CITY' => '',
            'UF_ADRESS' => '',
            'UF_POSTAL_CODE' => '',
        );

        if ($USER->IsAuthorized()) {
            $userId = $USER->GetID();
            $rsUser = CUser::GetByID($userId);
            if ($arUser = $rsUser->Fetch()) {
                $arResult = array(
                    'UF_FNAME' => $arUser['UF_FNAME'],
                    'UF_LNAME' => $arUser['UF_LNAME'],
                    'UF_PHONE' => $arUser['UF_PHONE'],
                    'UF_EMAIL' => $arUser['EMAIL'],
                    'UF_LOCATION' => $arUser['UF_LOCATION'],
                    'UF_CITY' => $arUser['UF_CITY'],
                    'UF_ADRESS' => $arUser['UF_ADRESS'],
                    'UF_POSTAL_CODE' => $arUser['UF_POSTAL_CODE'],
                );
            }
        }

        return $arResult;
    }
 