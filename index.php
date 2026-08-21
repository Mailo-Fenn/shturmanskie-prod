<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    require($_SERVER["DOCUMENT_ROOT"]."/local/scripts/get_images.php");
    $APPLICATION->SetTitle("Интернет-магазин \"Одежда\"");
	
	if(!function_exists('viewArray')){
	function viewArray($arr) {
		
		$keys = array_keys($arr);
		$kLen = count($keys);
		
		for($i = 0; $i < $kLen; $i++) {
			
			echo '['.$keys[$i].'] - '.$arr[$keys[$i]].'<br />';
			
		}
		
		echo '<hr />';
		
	}
}
?>

<?$APPLICATION->IncludeComponent(
    "bitrix:news.list", 
    "slider-mp", 
    Array(
	    "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
        "TEXT" => "TEST",
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"DISPLAY_DATE" => "Y",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "4",	// Код информационного блока
		"IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"NEWS_COUNT" => "20",	// Количество новостей на странице
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Новости",	// Название категорий
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"PROPERTY_CODE" => array(	// Свойства
			0 => "NAME_ENG",
			1 => "URL",
			2 => "STICKER_ENG",
			3 => "STICKER_RU",
			4 => "",
		),
		"SET_BROWSER_TITLE" => "Y",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "Y",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "Y",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>

<section class="category-slider index">
    <div class="container top-ultra bottom-ultra">
        <h2 class="category-title">
            Коллекции
            <a href="/catalog/">
                Все часы
                <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.69995 1L7.99995 8.73889L1.69995 15" stroke="black" stroke-width="2"></path>
                </svg>
            </a>
        </h2>
        <?$APPLICATION->IncludeFile('/include/collection.php'); ?>
    </div>
</section>

<section class="watch-banner">
    <div class="container">
        <img class="pc" src="<?=$IMAGES_LIST[480]; ?>" />
        <img class="mob" src="<?=$IMAGES_LIST[481]; ?>" />
    </div>
</section>

<section class="our-story">
    <div class="container">
        <?$APPLICATION->IncludeComponent(
	        "bitrix:main.include", 
	        ".default", 
	        array(
        		"AREA_FILE_SHOW" => "file",
		        "AREA_FILE_SUFFIX" => "inc",
        		"EDIT_TEMPLATE" => "",
		        "COMPONENT_TEMPLATE" => ".default",
		        "PATH" => "/components/our_story.php"
	        ),
	        false
        );?>
                
        <a class="btn" href="/about/">
            <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="1" y="1" width="88" height="88" rx="44" stroke="#FF662C" stroke-width="2"></rect>
                <path d="M40.5 35L49.5 46.0556L40.5 55" stroke="black" stroke-width="2"></path>
            </svg>
            <div class="vertical-center">
                <div>
                    Полная история
                </div>
            </div>
        </a>
    </div>
</section>

<section class="space-watch">
    <div class="container">
        <?$APPLICATION->IncludeComponent(
            "bitrix:news.list", 
            "exclusive-mp", 
            array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "Y",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "5",
                "IBLOCK_TYPE" => "content",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "6",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array(
                    0 => "NAME_ENG",
                    1 => "LINK",
                    2 => "",
                    3 => "",
                    4 => "",
                    5 => "",
                ),
                "SET_BROWSER_TITLE" => "Y",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "Y",
                "SHOW_404" => "N",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N",
                "COMPONENT_TEMPLATE" => "exclusive-mp"
            ),
            false
        );?>
    </div>
</section>

<section class="with-image index">
    <div class="container top-ultra bottom-ultra">
        <div class="">
            <div class="with-image__wrapper">
                <div class="with-image__content">
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
                                    "PATH" => "/components/manufacturing.php"
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
                <div class="with-image__image manufacturing" style="background-image: url('<?=$IMAGES_LIST[482]; ?>');">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="category-slider">
    <div class="container best-sellers bottom-ultra">
        <h2 class="category-title margin-bot">
            Часто продаваемые
        </h2>
        <?$APPLICATION->IncludeFile('/include/collection.php'); ?>
    </div>
</section>

<section class="travel-banner flex" style="background-image: url('<?=$IMAGES_LIST[483]; ?>');" >
    <div class="container ">
        <div class="">
            <div class="travel-banner__content">
                <h2 class="section-title">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include", 
                        ".default", 
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "COMPONENT_TEMPLATE" => ".default",
                            "PATH" => "/components/space_travel.php"
                        ),
                        false
                    );?>
                </h2>
                    
                <a class="btn white" href="/about/">
                    <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1" y="1" width="88" height="88" rx="44" stroke="#FF662C" stroke-width="2"></rect>
                        <path d="M40.5 35L49.5 46.0556L40.5 55" stroke="black" stroke-width="2"></path>
                    </svg>
                    <div class="vertical-center">
                        <div>
                            полная история
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="two-article index">
    <div class="container top-mid bottom-mid">
        <?$APPLICATION->IncludeFile('/include/two-article.php'); ?>
    </div>
</section>

<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");