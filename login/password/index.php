<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Смена пароля");
?>

<section class="login black">
    <div class="container imaged-container big-padding form first">
        <?$APPLICATION->IncludeComponent(
            "watch:password",
            "",
            array(),
            false
        );?> 
    </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>