<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    require($_SERVER["DOCUMENT_ROOT"]."/local/scripts/get_images.php");
    $APPLICATION->SetTitle("Производство");
    global $LENGUAGE;
?>

<section class="banner big manufactury" style="background-image: url('<?=$IMAGES_LIST[475]; ?>');">
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

<section class="">
    <div class="container top-mid bottom-mid zero-mob-padding">
        <h2 class="section-title single-title uppercase">Производство</h2>
    </div>
</section>

<section class="with-image manufactury">
    <div class="container standart top-mid">
        <div class="flex">
            <div class="c1">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", 
                    ".default", 
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "components/with-image1.php"
                    ),
                    false
                );?>         
            </div>
            <div class="c2">
                <div class="with-image__image" style="background-image: url('<?=$IMAGES_LIST[476]; ?>');"></div>
            </div>
        </div>
    </div>
</section>

<section class="with-image manufactury">
    <div class="container standart top-ultra">
        <div class="flex">
            <div class="c2">
                <div class="with-image__image" style="background-image: url('<?=$IMAGES_LIST[477]; ?>');"></div>
            </div>
            <div class="c1 right">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", 
                    ".default", 
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "components/with-image2.php"
                    ),
                    false
                );?>  
            </div>
        </div>
    </div>
</section>

<section class="quote manufactury">
    <div class="container top-max bottom-mid center">
        <h2>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include", 
                ".default", 
                array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "COMPONENT_TEMPLATE" => ".default",
                    "PATH" => "components/quote1.php"
                ),
                false
            );?>  
        </h2>
    </div>
</section>

<section class="dark">
    <div class="container top-mid bottom-mid zero-mob-padding">
        <h2 class="section-title single-title uppercase ">Производство</h2>
    </div>
</section>

<section class="with-image manufactury dark">
    <div class="container standart top-mid">
        <div class="flex">
            <div class="c1">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", 
                    ".default", 
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "components/with-image3.php"
                    ),
                    false
                );?>  
            </div>
            <div class="c2">
                <div class="with-image__image" style="background-image: url('<?=$IMAGES_LIST[478]; ?>');"></div>
            </div>
        </div>
    </div>
</section>

<section class="with-image manufactury dark">
    <div class="container standart top-ultra bottom-mid">
        <div class="flex">
            <div class="c2">
                <div class="with-image__image" style="background-image: url('<?=$IMAGES_LIST[479]; ?>');"></div>
            </div>
            <div class="c1 right">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", 
                    ".default", 
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "components/with-image4.php"
                    ),
                    false
                );?>  
            </div>
        </div>
    </div>
</section>

<section class="quote manufactury dark">
    <div class="container top-mid bottom-mid center">
        <h2>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include", 
                ".default", 
                array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "COMPONENT_TEMPLATE" => ".default",
                    "PATH" => "components/quote2.php"
                ),
                false
            );?>    
        </h2>
    </div>
</section>

<section class="story-paragraf manufactury">
    <div class="container top-mid bottom-mid center" style="">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            ".default", 
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "components/quote3.php"
            ),
            false
        );?>                
    </div>
</section>

<section class="two-article manufactury">
    <div class="container top-five bottom-mid">
        <? require($_SERVER["DOCUMENT_ROOT"]."/include/two-article.php"); ?>
    </div>
</section>

<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");