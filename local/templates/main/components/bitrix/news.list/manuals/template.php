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

    require(__DIR__."/lang/$LENGUAGE/template.php");
?>

<table class="shipping-table manuals-table paragraf">
    <tbody>
        <?php
            foreach($arResult["ITEMS"] as $arItem):
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

            $image = $LENGUAGE == 'ru' ? CFile::GetPath($arItem['PROPERTIES']['FILE_RUS']['VALUE']) : CFile::GetPath($arItem['PROPERTIES']['FILE_ENG']['VALUE']);
        ?>
                <tr>
                    <td><?=$LENGUAGE == 'ru' ? $arItem['NAME'] : $arItem['PROPERTIES']['NAME_ENG']['VALUE']; ?></td>
                    <td class="center">
                        <a target="_blank" href="<?=$image; ?>">
                            <?=$MESS['DOWNLOAD']; ?> (PDF)
                        </a>
                    </td>
                </tr>
        <?php
            endforeach;
        ?>
    </tbody>
</table>
