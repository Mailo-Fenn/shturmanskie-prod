<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    require($_SERVER["DOCUMENT_ROOT"]."/local/scripts/get_images.php");
    $APPLICATION->SetTitle("Доставка");
?>

<section class="text-banner">
    <div class="container top-mid bottom-ultra first">
        <div class="grid">
            <div>
                <h2 class="title news">
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
            <div>
                <div class="text-banner__image" style="background-image: url('<?=$IMAGES_LIST[462]; ?>');"></div>
            </div>
        </div>
    </div>
</section>

<section class="text-section">
    <div class="container top-mid big-padding-top text-based">
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

<section class="text-section shipping">
    <div class="container  bottom-zero top-ultra">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            ".default", 
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "components/table.php"
            ),
            false
        );?>
    </div>
</section>

<section class="text-section text-based">
    <div class="container top-ultra bottom-zero middle-size">
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

<section class="text-section text-based shipping-section">
    <div class="container top-ultra bottom-zero middle-size">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            ".default", 
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "components/paragraf3.php"
            ),
            false
        );?>
    </div>
</section>

<section class="text-section text-based shipping-section" style="margin-bottom: 5px;">
    <div class="container middle-size top-ultra bottom-ultraplass last superbig-padding">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            ".default", 
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "components/paragraf4.php"
            ),
            false
        );?>
    </div>
</section>

<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");