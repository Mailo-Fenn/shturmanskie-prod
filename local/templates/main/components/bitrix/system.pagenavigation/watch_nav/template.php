<?
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    /** @var array $arParams */
    /** @var array $arResult */
    /** @global CMain $APPLICATION */
    /** @global CUser $USER */
    /** @global CDatabase $DB */
    /** @var CBitrixComponentTemplate $this */
    /** @var string $templateName */
    /** @var string $templateFile */
    /** @var string $templateFolder */
    /** @var string $componentPath */
    /** @var CBitrixComponent $component */
    $this->setFrameMode(true);

    if(!$arResult["NavShowAlways"]){
	    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		    return;
    }

    $strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
    $strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<div class="pagination">
    <div class="pagination-list">

        <? if($arResult['nStartPage'] >= 2){ ?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="pagination-list__item">1</a>
        <? } ?>
 
        <? if($arResult['nStartPage'] >= 3) echo "..."; ?>

	    <?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
		    <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
			    <a href="" class="pagination-list__item active"><?=$arResult["nStartPage"]?></a>
		    <?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
			    <a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="pagination-list__item"><?=$arResult["nStartPage"]?></a>
		    <?else:?>
			    <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>" class="pagination-list__item"><?=$arResult["nStartPage"]?></a>
		    <?endif?>
		    <?$arResult["nStartPage"]++?>
	    <?endwhile?>

        <? if(($arResult['NavPageCount'] - $arResult['nEndPage']) > 1) echo "..."; ?>

        <? if(($arResult['NavPageCount'] - $arResult['nEndPage']) >= 1) { ?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>" class="pagination-list__item">
                <?=$arResult['NavPageCount']; ?>
            </a>
        <? } ?>

    </div>
    <p class="pagination-text">
        <? 

            $isNewsPage = false;
            if (isset($_SERVER['REQUEST_URI'])) {
                $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                if ($urlPath === '/news/' || $urlPath === '/news') {
                    $isNewsPage = true;
                }
            }


            global $LENGUAGE;
            if($LENGUAGE == 'ru'){
                $postWord = "";
                $number = $arResult["NavRecordCount"];
                $number = abs($number) % 100;
                $n1 = $number % 10;
                
                if ($number > 10 && $number < 20) $postWord = 'постов';
                if ($n1 > 1 && $n1 < 5) $postWord = 'поста';
                if ($n1 == 1) $postWord = 'пост';
                    $postWord = 'постов';


        ?>
            Показаны  <?=$arResult["NavFirstRecordShow"]?> - <?=$arResult["NavLastRecordShow"]?> из <?=$arResult["NavRecordCount"]?> <?=$isNewsPage ? $postWord : ''; ?>

            
        <? }else{ ?>
            Showing  <?=$arResult["NavFirstRecordShow"]?> - <?=$arResult["NavLastRecordShow"]?> of <?=$arResult["NavRecordCount"]?> <?=$isNewsPage ? 'posts' : ''; ?>
        <? } ?>
    </p>
</div> 


