<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
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

    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url)[0];
    $url = explode('/', $url);
    $itemSlug = $url[count($url) - 2];

    $pageData = getPageData($itemSlug, $_GET['model']); 
	
	
    
    $arFields = $pageData['arFields'];
    $arProps = $pageData['arProps'];	
	
	if(isset($arProps['TOP_BG_PC']['VALUE']) && $arProps['TOP_BG_PC']['VALUE'] != '') {
		
		$top_bg_pc = CFile::GetPath($arProps['TOP_BG_PC']['VALUE']);
		
	}
	else {
		
		$top_bg_pc = '/images/banner-space.png';
		
	}
	
	if(isset($arProps['TOP_BG_PC']['VALUE']) && $arProps['TOP_BG_PC']['VALUE'] != '') {
		
		$top_bg_mob = CFile::GetPath($arProps['TOP_BG_MOB']['VALUE']);

	}
	else {
		
		$top_bg_mob = '/images/banner-space.png';
		
	}
?>
<style>

.mob {
	display: flex !important;
}
.pc {
	display: none !important;
}

.top_banner .container {	
	
	background-image: url('<?=$top_bg_mob?>');
    background-size: contain;
    background-repeat: no-repeat;
    background-color: #000000;
    background-position: center top;	
	
}

.top_banner .catalog-banner__image {
		
	min-height: 100px;
	
}

@media (min-width: 320px) {
		
	.top_banner .catalog-banner__image {
		
		min-height: 150px;
		
	}

}

@media (min-width: 420px) {
		
	.top_banner .catalog-banner__image {
		
		min-height: 200px;
		
	}

}

@media (min-width: 520px) {
		
	.top_banner .catalog-banner__image {
		
		min-height: 250px;
		
	}

}

@media (min-width: 620px) {
		
	.top_banner .catalog-banner__image {
		
		min-height: 300px;
		
	}

}

@media (min-width: 720px) {
		
	.top_banner .catalog-banner__image {
		
		min-height: 350px;
		
	}

}

@media (min-width: 820px) {
		
	.top_banner .catalog-banner__image {
		
		min-height: 400px;
		
	}

}

@media (min-width: 920px) {
		
	.top_banner .catalog-banner__image {
		
		min-height: 450px;
		
	}

}


.bottom .catalog-banner__image {
		
	min-height: 200px;
	
}

@media (min-width: 300px) {
		
	.bottom .catalog-banner__image {
		
		min-height: 250px;
		
	}

}

@media (min-width: 370px) {
		
	.bottom .catalog-banner__image {
		
		min-height: 300px;
		
	}

}

@media (min-width: 420px) {
		
	.bottom .catalog-banner__image {
		
		min-height: 350px;
		
	}

}

@media (min-width: 470px) {
		
	.bottom .catalog-banner__image {
		
		min-height: 400px;
		
	}

}

@media (min-width: 520px) {
		
	.bottom .catalog-banner__image {
		
		min-height: 450px;
		
	}

}

@media (min-width: 570px) {
		
	.bottom .catalog-banner__image {
		
		min-height: 500px;
		
	}

}

@media (min-width: 620px) {
		
	.bottom .catalog-banner__image {
		
		min-height: 550px;
		
	}

}


@media (min-width: 670px) {
		
	.bottom .catalog-banner__image {
		
		min-height: 600px;
		
	}

}

@media (min-width: 720px) {
		
	.bottom .catalog-banner__image {
		
		min-height: 600px;
		
	}

}


@media (min-width: 770px) {
		
	.bottom .catalog-banner__image {
		
		min-height: 650px;
		
	}

}

@media (min-width: 820px) {
		
	.bottom .catalog-banner__image {
		
		min-height: 700px;
		
	}

}


@media (min-width: 870px) {
		
	.bottom .catalog-banner__image {
		
		min-height: 750px;
		
	}

}

@media (min-width: 920px) {
		
	.bottom .catalog-banner__image {
		
		min-height: 800px;
		
	}

}

.catalog-banner:is(.bottom) .catalog-banner__content div {
	padding-left: 20px;
	width: 100%;
}

.catalog-banner:is(.bottom) .catalog-banner__content {
	width: 70% !important;
}


@media (min-width: 970px) {
	
	.top_banner .catalog-banner__image {
		
		min-height: 300px;
		
	}
	
	.bottom .catalog-banner__image {
		
		min-height: 300px;
		
	}
	
	.top_banner .container {	
	
		background-image: url('<?=$top_bg_pc?>');	
		background-size: cover;
		
	}
	
	.top_banner .catalog-banner__content div {	
		padding-left: 200px;
		margin-right: 10px;		
	}
	
	.mob {
		display: none !important;
	}
	.pc {
		display: grid !important;
	}
	
	.catalog-banner:is(.bottom) .catalog-banner__content div {
		padding-left: 200px;
		width: 100%;
	}

	.catalog-banner:is(.bottom) .catalog-banner__content {
		width: 100% !important;
	}
	
}





</style>

<section class="catalog-banner top_banner">
    <div class="container first grid pc"<?
	if((int) $arProps['TOP_BG_PC']['VALUE'] > 0) {
	?> style="background-image: url('<?=CFile::GetPath($arProps['TOP_BG_PC']['VALUE']) ?>');"<?
	}
	?>>
        <div class="catalog-banner__image">
            
        </div>
        <div class="catalog-banner__content">
            <div class="">
                <h2 class="section-title"><?=$arProps['TITLE_TOP_RU']['~VALUE'] ?></h2>
                <p class="paragraf"> 
                    <?=$arProps['TEXT_TOP_RU']['~VALUE']['TEXT']; ?>
                </p>
            </div>
        </div>
    </div>
	<div class="container first grid mob"<?
	if((int) $arProps['TOP_BG_PC']['VALUE'] > 0) {
	?> style="background-image: url('<?=CFile::GetPath($arProps['TOP_BG_MOB']['VALUE']) ?>');"<?
	}
	?>>
        <div class="catalog-banner__image">
            
        </div>
        <div class="catalog-banner__content">
            <div class="">
                <h2 class="section-title"><?=$arProps['TITLE_TOP_RU']['~VALUE'] ?></h2>
                <p class="paragraf"> 
                    <?=$arProps['TEXT_TOP_RU']['~VALUE']['TEXT']; ?>
                </p>
            </div>
        </div>
    </div>
</section>


<!--<section class="catalog-banner">
    <div class="container first grid">
        <div class="catalog-banner__image">
            <img 
                src="<?=CFile::GetPath($arProps['IMAGE_TOP_PC']['VALUE']) ?>" 
                class="pc"
            />
            <img 
                src="<?=CFile::GetPath($arProps['IMAGE_TOP_MOB']['VALUE']) ?>" 
                class="mob"
            />
        </div>
        <div class="catalog-banner__content">
            <div class="">
                <h2 class="section-title"><?=$arProps['TITLE_TOP_RU']['~VALUE'] ?></h2>
                <p class="paragraf"> 
                    <?=$arProps['TEXT_TOP_RU']['~VALUE']['TEXT']; ?>
                </p>
            </div>
        </div>
    </div>
</section>-->

<?php
    $flagShow = false;
?>
<? if(!$_GET['model']){ ?>
    <section class="category-slider collection-category">
        <div class="container mini-padding">
            <h2 class="category-title">
                В коллекции
            </h2>
            
            <?php
                // Получаем список категорий, которые находятся в родительской с id 2
                CModule::IncludeModule('iblock');

                // Получаем ID категории по её символьному коду (code)
                $sectionId = false;
                $sectionRes = CIBlockSection::GetList(
                    array(),
                    array(
                        "IBLOCK_ID" => 2,
                        "CODE" => $itemSlug,
						"ACTIVE" => "Y"
                    ),
                    false,
                    array("ID")
                );
                if ($arSectionTmp = $sectionRes->GetNext()) {
                    $sectionId = $arSectionTmp['ID']; 
                    $_GET['collection'] = $arSectionTmp['ID']; 
                }else{
                    header('Location: /catalog/');
                    exit;
                }
                    
                $resCat = CIBlockSection::GetList(
                    Array(
                        "SORT" => "ASC"
                    ), Array(
                        "IBLOCK_ID" => 2,
                        "SECTION_ID" => $sectionId,
						"ACTIVE" => "Y"
                    ),
                    false, 
                    Array()
                );
            ?>

            <div class="category-slider__slick">
                <?php
                    $flagShow = false;
                ?>
                <? while ($arSection = $resCat->GetNext()) { ?>
                    <?php
                        $flagShow = true;
                    ?>
                    <div>
                        <a class="category-slider__item" href="?model=<?=$arSection['ID'] ?>">
                            <div class="category-slider__item-image vertical-center">
                                <img src="<?=CFile::GetPath($arSection['PICTURE']) ?>">
                            </div>
                            <? $name = explode('#', $arSection['NAME']); ?>
                            <h3 class="product-title"><?=$LENGUAGE == 'ru' ? $name[0] : $name[1]; ?></h3>
                        </a>
                    </div>
                <? } ?>
            </div>
        </div>
    </section> 

    <?php if(!$flagShow){ ?>
        <style>
            #inclt{
                display: none !important;
            }
        </style>
    <?php } ?>
<? } ?>

<section class="category-description" style="<?=$flagShow  ? "margin-top: 0px;" : "" ?>">
    <div class="container middle-padding <?=!$flagShow ? "top-seven" : "zero-padding" ?>">
        <p class="sticker"><?=$arProps['STICKER_DESC_RU']['~VALUE'] ?></p>
        <h2 class="category-title"><?=$arProps['TITLE_DESC_RU']['~VALUE'] ?></h2>
        <div class="text">
            <?=$arProps['TEXT_DESC_RU']['~VALUE']['TEXT']; ?>
        </div>
    </div>
</section>
        
<section class="catalog-list">
    <div class="container">
        <?php 
            $GLOBALS['arrFilter'] = setFilter($itemSlug);
        ?>
        <?$APPLICATION->IncludeComponent(
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
                "SECTION_CODE" => $itemSlug,
                "SECTION_ID" => isset($_GET['model']) ? $_GET['model'] : "",
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
        );?>
    </div>
</section>

<section class="category-slider">
    <div class="container bottom-ultra feautured">
        <h2 class="category-title">
            РЕКОМЕНДУЕМЫЕ КОЛЛЕКЦИИ
        </h2>
        <? require($_SERVER["DOCUMENT_ROOT"]."/include/collection.php"); ?>
    </div>
</section>

<section class="catalog-banner bottom bottom_banner">
    <div class="container top-mid grid"<?
	if((int) $arProps['TOP_BG_PC']['VALUE'] > 0) {
	?> style="background-color: #000000; background-image: url('<?=CFile::GetPath($arProps['BOTTOM_BG_PC']['VALUE']) ?>'); background-position: top right; background-size: contain; background-repeat: no-repeat;"<?
	}
	?>>
		<div class="catalog-banner__content">
			<div class="">				
				<h2 class="section-title" style="margin-bottom: 17px;"><?
				if(isset($arProps['TITLE_BOTTOM_RU']['~VALUE']) && $arProps['TITLE_BOTTOM_RU']['~VALUE'] != '') {
					echo $arProps['TITLE_BOTTOM_RU']['~VALUE'];
				}
				?></h2>
                <p class="paragraf"> 
                    <?					
					if(isset($arProps['TEXT_BOTTOM_RU']['~VALUE']['TEXT']) && $arProps['TEXT_BOTTOM_RU']['~VALUE']['TEXT'] != '') {
						echo $arProps['TEXT_BOTTOM_RU']['~VALUE']['TEXT']; 
					}
					?>
                </p>
			</div>
		</div>
		<div class="catalog-banner__image">
			<!--<img 
				src="/images/watch_banner2.png" 
				class="pc"
			/>
			<img 
				src="/images/banner-mob2.png" 
				class="mob"
			/>-->
		</div>	
        <? //require($_SERVER["DOCUMENT_ROOT"]."/include/bottom_banner.php"); ?>
    </div>
</section>

<style>
    .select.type-select,
    .catalog-list__filter-popup .type-select{
        display: none !important;
    }
</style>

<?

    function getPageData($itemSlug, $model){
        CModule::IncludeModule('iblock');
        $arSelect = Array();

        $code = $itemSlug;

        $id_to_code = array(
            60 => "legacy-24-hours",
            59 => "den-noch",
            58 => "heritage",
            57 => "klassika-33",
            56 => "24-chasa",
            55 => "den-noch_g",
            54 => "klassika-avtomat",
            53 => "legacy-42",
            52 => "perviy",
            51 => "naslediye-klassika",
            50 => "naslediye-avtomat",
            49 => "heritage-2",
            67 => "automatic-chronograph",
            66 => "quartz",
            65 => "day-date-automatic",
            64 => "second-hour-time",
            61 => "heritage-3",
            63 => "gmt",
            62 => "legacy-of-a-small-second",
            //eng
            76 => "legacy-24-hours",
            77 => "den-noch",
            78 => "heritage",
            79 => "klassika-33",
            80 => "24-chasa",
            81 => "den-noch_g",
            82 => "klassika-avtomat",
            83 => "legacy-42",
            84 => "perviy",
            85 => "naslediye-klassika",
            86 => "naslediye-avtomat",
            87 => "heritage-2",
            88 => "automatic-chronograph",
            89 => "quartz",
            90 => "day-date-automatic",
            91 => "second-hour-time",
            92 => "heritage-3",
            93 => "gmt",
            94 => "legacy-of-a-small-second"
        );

        if(isset($model)){
            $code = $id_to_code[$model];
        }

        $arFilter = Array("IBLOCK_ID"=>15, "ACTIVE"=>"Y", "CODE" => $code);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

        $ob = $res->GetNextElement();

        if(!$ob) {
            header('Location: /catalog/');
            exit;
        }

        return array(
            'arFields' => $ob->GetFields(),
            'arProps' => $ob->GetProperties()
        );

    }

    function setFilter($itemSlug){ 
        
        if(!isset($_GET['model'])){
            $arrFilter['SECTION_CODE'] = $itemSlug;
        }else{
            $arrFilter['SECTION_ID'] = $_GET['model'];
        }
        

        if (isset($_GET['stock']) && $_GET['stock'] == '1') {
            $arrFilter['>CATALOG_QUANTITY'] = 0;
        }

        if (isset($_GET['new']) && $_GET['new'] == 'on') {
            $arrFilter['PROPERTY_NEWPRODUCT_VALUE'] = 'да';
        }
		
		if (isset($_GET['archive']) && $_GET['archive'] == 'on') {
			$arrFilter['PROPERTY_ARCHIVE_VALUE'] = 'да';
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
			
			$arrFilter['PROPERTY_CATEGORY_VALUE'] = $cats;
			
		}
		

        return $arrFilter;
    }

    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");