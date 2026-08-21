<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Каталог");

if(!function_exists('viewArray')){
	function viewArray($arr) {
		
		$keys = array_keys($arr);
		$kLen = count($keys);
		
		for($i = 0; $i < $kLen; $i++) {
			
			echo '['.$keys[$i].'] - '.$arr[$keys[$i]].'<br />';
			
		}
		
		echo '<hr />';
		
	}
}

?>

<section class="catalog-category category-slider">
    <div class="container bottom-ultra first">
        <div class="bread center">
            <div class="bread__wrapper">
                <a href="">Часы</a>
                <svg width="5" height="8" viewBox="0 0 5 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L4 4L1 7" stroke="#121212" />
                </svg>
                Все часы
            </div>
            <h2 class="bread__title uppercase">Все часы</h2>
        </div>

        <h2 class="category-title">
            Коллекции
        </h2>
        <? require($_SERVER["DOCUMENT_ROOT"] . "/include/collection.php"); ?>
    </div>
</section>

<section class="catalog-list">
    <div class="container top-min">
        <?php
        $GLOBALS['arrFilter'] = array();
        $GLOBALS['arrFilter']['NAME'] = "%" . $_GET['s'] . "%";

        if (isset($_GET['stock']) && $_GET['stock'] == '1') {
            $GLOBALS['arrFilter']['>CATALOG_QUANTITY'] = 0;
        }

        if (isset($_GET['new']) && $_GET['new'] == 'on') {
            $GLOBALS['arrFilter']['PROPERTY_NEWPRODUCT_VALUE'] = 'да';
        }
		
		if (isset($_GET['archive']) && $_GET['archive'] == 'on') {
            $GLOBALS['arrFilter']['PROPERTY_ARCHIVE_VALUE'] = 'да';
        }

        if (
            (
                (isset($_GET['collection']) && $_GET['collection'] != "") ||
                (isset($_GET['model']) && $_GET['model'] != "")
            ) &&
            $_GET['collection'] != 'Все'
        ) {
            if (isset($_GET['model']) && $_GET['model'] != "") {
                $section_target = $_GET['model'];
            } else {
                $section_target = $_GET['collection'];
            }
        }
		
		
		if (isset($_GET['man']) && $_GET['man'] == 'on' ||
		isset($_GET['woman']) && $_GET['woman'] == 'on' ||
		isset($_GET['limited']) && $_GET['limited'] == 'on' ||
		isset($_GET['titan']) && $_GET['titan'] == 'on' ||
		isset($_GET['mechan']) && $_GET['mechan'] == 'on' ||
		isset($_GET['chrono']) && $_GET['chrono'] == 'on' ||
		isset($_GET['winding']) && $_GET['winding'] == 'on'	
		) {
			
			$cats = [];
			if (isset($_GET['man']) && $_GET['man'] == 'on') {
				$cats[] = 'Мужские';
			}
			if (isset($_GET['woman']) && $_GET['woman'] == 'on') {
				$cats[] = 'Женские';
			}
			if (isset($_GET['limited']) && $_GET['limited'] == 'on') {
				$cats[] = 'Автоматические';
			}
			if (isset($_GET['titan']) && $_GET['titan'] == 'on') {
				$cats[] = 'Титановые';
			}
			if (isset($_GET['mechan']) && $_GET['mechan'] == 'on') {
				$cats[] = 'Механические';
			}
			if (isset($_GET['chrono']) && $_GET['chrono'] == 'on') {
				$cats[] = 'Хронограф';
			}
			if (isset($_GET['winding']) && $_GET['winding'] == 'on') {
				$cats[] = 'Limited edition';
			}
			
			$GLOBALS['arrFilter']['PROPERTY_CATEGORY_VALUE'] = $cats;
			
		}
		
		
		
		
        ?>

        <? if (!empty($_GET['model']) || !empty($_GET['collection']) || !empty($_GET['stock']) || !empty($_GET['new'])): ?>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const el = document.querySelector('.catalog-section');
                    el.scrollIntoView();
                })
            </script>
        <? endif; ?>

        <? $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "catalog",
            [
                "ACTION_VARIABLE" => "action",
                "ADD_PICT_PROP" => "-",
                "USE_FILTER" => "Y",
                "ADD_PROPERTIES_TO_BASKET" => "Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "ADD_TO_BASKET_ACTION" => "ADD",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "BACKGROUND_IMAGE" => "-",
                "BASKET_URL" => "/personal/basket.php",
                "BROWSER_TITLE" => "-",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "COMPATIBLE_MODE" => "N",
                "CONVERT_CURRENCY" => "N",
                "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
                "DETAIL_URL" => "",
                "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_COMPARE" => "N",
                "DISPLAY_TOP_PAGER" => "N",
                "ELEMENT_SORT_FIELD" => "SCALED_PRICE_1",
                "ELEMENT_SORT_FIELD2" => "id",
                "ELEMENT_SORT_ORDER" => !$_GET['fmprice'] ? "asc" : "desc",
                "ELEMENT_SORT_ORDER2" => "desc",
                "ENLARGE_PRODUCT" => "STRICT",
                "FILTER_NAME" => "arrFilter",
                "HIDE_NOT_AVAILABLE" => "N",
                "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                "IBLOCK_ID" => "2",
                "IBLOCK_TYPE" => "catalog",
                "INCLUDE_SUBSECTIONS" => "Y",
                "LABEL_PROP" => [
                    0 => "NEWPRODUCT",
                ],
                "LAZY_LOAD" => "N",
                "LINE_ELEMENT_COUNT" => "3",
                "LOAD_ON_SCROLL" => "N",
                "MESSAGE_404" => "",
                "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                "MESS_BTN_BUY" => "Купить",
                "MESS_BTN_DETAIL" => "Подробнее",
                "MESS_BTN_LAZY_LOAD" => "Показать ещё",
                "MESS_BTN_SUBSCRIBE" => "Подписаться",
                "MESS_NOT_AVAILABLE" => "Нет в наличии",
                "MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",
                "META_DESCRIPTION" => "-",
                "META_KEYWORDS" => "-",
                "OFFERS_FIELD_CODE" => [
                    0 => "",
                    1 => "",
                ],
                "OFFERS_LIMIT" => "5",
                "OFFERS_SORT_FIELD" => "sort",
                "OFFERS_SORT_FIELD2" => "id",
                "OFFERS_SORT_ORDER" => "asc",
                "OFFERS_SORT_ORDER2" => "desc",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "watch_nav",
                "PAGER_TITLE" => "Товары",
                "PAGE_ELEMENT_COUNT" => "12",
                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                "PRICE_CODE" => [
                    0 => "BASE",
                ],
                "PRICE_VAT_INCLUDE" => "Y",
                "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                "PRODUCT_DISPLAY_MODE" => "N",
                "PRODUCT_ID_VARIABLE" => "id",
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false}]",
                "PRODUCT_SUBSCRIPTION" => "Y",
                "PROPERTY_CODE_MOBILE" => [
                ],
                "SECTION_CODE" => "",
                "SECTION_ID" => $section_target,
                "SECTION_ID_VARIABLE" => "SECTION_ID",
                "SECTION_URL" => "",
                "SECTION_USER_FIELDS" => [
                    0 => "",
                    1 => "",
                ],
                "SEF_MODE" => "N",
                "SET_BROWSER_TITLE" => "Y",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "Y",
                "SHOW_404" => "N",
                "SHOW_ALL_WO_SECTION" => "N",
                "SHOW_CLOSE_POPUP" => "N",
                "SHOW_DISCOUNT_PERCENT" => "N",
                "SHOW_MAX_QUANTITY" => "N",
                "SHOW_OLD_PRICE" => "N",
                "SHOW_PRICE_COUNT" => "1",
                "SHOW_SLIDER" => "Y",
                "SLIDER_INTERVAL" => "3000",
                "SLIDER_PROGRESS" => "N",
                "TEMPLATE_THEME" => "blue",
                "USE_ENHANCED_ECOMMERCE" => "N",
                "USE_MAIN_ELEMENT_SECTION" => "N",
                "USE_PRICE_COUNT" => "N",
                "USE_PRODUCT_QUANTITY" => "N",
                "COMPONENT_TEMPLATE" => "catalog",
                "LABEL_PROP_MOBILE" => [
                ],
                "LABEL_PROP_POSITION" => "top-left"
            ],
            false
        ); ?>
    </div>
</section>

<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");