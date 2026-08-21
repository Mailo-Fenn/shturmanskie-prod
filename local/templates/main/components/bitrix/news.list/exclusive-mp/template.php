<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

    $slides = array();

    foreach($arResult["ITEMS"] as $arItem):
	    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	
        $slides[] = array(
            'link' => $arItem['PROPERTIES']['LINK']['VALUE'],
            'title' => $LENGUAGE == "ru" ? $arItem['NAME'] : $arItem['PROPERTIES']['NAME_ENG']['VALUE'],
            'image' => $arItem["PREVIEW_PICTURE"]["SRC"]
        );

    endforeach;

    $slides_pc = array_chunk($slides, 3);
    $bg_index = 1;
?>

<div class="grid">
    <div class="space-watch__title">
        <div class="vertical-center">
            <h2 class="section-title">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", 
                    ".default", 
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "/components/exclusive.php"
                    ),
                    false
                );?>
            </h2>
        </div>
    </div>
    <div class="space-watch__list">
        <? foreach($slides_pc[0] as $item){ ?>
            <a href="<?=$item['link']; ?>" class="space-watch__list-item">
                <div 
                    class="space-watch__list-item__image" 
                    style="background-image: url('/images/space-item__0<?=$bg_index; ?>.png');"
                >
                    <img src="<?=$item['image']; ?>" />
                </div>
                <h3><?=$item['title']; ?></h3>
            </a>
            <? $bg_index += 1; ?>
        <? } ?>
    </div>
</div>

<div class="grid"> 
    <div class="space-watch__list left">  
        <? foreach($slides_pc[1] as $item){ ?>
            <a href="<?=$item['link']; ?>" class="space-watch__list-item">
                <div 
                    class="space-watch__list-item__image" 
                    style="background-image: url('/images/space-item__0<?=$bg_index; ?>.png');"
                >
                    <img src="<?=$item['image']; ?>" />
                </div>
                <h3><?=$item['title']; ?></h3>
            </a>
            <? $bg_index += 1; ?>
        <? } ?>
    </div>
</div>

<? $bg_index = 1; ?>

<div class="space-watch__mob">
    <? foreach($slides as $item){ ?>
        <a href="<?=$item['link']; ?>" class="space-watch__mob-item">
            <div 
                class="space-watch__list-item__image" 
                style="background-image: url('/images/space-item__0<?=$bg_index; ?>.png');"
            >
                <img src="<?=$item['image']; ?>" />
            </div>
            <h3><?=$item['title']; ?></h3>
        </a>
        <? $bg_index += 1; ?>
    <? } ?>
</div>