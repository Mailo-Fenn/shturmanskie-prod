<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Наши бутики");
?>

<section class="where-map"> 
    <div class="container first">
        <?$APPLICATION->IncludeComponent(
            "watch:map",
             "",
            array(),
            false
        );?> 
    </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>