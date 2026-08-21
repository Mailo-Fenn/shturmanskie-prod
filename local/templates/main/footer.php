<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<? 
    global $LENGUAGE; 
    require(__DIR__."/lang/$LENGUAGE/template.php");
?>

        <footer class="footer">
            <div class="container">
                <div class="grid">
                    <div class="footer-c1">
                        <h2 class="footer-title">
                            <?=$MESS['SUBSCRIBE']; ?>
                        </h2>

                        <div class="footer-c1__flex">
                            <form>
                                <input 
                                    placeholder="<?=$MESS['EMAIL']; ?>"
                                    required
                                    type="email"
                                    name="email"
                                    autocomplete="off"
                                />
                                <button></button>
                                <p class="good form-resp" style="display: none;">
                                    <?=$MESS['SUBSCRIBED']; ?>
                                </p>
                                <p class="error  form-resp" style="display: none;">
                                    <?=$MESS['ERROR']; ?>    
                                </p>
                            </form>
                        </div>

                        <img class="footer-payment mob" src="/images/payment-method.svg" />
                    </div>
                    <div class="footer-c2">
                        <div class="footer-column">
                            <div class="">
                                <h2 class="footer-title">
                                    <?=$MESS['BRAND']; ?>
                                </h2>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:menu", 
                                    "template_new", 
                                    array(
                                        "ALLOW_MULTI_SELECT" => "N",
                                        "CHILD_MENU_TYPE" => "left",
                                        "DELAY" => "N",
                                        "MAX_LEVEL" => "1",
                                        "MENU_CACHE_GET_VARS" => array(
                                        ),
                                        "MENU_CACHE_TIME" => "3600",
                                        "MENU_CACHE_TYPE" => "N",
                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                        "ROOT_MENU_TYPE" => "bottom_1_ru",
                                        "USE_EXT" => "N",
                                        "COMPONENT_TEMPLATE" => "template_new"
                                    ),
                                    false
                                );?> 
                            </div>
                            <div class="">
                                <h2 class="footer-title">
                                    <?=$MESS['CATALOG']; ?>
                                </h2>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:menu", 
                                    "template_new", 
                                    array(
                                        "ALLOW_MULTI_SELECT" => "N",
                                        "CHILD_MENU_TYPE" => "left",
                                        "DELAY" => "N",
                                        "MAX_LEVEL" => "1",
                                        "MENU_CACHE_GET_VARS" => array(
                                        ),
                                        "MENU_CACHE_TIME" => "3600",
                                        "MENU_CACHE_TYPE" => "N",
                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                        "ROOT_MENU_TYPE" => "bottom_2_ru",
                                        "USE_EXT" => "N",
                                        "COMPONENT_TEMPLATE" => "template_new"
                                    ),
                                    false
                                );?> 
                            </div>
                            <div class="">
                                <h2 class="footer-title">
                                    <?=$MESS['COLLECTIONS']; ?>
                                </h2>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:menu", 
                                    "template_new", 
                                    array(
                                        "ALLOW_MULTI_SELECT" => "N",
                                        "CHILD_MENU_TYPE" => "left",
                                        "DELAY" => "N",
                                        "MAX_LEVEL" => "1",
                                        "MENU_CACHE_GET_VARS" => array(
                                        ),
                                        "MENU_CACHE_TIME" => "3600",
                                        "MENU_CACHE_TYPE" => "N",
                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                        "ROOT_MENU_TYPE" => "bottom_3_ru",
                                        "USE_EXT" => "N",
                                        "COMPONENT_TEMPLATE" => "template_new"
                                    ),
                                    false
                                );?> 
                            </div>
                            <div class="active">
                                <h2 class="footer-title">
                                    <?=$MESS['C_CASE']; ?> 
                                </h2>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:menu", 
                                    "template_new", 
                                    array(
                                        "ALLOW_MULTI_SELECT" => "N",
                                        "CHILD_MENU_TYPE" => "left",
                                        "DELAY" => "N",
                                        "MAX_LEVEL" => "1",
                                        "MENU_CACHE_GET_VARS" => array(
                                        ),
                                        "MENU_CACHE_TIME" => "3600",
                                        "MENU_CACHE_TYPE" => "N",
                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                        "ROOT_MENU_TYPE" => "bottom_4_ru",
                                        "USE_EXT" => "N",
                                        "COMPONENT_TEMPLATE" => "template_new"
                                    ),
                                    false
                                );?>  
                            </div>
                        </div>
                    </div>
                </div>
                <img class="footer-payment pc" src="/images/payment-method.svg" />
            </div>
            <div class="footer-underline">
                <div class="container">
                    © <?=date("Y"); ?> <?=$MESS['COPY']; ?>
                </div>
            </div>
        </footer>


        <div class="loader" style="display: none;"> 
            <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 8.00023L18.3642 5.63609M5.63631 18.364L8.00026 16M17.6566 12H21M3 12H6.34315M12 6.34342L12 3M12 21L12 17.6569M8.00023 8.00023L5.63609 5.63609M18.364 18.364L16 16" stroke="#ff662c" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
        <script src="<?=SITE_TEMPLATE_PATH;?>/js/slick.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?=SITE_TEMPLATE_PATH;?>/js/script.js?v=<?=time();?>" type="text/javascript" charset="utf-8"></script>
        <script src="<?=SITE_TEMPLATE_PATH;?>/js/custom.js" type="text/javascript" charset="utf-8"></script>
    </body>
</html>