<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    require($_SERVER["DOCUMENT_ROOT"]."/local/scripts/get_images.php");
    $APPLICATION->SetTitle("Интернет-магазин \"Одежда\"");
?>


<section class="success">
    <div class="container  bottom-min form-padding first">
        <div class="success-wrapper center">
            <h1 class="section-title">
                Спасибо за покупку! Ваш заказ<br/>подтвержден.
            </h1>
            <p>
                Ваш заказ успешно подтвержден! Мы рады приветствовать Вас в семье<br/>
                Штурманских. Теперь вы в команде исследователей космоса!
            </p>
            <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_101_4179)">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M60 120C93.1373 120 120 93.1373 120 60C120 26.8629 93.1373 0 60 0C26.8629 0 0 26.8629 0 60C0 93.1373 26.8629 120 60 120ZM88.3522 47.1025C90.549 44.9058 90.549 41.3442 88.3522 39.1475C86.1555 36.9508 82.5945 36.9508 80.3978 39.1475L50.625 68.92L39.6025 57.8975C37.4058 55.7008 33.8442 55.7008 31.6475 57.8975C29.4508 60.0942 29.4508 63.6558 31.6475 65.8525L46.6475 80.8522C48.8442 83.049 52.4058 83.049 54.6025 80.8522L88.3522 47.1025Z" fill="#FF662C" />
                </g>
                <defs>
                    <clipPath id="clip0_101_4179">
                        <rect width="120" height="120" fill="white" />
                    </clipPath>
                </defs>
            </svg>
        </div>
    </div>
</section>

<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");