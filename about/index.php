<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    require($_SERVER["DOCUMENT_ROOT"]."/local/scripts/get_images.php");
    $APPLICATION->SetTitle("История");
?>

<section class="banner big story" style="background-image: url('<?=$IMAGES_LIST[484]; ?>');">
    <div class="container first flex"></div>
</section>

<section class="story-desc dark">
    <div class="container top-max bottom-max center">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            ".default", 
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "components/our-story.php"
            ),
            false
        );?>
    </div>
</section>

<section class="story-banner center dark">
    <div class="container top-five bottom-five">
        <img class="pc" src="<?=$IMAGES_LIST[485]; ?>" />
        <img class="mob" style="margin-bottom: 12px;" src="<?=$IMAGES_LIST[486]; ?>" />
        <img class="mob" src="<?=$IMAGES_LIST[487]; ?>" />
    </div>
</section>

<section class="story-paragraf dark">
    <div class="container top-seven bottom-ultra">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            ".default", 
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "components/first-in-space.php"
            ),
            false
        );?>
    </div>
</section>

<section class="dark story-watches">
    <div class="container zero-padding ">
        <div>
            <div class="story-watches__space">
                <img src="<?=$IMAGES_LIST[488]; ?>">
            </div>
        </div>
        <div>
            <div class="story-watches__space">
                <img src="<?=$IMAGES_LIST[489]; ?>">
            </div>
        </div>
        <div>
            <div class="story-watches__space">
                <img src="<?=$IMAGES_LIST[490]; ?>">
            </div>
        </div>
    </div>
</section>

<section class="story-paragraf story-btn dark">
    <div class="container top-ultra bottom-mid">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            ".default", 
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "components/mission.php"
            ),
            false
        );?>
    </div>
</section>

<section class="dark story-video">
    <div class="container bottom-seven">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            ".default", 
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "components/video.php"
            ),
            false
        );?>
    </div>
</section>

<section class="dark story-image">
    <div class="container top-ultra bottom-mid">
        <div class="grid">
            <div class="story-image__image" style="background-image: url('<?=$IMAGES_LIST[491]; ?>');"></div>
            <div class="story-image__content">
                <div class="vertical-center">
                    <div>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include", 
                            ".default", 
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "COMPONENT_TEMPLATE" => ".default",
                                "PATH" => "components/since-april.php"
                            ),
                            false
                        );?>
                        
                        <a class="btn" href="/about/manufacture/">
                            <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="1" y="1" width="88" height="88" rx="44" stroke="#FF662C" stroke-width="2"></rect>
                                <path d="M40.5 35L49.5 46.0556L40.5 55" stroke="black" stroke-width="2"></path>
                            </svg>
                            <div class="vertical-center">
                                <div>
                                    ПРОИЗВОДСТВО
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="story-paragraf two dark">
    <div class="container top-ultra bottom-mid center">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include", 
            ".default", 
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "components/collection.php"
            ),
            false
        );?>                
    </div>
</section>

<section class="dark story-image">
    <div class="container top-five bottom-min">
        <div class="grid">
            <div class="story-image__image" style="background-image: url('<?=$IMAGES_LIST[492]; ?>');"></div>
            <div class="story-image__content">
                <div class="vertical-center">
                    <div>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include", 
                            ".default", 
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "COMPONENT_TEMPLATE" => ".default",
                                "PATH" => "components/since-1949.php"
                            ),
                            false
                        );?>                                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 
<section class="two-article story dark">
    <div class="container top-max bottom-mid">
        <?$APPLICATION->IncludeFile('/include/two-article.php'); ?>
    </div>
</section>
                 
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>