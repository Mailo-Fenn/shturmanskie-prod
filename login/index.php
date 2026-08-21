<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("User Manuals");
?>

<section class="login black">
    <div class="container imaged-container big-padding form first">
        <div class="login-tabs">
            <a href="/login/" class="active">Логин</a>
            <a href="/login/register/">Регистрация</a>
        </div>
        <div class="login-description">
            Получите доступ к своей учетной записи легко и безопасно с<br/>
            помощью нашей удобной системы входа.
        </div>
 
        <?$APPLICATION->IncludeComponent(
            "watch:login",
            "",
            array(),
            false
        );?> 
    </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>