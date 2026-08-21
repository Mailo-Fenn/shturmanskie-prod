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

    global $LENGUAGE;	

?>

<section class="text-banner">
    <div class="container top-mid bottom-ultra first">
        <div class="grid">
            <div>
                <p class="text-banner__date"><?=$arResult["DISPLAY_ACTIVE_FROM"]; ?></p>
                <h2 class="title news">
                    <?=$LENGUAGE == 'ru' ? $arResult["NAME"] : $arResult['PROPERTIES']['NAME_ENG']['VALUE']; ?>
                </h2>
            </div>
			<?
			if(isset($arResult["DETAIL_PICTURE"]["SRC"]) && $arResult["DETAIL_PICTURE"]["SRC"] != '') {
			?>
            <div>
                <div class="text-banner__image" style="background-image: url('<?=$arResult["DETAIL_PICTURE"]["SRC"]?>');"></div>
            </div>
			<?
			}
			?>
        </div>
    </div>
</section>

<section class="text-section">
    <div class="container big-padding-top top-mid bottom-max last text-based">
        <h2 class="section-title">
            <? if($LENGUAGE == 'ru') {				
				echo $arResult['PROPERTIES']['DESC_TITLE_RU']['~VALUE'];				
			}
			else {		

				echo $arResult['PROPERTIES']['DESC_TITLE_ENG']['~VALUE']; 
			}
			?>
        </h2>
        <div class="paragraf">
			 <? if($LENGUAGE == 'ru') {		
				if(isset($arResult['PROPERTIES']['DESC_RU']['~VALUE']['TEXT']) && $arResult['PROPERTIES']['DESC_RU']['~VALUE']['TEXT'] != '') {
				echo $arResult['PROPERTIES']['DESC_RU']['~VALUE']['TEXT'];	
				}
			}
			else {		
				if(isset($arResult['PROPERTIES']['DESC_ENG']['~VALUE']['TEXT']) && $arResult['PROPERTIES']['DESC_ENG']['~VALUE']['TEXT'] != '') {
				echo $arResult['PROPERTIES']['DESC_ENG']['~VALUE']['TEXT']; 
				}
			}
			?>            
        </div>
    </div>
</section>

<? if($arResult['PROPERTIES']['SHOW_IMAGE']['VALUE'] == "Да"){ ?>
    <section class="news-banner">
        <div class="container big-padding center  hd-size">
            <div class="news-banner__grid">
                <div>
                    <img src="<?=CFile::GetPath($arResult['PROPERTIES']['IMAGE_1']['VALUE']); ?>" />
                </div>
                <div>
                    <img src="<?=CFile::GetPath($arResult['PROPERTIES']['IMAGE_2']['VALUE']); ?>" />
                </div>
            </div>
        </div>
    </section>    
<? } ?>

<? if($arResult['PROPERTIES']['SHOW_DARK']['VALUE'] == "Да"){ ?>
    <section class="dark-list">
        <div class="container standart hd-size">
            <h2 class="section-title">
                <?=$LENGUAGE == 'ru' ? $arResult['PROPERTIES']['TITLE_DARK_RU']['~VALUE'] : $arResult['PROPERTIES']['TITLE_DARK_ENG']['~VALUE']; ?>    
            </h2>
            <div class="paragraf">
                <?=$LENGUAGE == 'ru' ? $arResult['PROPERTIES']['DESC_DARK_RU']['~VALUE']['TEXT'] : $arResult['PROPERTIES']['DESC_DARK_ENG']['~VALUE']['TEXT']; ?>    
            </div>
        </div>
    </section>
<? } ?>

<? if($arResult['PROPERTIES']['SHOW_IMAGED']['VALUE'] == "Да"){ ?>
    <section class="with-image">
        <div class="container top-ultra bottom-ultra standart">
            <div class="flex">
                <div class="c1">
                    <div class="paragraf">
                        <?=$LENGUAGE == 'ru' ? $arResult['PROPERTIES']['TEXT_IMAGE_RU']['~VALUE']['TEXT'] : $arResult['PROPERTIES']['TEXT_IMAGE_ENG']['~VALUE']['TEXT']; ?>
                    </div>
                </div>
                <div class="c2">
                    <div class="with-image__image" style="background-image: url('<?=CFile::GetPath($arResult['PROPERTIES']['TEXT_IMAGE_ITEM']['VALUE']); ?>');"></div>
                </div>
            </div>
        </div>
    </section>
<? } ?>

<section class="two-article is_news">
    <div class="container top-mid bottom-mid">
        <div class="two-article__wrapper in-news">
            <?php
                $arFilter = Array(
                    "IBLOCK_ID" => 7,
					"ACTIVE" => "Y"
                );
                
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>2), $arSelect);  
                
                while($ob = $res->GetNextElement()) {
	                $fields = $ob->GetFields(); 
	                $properties = $ob->GetProperties();
            ?>
                    <div class="">
                        <div class="two-article__image" style="background-image: url('<?=CFile::GetPath($fields["PREVIEW_PICTURE"]); ?>');"></div>
                        <h3 class="two-article__title"><?=$LENGUAGE != 'ru' ? $properties['NAME_ENG']['VALUE'] : $fields["NAME"]?></h3>
                        <a href="<?=$fields["DETAIL_PAGE_URL"]?>" class="two-article__more">
                            <?=$LENGUAGE == 'ru' ? "Прочитать статью" : "Read article"; ?>
                        </a>
                    </div>
            <?
                }
            ?> 
        </div>
    </div>
</section>

