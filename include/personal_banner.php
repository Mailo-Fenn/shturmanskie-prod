<?php
    require($_SERVER["DOCUMENT_ROOT"]."/local/scripts/get_images.php");
?>

<section class="text-banner ">
    <div class="container bottom-mid top-ultra-two">
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
                            "PATH" => "components/personal.php"
                        ),false
                    );?>
                </h2>
            </div>
            <div>
                <div class="text-banner__image account" style="background-image: url('<?=$IMAGES_LIST[577]; ?>');"></div>
            </div>
        </div>
    </div>
</section>