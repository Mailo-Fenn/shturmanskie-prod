<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    require($_SERVER["DOCUMENT_ROOT"]."/local/scripts/get_images.php");
    $APPLICATION->SetTitle("Оплата");
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
                <div class="text-banner__image" style="background-image: url('/upload/iblock/11e/h17831wriae908n0ow8uz76jl16ujisc.png');"></div>
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

<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");