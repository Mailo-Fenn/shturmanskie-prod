<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    require($_SERVER["DOCUMENT_ROOT"]."/local/scripts/get_images.php");
    $APPLICATION->SetTitle("Уход за часами");
?>

<section class="text-banner ">
    <div class="container w-case top-mid bottom-mini first watch-care">
        <div class="grid">
            <div>
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
        <div>
        <div class="text-banner__image watch-care" style="background-image: url('<?=$IMAGES_LIST[461]; ?>');"></div>
    </div>
</section>

<section class="underbanner">
    <div class="container top-ultra middle-size  text-based watch-care__text">
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

<section class="text-section text-based">
    <div class="container top-max bottom-zero middle-size watch-care__content">
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

<section class="text-section text-based">
    <div class="container top-ultra bottom-zero middle-size watch-care__content">
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

<section class="text-section text-based">
    <div class="container top-ultra bottom-zero middle-size watch-care__content">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            ".default", 
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "components/paragraf5.php"
            ),
            false
        );?>        
    </div>
</section>

<section class="text-section text-based">
    <div class="container top-ultra bottom-zero middle-size watch-care__content">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            ".default", 
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "components/paragraf6.php"
            ),
            false
        );?>                
    </div>
</section>

<section class="text-section text-based">
    <div class="container top-ultra bottom-zero middle-size watch-care__content">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            ".default", 
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "components/paragraf7.php"
            ),
            false
        );?>        
    </div>
</section>

<section class="text-section text-based">
    <div class="container top-ultra bottom-zero middle-size watch-care__content">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            ".default", 
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "components/paragraf8.php"
            ),
            false
        );?>        
    </div>
</section>

<section class="text-section text-based">
    <div class="container top-ultra bottom-zero middle-size watch-care__content last big-padding">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            ".default", 
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "components/paragraf9.php"
            ),
            false
        );?>        
    </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>