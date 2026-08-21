<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    require($_SERVER["DOCUMENT_ROOT"]."/local/scripts/get_images.php");
    $APPLICATION->SetTitle("Гарантия");
?>

<section class="banner warranty" style="background-image: url('<?=$IMAGES_LIST[468]; ?>');">
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
    <div class="container mini-size center under-banner text-based">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            ".default", 
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "components/quote.php"
            ),
            false
        );?>  
    </div>
</section>

<section class="imaged-text">
    <div class="container imaged-container">
        <div class="grid">
            <div class="imaged-text__content">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", 
                    ".default", 
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "components/image-text1.php"
                    ),
                    false
                );?> 
            </div>
            <div class="imaged-text__image-wrapper">
                <div 
                    class="imaged-text__image"
                    style="background-image: url('<?=$IMAGES_LIST[469]; ?>');"
                ></div>
            </div>
        </div>
    </div>
</section>

<section class="imaged-text left">
    <div class="container imaged-container middle-padding">
        <div class="grid">
            <div class="imaged-text__image-wrapper">
                <div 
                    class="imaged-text__image"
                    style="background-image: url('<?=$IMAGES_LIST[470]; ?>');"
                ></div>
            </div>
            <div class="imaged-text__content">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", 
                    ".default", 
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "components/image-text2.php"
                    ),
                    false
                );?> 
            </div>
        </div>
    </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>