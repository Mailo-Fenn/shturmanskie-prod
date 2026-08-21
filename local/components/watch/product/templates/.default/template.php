<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
    use Bitrix\Catalog\Model\Price;

    global $LENGUAGE, $USER;
    require(__DIR__."/../../lang/$LENGUAGE/template.php");	
	

    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url)[0];
    $url = explode('/', $url);
    $itemSlug = $url[count($url) - 2];
 
    CModule::IncludeModule('iblock');
    $arSelect = Array();
    $arFilter = Array("IBLOCK_ID"=>$LENGUAGE == "ru" ? 2 : 17, "ACTIVE"=>"Y", "CODE" => $itemSlug);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

    $ob = $res->GetNextElement();

    if(!$ob) {
        header('Location: /catalog/');
        exit;
    }

    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();

    $seoTitle = $arProps['TITLE']['VALUE'];
    $seoDesc = $arProps['META_DESCRIPTION']['VALUE'];
    if (empty($seoTitle)) {
        $seoTitle = $LENGUAGE == 'ru' ? "® Часы Штурманские - официальный сайт производителя" : "® Watches - Official Website";
        $seoTitle = $arFields['NAME'] .  " " . $seoTitle;
    }
    if (empty($seoDesc)) {
        if($LENGUAGE == 'ru'){
            $seoDesc = $arFields['NAME'] . " - часы лётчиков и космонавтов с 1949 года. Первые часы в космосе. Купить по цене от 9,500 руб. Доставка по всему миру!";
        }else{
            $seoDesc = $arProps['NAME_ENG']['VALUE'] . " - Pilot’s and Cosmonaut's watches since 1949. The First Watch in Space. Buy Online. Worldwide shipping! Official Manufacturer's Website";
        }
    }

    // Устанавливаем SEO данные страницы
    $APPLICATION->SetTitle($seoTitle);
    $APPLICATION->SetPageProperty("description", $seoDesc);

    //Add to cart
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'ADD2BASKET' && intval($_POST['id']) == $arFields['ID']) {
        if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog")) {
            $productId = intval($_POST['id']);
            $quantity = max(1, intval($_POST['quantity']));
            Add2BasketByProductID($productId, $quantity); 
        }
    }

    // Проверяем, есть ли этот товар в корзине
    $isInCart = false;
    $isInCartQuantity = 0;
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
            array("PRODUCT_ID", "QUANTITY")
        );
        while ($arBasketItem = $dbBasketItems->Fetch()) {
            if ($arBasketItem["PRODUCT_ID"] == $arFields["ID"]) {
                $isInCart = true;
                $isInCartQuantity = $arBasketItem["QUANTITY"];
                break;
            }
        }
    }
?>

<section class="product-info">
    <div class="container first">
        <div class="bread center">
            <?php
                $parentSection = false;
                
                $arSelect2 = Array("ID","NAME", "CODE", "DEPTH_LEVEL");	
                $res = CIBlockElement::GetElementGroups($arFields['ID'], true , $arSelect2);
                while($ob = $res->Fetch()){
                    if($ob['DEPTH_LEVEL'] == 1){
                        $parentSection = $ob;
                    }
                }
            ?>
            <div class="bread__wrapper">
                <a href="/catalog/"><?=$LENGUAGE == 'ru' ? 'Все часы' : 'All watches'; ?></a>
                <svg width="5" height="8" viewBox="0 0 5 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L4 4L1 7" stroke="#121212" />
                </svg> 
                <?php if($parentSection){ ?>
                    <?php
                        $name = explode('#', $parentSection['NAME']);
                    ?>
                    <a href="/catalog/<?=$parentSection['CODE'] ?>/"><?=$LENGUAGE == 'ru' ? $name[0] : $name[1] ?></a>
                    <svg width="5" height="8" viewBox="0 0 5 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L4 4L1 7" stroke="#121212" />
                    </svg> 
                <?php } ?>
                <?=$LENGUAGE == 'ru' ? $arFields['NAME'] : $arProps['NAME_ENG']['VALUE'] ?>
            </div> 
        </div>

        <div class="product-info__wrapper">
            <div class="product-info__image">
                <div class="product-info__slider">
                    <div class="product-info__slider-item">
                        <img src="<?=CFile::GetPath($arFields['DETAIL_PICTURE']) ?>" />
                    </div>
                    <? foreach($arProps['MORE_PHOTO']['VALUE'] as $item){ ?>
                        <div class="product-info__slider-item">
                            <img src="<?=CFile::GetPath($item) ?>" />
                        </div>
                    <? } ?>
                </div>
            </div>
            <div class="product-info__content">
                <?php
                    if($isInCart){
                        echo "<div class='add2basket-success'><span>".$MESS['ADDED_TO_CART']." (".$isInCartQuantity." ".($LENGUAGE == 'ru' ? 'шт.' : 'pcs').")</span></div>";
                    }
                ?> 

                <div class="product-info__code left-margin"><?=$arProps['ARTNUMBER']['VALUE']; ?></div>
                <div class="product-info__type left-margin"><?=$LENGUAGE == 'ru' ? $arProps['CALIBRE']['VALUE'] : $arProps['CALIBRE_ENG']['VALUE'] ?></div>

                <h1 class="product-info__title left-margin"><?=$LENGUAGE == 'ru' ? $arFields['NAME'] : $arProps['NAME_ENG']['VALUE'] ?></h1>

                <div class="product-info__cost left-margin">
                    <?php
                        $productId = $arFields['ID'];
                        $price = 0;
                        $base_price = 0;

                        if (CModule::IncludeModule("catalog")) { 
                            $arPrice = CCatalogProduct::GetOptimalPrice($productId, 1, $USER->GetUserGroupArray(), 'N');
                            if ($arPrice && isset($arPrice['RESULT_PRICE']['DISCOUNT_PRICE'])) {
                                if($LENGUAGE == 'ru') {
                                    $base_price = $arPrice['RESULT_PRICE']['BASE_PRICE'];
                                    $price = $arPrice['RESULT_PRICE']['DISCOUNT_PRICE'];
                                }
                                else {
                                    $base_price = $arPrice['PRICE']['PRICE'];
                                    $price = $arPrice['PRICE']['PRICE'];
                                }
                            }
                        }

                        $formattedPrice = number_format($price, 2, '.', '');
                        $formattedBasePrice = number_format($base_price, 2, '.', '');

                        if($LENGUAGE == 'ru'){
                            echo $formattedPrice." ₽";

                            if($price != $base_price){
                                echo ' <span class="product-info__cost-old">' . $formattedBasePrice . ' ₽</span>';
                            }
                        } else {
                            echo "€".$formattedPrice;

                            if($price != $base_price){
                                echo ' <span class="product-info__cost-old">€'.$formattedBasePrice.'</span>';
                            }
                        }
                    ?>
                </div>

                <?php
                    CModule::IncludeModule('iblock');

                    $subsection_id = false;
					$deep_lvl = 0;

                    $dbSections = CIBlockElement::GetElementGroups($arFields['ID'], true, array());
                    while ($arSection = $dbSections->Fetch()) {
						if($subsection_id == false)
                        	$subsection_id = $arSection['ID'];

                        if($arSection['DEPTH_LEVEL'] == 2){
                            $subsection_id = $arSection['ID'];
                        }
                    }
                    
                    $products = [];
        
                    if ($subsection_id) {
                        echo "<ul class='product-info__variants'>";
                            $arSelect = array("ID", "NAME", "DETAIL_PAGE_URL", "PREVIEW_PICTURE", "DETAIL_PICTURE");
                            $arFilter = array(
                                "IBLOCK_ID" => $LENGUAGE == "ru" ? 2 : 17, // Укажите нужный ID инфоблока
                                "SECTION_ID" => $subsection_id,
                                "ACTIVE" => "Y",
                            );
                            $res = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
                            while ($ob = $res->GetNextElement()) {
                                $arItem = $ob->GetFields();
							
								if((int) $arItem['PREVIEW_PICTURE'] > 0) {
									
									$photo = CFile::ResizeImageGet((int) $arItem['PREVIEW_PICTURE'], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
									
								?>
									<li class="<?=$arItem['ID'] == $arFields['ID'] ? 'active' : '' ?>">
										<a href="<?=$arItem['DETAIL_PAGE_URL'] ?>">
											<img src="<?=$photo['src'] ?>" />
										</a>
									</li>
									<?
								}
								?>
                <?php
                            }
                        echo "</ul>";
                    }
                ?>

                <div class="product-info__notification">
                    <div class="product-info__notification-item">
                        <?=$MESS['WORLDWIDE_DELIVERY'] ?>
                        <div class="product-info__notification-item__popup">
                            <?=$MESS['WORLDWIDE_DELIVERY_BODY'] ?>
                        </div>
                    </div>
                    <div class="product-info__notification-item">
                        <?=$MESS['SAFE_PAYMENT'] ?>
                        <div class="product-info__notification-item__popup">
                            <?=$MESS['SAFE_PAYMENT_BODY'] ?>
                            <img src="/images/popup-payment.svg" />
                        </div>
                    </div>
                </div>
 
                <form method="post" action="<?=POST_FORM_ACTION_URI?>" class="add-to-cart-form">
                    <input type="hidden" name="action" value="ADD2BASKET">
                    <input type="hidden" name="id" value="<?=$arFields['ID']?>">
                    <!--<input type="hidden" name="price_id" value="<?=$price_id?>">-->
                    <input type="hidden" name="quantity" value="1" min="1" max="1">           
                    <button class="product-info__button">
                        <?=$MESS['ADD_TO_CART']; ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
    if(
        (isset($arFields['~DETAIL_TEXT']) && $arFields['~DETAIL_TEXT'] != "") ||
        (isset($arProps['DESC_ENG']['~VALUE']['TEXT']) && $arProps['DESC_ENG']['~VALUE']['TEXT'] != "")
    ){
?>
        <section class="product-description dark">
            <div class="container hd-size top-ultra bottom-min">
                <div class="product-description__wrapper">
                    <h2 class="section-title"><?=$MESS['DESCRIPTION']; ?></h2>
                    <?if($LENGUAGE == 'ru') {
						if(isset($arFields['~DETAIL_TEXT']) && $arFields['~DETAIL_TEXT'] != '') {
						echo $arFields['~DETAIL_TEXT'];
						}
					}
					else {
						if(isset($arProps['DESC_ENG']['~VALUE']['TEXT']) && $arProps['DESC_ENG']['~VALUE']['TEXT'] != '') {
							echo $arProps['DESC_ENG']['~VALUE']['TEXT'];
						}
						else {
							if(isset($arFields['~DETAIL_TEXT']) && $arFields['~DETAIL_TEXT'] != '') {
								echo $arFields['~DETAIL_TEXT'];
							}
						}
					}	
					?>
                </div>
            </div>
        </section>
<?php } ?>

<?php if($arProps['VIDEO']['VALUE']){ ?>
    <section class="product-image dark">
        <div class="container top-min bottom-max center">
            <video class="product-video" controls poster="<?=CFile::GetPath($arProps['VIDEO_POSTER']['VALUE'])?>">
                <source src="<?=CFile::GetPath($arProps['VIDEO']['VALUE'])?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </section>
<?php } ?>

<section class="product-feautures dark">
    <div class="container hd-size bottom-max top-max">
        <h2 class="section-title"> <?=$MESS['TECHNICAL_FEATURES'] ?> </h2>

        <?php
            $arFeatures = [
                [
                    'NAME' => $LENGUAGE == 'ru' ? 'Диаметр' : 'Diameter',
                    'VALUE' => $arProps['DIAMETER']['VALUE']
                ],
                [
                    'NAME' => $LENGUAGE == 'ru' ? 'Цвет циферблата' : 'Dial colour',
                    'VALUE' => $arProps['DIAL_COLOR']['VALUE']
                ],
                [
                    'NAME' => $LENGUAGE == 'ru' ? 'Подсветка' : 'Backlight',
                    'VALUE' => $arProps['BACKLIGHT']['VALUE']
                ],
                [
                    'NAME' => $LENGUAGE == 'ru' ? 'Серия' : 'Series',
                    'VALUE' => $arProps['SERIES']['VALUE']
                ],
                [
                    'NAME' => $LENGUAGE == 'ru' ? 'Пал' : 'Paul',
                    'VALUE' => $arProps['PAUL']['VALUE']
                ],
                [
                    'NAME' => $LENGUAGE == 'ru' ? 'Страна' : 'Country',
                    'VALUE' => $arProps['COUNTRY']['VALUE']
                ],
                [
                    'NAME' => $LENGUAGE == 'ru' ? 'РРЦ' : 'RRC',
                    'VALUE' => $arProps['RRC']['VALUE']
                ],
                [
                    'NAME' => $LENGUAGE == 'ru' ? 'Модельный ряд' : 'Model series',
                    'VALUE' => $arProps['MODEL_RANGE']['VALUE']
                ],
                [
                    'NAME' => $LENGUAGE == 'ru' ? 'Материал ремешка' : 'Bracelet strap',
                    'VALUE' => $arProps['STRAP_MATERIAL']['VALUE']
                ],
                [
                    'NAME' => $LENGUAGE == 'ru' ? 'Калибр' : 'Calibre',
                    'VALUE' => $arProps['CL_S']['VALUE']
                ],
                [
                    'NAME' => $LENGUAGE == 'ru' ? 'Стекло' : 'Glass',
                    'VALUE' => $arProps['GLASS']['VALUE']
                ],
                [
                    'NAME' => $LENGUAGE == 'ru' ? 'Тип механизма' : 'Mechanism type',
                    'VALUE' => $arProps['TYPE_MECHANISM']['VALUE']
                ],
                [
                    'NAME' => $LENGUAGE == 'ru' ? 'Гарантия' : 'Warranty',
                    'VALUE' => $arProps['GUARANTEE']['VALUE']
                ],
                [
                    'NAME' => $LENGUAGE == 'ru' ? 'Производитель' : 'Manufacturer',
                    'VALUE' => $arProps['MANUFACTURER']['VALUE']
                ],
                [
                    'NAME' => $LENGUAGE == 'ru' ? 'Бренд' : 'Brand',
                    'VALUE' => $arProps['BRAND']['VALUE']
                ],
                [
                    'NAME' => $LENGUAGE == 'ru' ? 'Водонепроницаемость' : 'Water resistance',
                    'VALUE' => $arProps['WATER_RESISTANCE']['VALUE']
                ],
                [
                    'NAME' => $LENGUAGE == 'ru' ? 'Материал корпуса' : 'Case material',
                    'VALUE' => $arProps['BODY_MATERIAL']['VALUE']
                ],
            ];

            // Фильтруем arFeatures, оставляя только элементы с непустым VALUE
            $arFeatures = array_filter($arFeatures, function($feature) {
                return !empty($feature['VALUE']);
            });

            // Разбиваем $arFeatures на 2 подмассива примерно поровну
            $featuresCount = count($arFeatures);
            $half = ceil($featuresCount / 2);
            $arFeaturesCol1 = array_slice($arFeatures, 0, $half);
            $arFeaturesCol2 = array_slice($arFeatures, $half);
        ?>

        <div class="product-feautures__grid">
            <div class="product-feautures__grid-column">
                <? 
                    foreach($arFeaturesCol1 as $item){ 
                        $value = explode('#eng#', $item['VALUE']);
                ?>
                        <div class="product-feautures__item">
                            <span><?=$item['NAME'] ?></span>
                            <span><?=$LENGUAGE == 'ru' ? $value[0] : $value[1] ?></span>
                        </div>
                <? } ?> 
            </div>
            <div class="product-feautures__grid-column">
                <? 
                    foreach($arFeaturesCol2 as $item){ 
                        $value = explode('#eng#', $item['VALUE']);
                ?>
                        <div class="product-feautures__item">
                            <span><?=$item['NAME'] ?></span>
                            <span><?=$LENGUAGE == 'ru' ? $value[0] : $value[1] ?></span>
                        </div>
                <? } ?> 
            </div>
        </div>
    </div>
</section>

<section class="product-castom">
    <div class="container zero-padding">
        <div class="product-castom__grid">
            <div class="product-castom__content">
                <div class="product-castom__content-wrapper">
                    <h3 class="section-title"><?=$MESS['CUSTOM_TITLE'] ?></h3>
                    <?=$MESS['CUSTOM_TEXT'] ?>
                    <a class="btn" href="/custom-watches/">
                        <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="1" y="1" width="88" height="88" rx="44" stroke="#FF662C" stroke-width="2"></rect>
                            <path d="M40.5 35L49.5 46.0556L40.5 55" stroke="black" stroke-width="2"></path>
                        </svg>
                        <div class="vertical-center">
                            <div><?=$MESS['MORE']; ?></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="product-castom__image" style="background-image: url('/images/castom-mode.png');"></div>
        </div>
    </div>
</section>

<? if($arProps['DOP_IMAGE']['VALUE']){ ?>
    <section class="product-dopimage dark">
        <div class="container top-min bottom-min">
            <div class="product-dopimage__grid">
                <? foreach($arProps['DOP_IMAGE']['VALUE'] as $item){ ?>
                    <div>
                        <img src="<?=CFile::GetPath($item) ?>" />
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<? } ?>

<section class="product-castom">
    <div class="container zero-padding">
        <div class="product-castom__grid">
            <div class="product-castom__content">
                <div class="product-castom__content-wrapper">
                    <h3 class="section-title">Найти бутик или авторизованный магазин рядом с вами</h3>
                    <p>
					От Москвы и Петербурга до Владивостока – 36 представительств в России и в 8 представительств по всему миру (Часы Штурманские имеют официальные представительства в Японии, Германии, Сингапуре и т.д.
					</p>
					<br />
					<a class="btn" href="/retailers/">
						<svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect x="1" y="1" width="88" height="88" rx="44" stroke="#FF662C" stroke-width="2"></rect>
							<path d="M40.5 35L49.5 46.0556L40.5 55" stroke="black" stroke-width="2"></path>
						</svg>
						<div class="vertical-center">
							<div>Найти магазин</div>
						</div>
					</a>
					<br /><br />
					<div class="shop-email">
						<p>Хотите стать авторизованными дилерами часов</p>
						<p>Штурманские – <a class="email-link" href="mailto:info@sturmanskie.ru" style="color: #ff662c; border-bottom: #ff662c;">напишите нам</a></p>
					</div>
                </div>
            </div>
            <div class="product-castom__image" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/images/service-shop-bg.jpg');"></div>
        </div>
    </div>
</section>


<section class="category-slider product-category product-links">
    <div class="container top-mid bottom-mid">
        <h2 class="category-title">
			<?
			if($LENGUAGE == 'ru') {
				echo 'ДРУГИЕ ЧАСЫ ШТУРМАНСКИЕ';
			}
			else {
				echo 'OTHER WATCHES STURMANSKIE';
			}
			?>           
        </h2>
       
		<div class="other-slider__slick">
			<?php
				$arSelect = Array('ID', 'NAME', 'CODE', 'DETAIL_PICTURE', 'PROPERTY_LINK');  
				$arFilter = Array(
					"IBLOCK_ID"=>19, 
					"ACTIVE"=>"Y"					
				);  
				
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);  
				while($ob = $res->GetNext()) {
					
					if((int) $ob['DETAIL_PICTURE'] > 0) {
						
						$photo = CFile::ResizeImageGet((int) $ob['DETAIL_PICTURE'], array('width'=>400, 'height'=>454), BX_RESIZE_IMAGE_EXACT, true);
				?>
					<div>
						<a class="category-slider__item"<?
						if(isset($ob['PROPERTY_LINK_VALUE']) && $ob['PROPERTY_LINK_VALUE'] != '') {
							echo ' href="'.$ob['PROPERTY_LINK_VALUE'].'"';
						}
						?>>
							<div class="category-slider__item-image vertical-center" style="height: 454px !important; background-color: #ffffff !important;">
								<img src="<?=$photo['src'];?>" style="max-height: 454px; height: 454px;" />
							</div>							
						</a>
					</div>
				<?php
					}
				
				}     
			?>
		</div>
    </div>
</section>



<section class="category-slider product-category product-links">
    <div class="container top-mid bottom-mid">
        <h2 class="category-title">
            <?=$MESS['FEATURED'] ?>
        </h2>
        <? require($_SERVER["DOCUMENT_ROOT"]."/include/collection.php"); ?>
    </div>
</section>

<section class="catalog-banner product-banner bottom dark">
    <div class="container grid top-mid">
        <? require($_SERVER["DOCUMENT_ROOT"]."/include/bottom_banner.php"); ?>
    </div>
</section>