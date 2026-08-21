<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Регистрация");
?>

<section class="login">
    <div class="container imaged-container big-padding form first">
        <div class="login-tabs">
            <a href="/login/">Логин</a>
            <a href="/login/register/" class="active">Регистрация</a>
        </div>
        <div class="login-description">
            Регистрация быстрая, безопасная и является первым шагом к тому,<br/>
            чтобы сделать каждый момент особенным.
        </div>

        <?$APPLICATION->IncludeComponent(
            "watch:registration",
            "",
            array(),
            false
        );?> 
    </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>