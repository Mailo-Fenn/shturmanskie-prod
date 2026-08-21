<?php
    if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true){
	    die();
    }

    use Bitrix\Main\Localization\Loc;

    /**
        * @global CMain $APPLICATION
        * @var array $arParams
        * @var array $item
        * @var array $actualItem
        * @var array $minOffer
        * @var array $itemIds
        * @var array|null $price
        * @var float|int|null $measureRatio
        * @var bool $haveOffers
        * @var bool $showSubscribe
        * @var array $morePhoto
        * @var bool $showSlider
        * @var bool $itemHasDetailUrl
        * @var string $imgTitle
        * @var string $productTitle
        * @var string $buttonSizeClass
        * @var string $discountPositionClass
        * @var string $labelPositionClass
        * @var CatalogSectionComponent $component
    */

    global $LENGUAGE;
    global $USER;
?>

<?php
    $rsUser = CUser::GetByID($USER->GetID());
    $arUser = $rsUser->Fetch();

    $favoriteProducts = $arUser["UF_FAVORITE_PRODUCTS"];
    if (!is_array($favoriteProducts)) {
        $favoriteProducts = [];
    }
?>
 
  


<a href="<?=$item['DETAIL_PAGE_URL']?>"> 
    <div class="catalog-list__item-image">
        <div class="catalog-list__item-image-like <?=in_array($item['ID'], $favoriteProducts) ? 'active' : ''?>" data-id="<?=$item['ID']?>">
            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.5413 4.98311C15.6931 4.14427 14.5686 3.63229 13.3712 3.53965C12.1737 3.44702 10.9821 3.77983 10.0116 4.47797C8.9935 3.73103 7.72624 3.39233 6.46507 3.53008C5.20389 3.66783 4.04247 4.2718 3.21468 5.22036C2.3869 6.16892 1.95424 7.39162 2.00384 8.64223C2.05343 9.89284 2.5816 11.0785 3.48197 11.9603L8.45124 16.8697C8.86736 17.2736 9.42779 17.5 10.0116 17.5C10.5955 17.5 11.1559 17.2736 11.572 16.8697L16.5413 11.9603C17.4756 11.0332 18 9.779 18 8.47173C18 7.16447 17.4756 5.91031 16.5413 4.98311ZM15.413 10.8711L10.4437 15.7726C10.3872 15.8289 10.3199 15.8736 10.2457 15.9041C10.1716 15.9346 10.092 15.9503 10.0116 15.9503C9.93127 15.9503 9.85171 15.9346 9.77754 15.9041C9.70337 15.8736 9.63607 15.8289 9.57952 15.7726L4.61026 10.8475C3.98271 10.2147 3.6313 9.36478 3.6313 8.47962C3.6313 7.59447 3.98271 6.74451 4.61026 6.11178C5.24975 5.48903 6.11222 5.13984 7.01087 5.13984C7.90952 5.13984 8.77199 5.48903 9.41148 6.11178C9.48587 6.18576 9.57437 6.24448 9.67188 6.28455C9.7694 6.32462 9.87399 6.34525 9.97962 6.34525C10.0853 6.34525 10.1899 6.32462 10.2874 6.28455C10.3849 6.24448 10.4734 6.18576 10.5478 6.11178C11.1873 5.48903 12.0497 5.13984 12.9484 5.13984C13.847 5.13984 14.7095 5.48903 15.349 6.11178C15.9852 6.73622 16.3481 7.58157 16.3601 8.46675C16.372 9.35192 16.0321 10.2065 15.413 10.8475V10.8711Z" fill="#808080" />
            </svg>
        </div>
        <? if($item['PROPERTIES']['NEWPRODUCT']['VALUE'] == 'да'){ ?>
            <div class="catalog-list__item-image-sticker">
                <span>Новинка</span>
            </div>
        <? } ?>
        <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" />
    </div>

    <div class="catalog-list__item-content">
        <p class="code"><?=$item['PROPERTIES']['ARTNUMBER']['VALUE']; ?></p>
        <p class="type"><?=$LENGUAGE == 'ru' ? $item['PROPERTIES']['CALIBRE']['VALUE'] : $item['PROPERTIES']['CALIBRE_ENG']['VALUE']; ?></p>
        <h3 class="name"><?=$item['NAME']; ?></h3>
        <p class="price">
            <?php
                $displayPrice = $price['PRICE'];
                $basePrice = $price['BASE_PRICE'];

                if($LENGUAGE != "ru"){
                    echo '€' . $displayPrice;
                } else {
                    echo $displayPrice . '₽';
                }

                if($price['DISCOUNT'] > 0){
                    echo '<span class="price-old">';
                        if($LENGUAGE != "ru"){
                            echo '€' . $basePrice;
                        } else {
                            echo $basePrice . '₽';
                        }
                    echo '</span>';
                }
            ?>
        </p>
    </div> 
</a>
