<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
    CHTTP::SetStatus("404 Not Found");
    @define("ERROR_404","Y");
    const HIDE_SIDEBAR = true;
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Страница не найдена");
?>

        <section class="error-page">
            <div class="container bottom-mid top-mid first">
                <div class="grid">
                    <div class="error-page__content">
                        <h1>404</h1>
                        <p>Запрошенная страница не существует. Возможно, она была удалена или запрос содержал неверный адрес страницы.</p>
                        <a href="/">Перейти на главную</a>
                    </div>
                </div>
            </div>
        </section>
	 
<?php
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
