<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    require($_SERVER["DOCUMENT_ROOT"]."/local/scripts/get_images.php");
    $APPLICATION->SetTitle("Возврат");
?>

<section class="banner returns" style="background-image: url('<?=$IMAGES_LIST[463]; ?>');">
    <div class="container first flex">
        <h2 class="title">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include", 
                ".default", 
                array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "COMPONENT_TEMPLATE" => ".default",
                    "PATH" => "components/banner.php"
                ),
                false
            );?>
        </h2>
    </div>
</section>

<section class="underbanner">
    <div class="container middle-size under-banner text-based">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            ".default", 
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "components/paragraf1.php"
            ),
            false
        );?>
    </div>
</section>

<section class="text-section text-based return-contacts">
    <div class="container top-ultra bottom-max middle-size last">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            ".default", 
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "components/paragraf2.php"
            ),
            false
        );?>
    </div>
</section>

<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");