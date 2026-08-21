<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    require($_SERVER["DOCUMENT_ROOT"]."/local/scripts/get_images.php");
    $APPLICATION->SetTitle("Сотрудничество");
?>

<section class="banner big collaboration" style="background-image: url('<?=$IMAGES_LIST[471]; ?>');">
    <div class="container first flex">
        <div>
            <img class="banner__mob-image" src="<?=$IMAGES_LIST[472]; ?>" />
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
                    
            <a href="/catalog/gagarin/" class="btn big">
                <svg width="114" height="114" viewBox="0 0 114 114" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.791667" y="0.791667" width="112.417" height="112.417" rx="56.2083" stroke="#FF662C" stroke-width="1.58333"/>
                    <path d="M24.552 63V51.576H33.128V63H31.704V52.84H25.992V63H24.552ZM39.3751 54.264C40.1111 54.264 40.7405 54.424 41.2631 54.744C41.7965 55.064 42.2018 55.5173 42.4791 56.104C42.7671 56.68 42.9111 57.3573 42.9111 58.136V58.984H37.0391C37.0605 59.9547 37.3058 60.696 37.7751 61.208C38.2551 61.7093 38.9218 61.96 39.7751 61.96C40.3191 61.96 40.7991 61.912 41.2151 61.816C41.6418 61.7093 42.0791 61.56 42.5271 61.368V62.6C42.0898 62.792 41.6578 62.9307 41.2311 63.016C40.8045 63.112 40.2978 63.16 39.7111 63.16C38.9005 63.16 38.1805 62.9947 37.5511 62.664C36.9325 62.3333 36.4471 61.8427 36.0951 61.192C35.7538 60.5307 35.5831 59.7253 35.5831 58.776C35.5831 57.8373 35.7378 57.032 36.0471 56.36C36.3671 55.688 36.8098 55.1707 37.3751 54.808C37.9511 54.4453 38.6178 54.264 39.3751 54.264ZM39.3591 55.416C38.6871 55.416 38.1538 55.6347 37.7591 56.072C37.3751 56.4987 37.1458 57.096 37.0711 57.864H41.4391C41.4391 57.3733 41.3645 56.9467 41.2151 56.584C41.0658 56.2213 40.8365 55.9387 40.5271 55.736C40.2285 55.5227 39.8391 55.416 39.3591 55.416ZM49.1744 54.264C50.2304 54.264 51.0784 54.632 51.7184 55.368C52.369 56.104 52.6944 57.2133 52.6944 58.696C52.6944 59.6667 52.545 60.488 52.2464 61.16C51.9584 61.8213 51.5477 62.3227 51.0144 62.664C50.4917 62.9947 49.873 63.16 49.1584 63.16C48.721 63.16 48.3317 63.1013 47.9904 62.984C47.649 62.8667 47.3557 62.7173 47.1104 62.536C46.8757 62.344 46.673 62.136 46.5024 61.912H46.4064C46.4277 62.0933 46.449 62.3227 46.4704 62.6C46.4917 62.8773 46.5024 63.1173 46.5024 63.32V66.84H45.0944V54.424H46.2464L46.4384 55.592H46.5024C46.673 55.3467 46.8757 55.1227 47.1104 54.92C47.3557 54.7173 47.6437 54.5573 47.9744 54.44C48.3157 54.3227 48.7157 54.264 49.1744 54.264ZM48.9184 55.448C48.3424 55.448 47.8784 55.56 47.5264 55.784C47.1744 55.9973 46.9184 56.3227 46.7584 56.76C46.5984 57.1973 46.513 57.752 46.5024 58.424V58.696C46.5024 59.4 46.577 59.9973 46.7264 60.488C46.8757 60.9787 47.1264 61.352 47.4784 61.608C47.841 61.864 48.3317 61.992 48.9504 61.992C49.473 61.992 49.8997 61.848 50.2304 61.56C50.5717 61.272 50.8224 60.8827 50.9824 60.392C51.153 59.8907 51.2384 59.32 51.2384 58.68C51.2384 57.6987 51.0464 56.9147 50.6624 56.328C50.289 55.7413 49.7077 55.448 48.9184 55.448ZM58.2501 54.264C58.9861 54.264 59.6155 54.424 60.1381 54.744C60.6715 55.064 61.0768 55.5173 61.3541 56.104C61.6421 56.68 61.7861 57.3573 61.7861 58.136V58.984H55.9141C55.9355 59.9547 56.1808 60.696 56.6501 61.208C57.1301 61.7093 57.7968 61.96 58.6501 61.96C59.1941 61.96 59.6741 61.912 60.0901 61.816C60.5168 61.7093 60.9541 61.56 61.4021 61.368V62.6C60.9648 62.792 60.5328 62.9307 60.1061 63.016C59.6795 63.112 59.1728 63.16 58.5861 63.16C57.7755 63.16 57.0555 62.9947 56.4261 62.664C55.8075 62.3333 55.3221 61.8427 54.9701 61.192C54.6288 60.5307 54.4581 59.7253 54.4581 58.776C54.4581 57.8373 54.6128 57.032 54.9221 56.36C55.2421 55.688 55.6848 55.1707 56.2501 54.808C56.8261 54.4453 57.4928 54.264 58.2501 54.264ZM58.2341 55.416C57.5621 55.416 57.0288 55.6347 56.6341 56.072C56.2501 56.4987 56.0208 57.096 55.9461 57.864H60.3141C60.3141 57.3733 60.2395 56.9467 60.0901 56.584C59.9408 56.2213 59.7115 55.9387 59.4021 55.736C59.1035 55.5227 58.7141 55.416 58.2341 55.416ZM70.9134 50.872C70.8707 51.4053 70.7374 51.8533 70.5134 52.216C70.3 52.5787 69.98 52.8507 69.5534 53.032C69.1267 53.2133 68.572 53.304 67.8894 53.304C67.196 53.304 66.636 53.2133 66.2094 53.032C65.7934 52.8507 65.4894 52.584 65.2974 52.232C65.1054 51.8693 64.988 51.416 64.9454 50.872H66.2574C66.3107 51.448 66.46 51.8373 66.7054 52.04C66.9614 52.232 67.3667 52.328 67.9214 52.328C68.412 52.328 68.796 52.2267 69.0734 52.024C69.3614 51.8107 69.532 51.4267 69.5854 50.872H70.9134ZM65.2974 59.656C65.2974 59.752 65.292 59.8907 65.2814 60.072C65.2814 60.2427 65.276 60.4293 65.2654 60.632C65.2547 60.824 65.244 61.0107 65.2334 61.192C65.2227 61.3627 65.212 61.5013 65.2014 61.608L69.7934 54.424H71.5214V63H70.2094V57.944C70.2094 57.7733 70.2094 57.5493 70.2094 57.272C70.22 56.9947 70.2307 56.7227 70.2414 56.456C70.252 56.1787 70.2627 55.9707 70.2734 55.832L65.7134 63H63.9694V54.424H65.2974V59.656ZM80.1706 55.608H77.3706V63H75.9786V55.608H73.2106V54.424H80.1706V55.608ZM83.188 59.656C83.188 59.752 83.1827 59.8907 83.172 60.072C83.172 60.2427 83.1667 60.4293 83.156 60.632C83.1453 60.824 83.1347 61.0107 83.124 61.192C83.1133 61.3627 83.1027 61.5013 83.092 61.608L87.684 54.424H89.412V63H88.1V57.944C88.1 57.7733 88.1 57.5493 88.1 57.272C88.1107 56.9947 88.1213 56.7227 88.132 56.456C88.1427 56.1787 88.1533 55.9707 88.164 55.832L83.604 63H81.86V54.424H83.188V59.656Z" fill="white"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<section class="two-column top-item dark collaboration__two-col">
    <div class="container top-mid bottom-five">
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
                        "PATH" => "components/col1.php"
                    ),
                    false
                );?>    
            </div>
            <div>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", 
                    ".default", 
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "components/col2.php"
                    ),
                    false
                );?>  
            </div>
        </div>
    </div>
</section>

<section class="dark story-video collaboration-video">
    <div class="container top-ultra bottom-seven">            
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

<section class="two-column dark collaboration__two-col">
    <div class="container top-max bottom-five">
        <h2 class="section-title">СОТРУДНИЧЕСТВО</h2>
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
                        "PATH" => "components/col3.php"
                    ),
                    false
                );?>   
            </div>
            <div>         
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", 
                    ".default", 
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "components/col4.php"
                    ),
                    false
                );?>   
        </div>
    </div>
</section>

<section class="quote dark">
    <div class="container top-seven bottom-mid center">
        <h2>
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
        </h2>
    </div>
</section>

<section class="two-article dark" style="padding-top: 4px;">
    <div class="container top-seven bottom-mid">
        <?require($_SERVER["DOCUMENT_ROOT"]."/include/two-article.php");?>
    </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>