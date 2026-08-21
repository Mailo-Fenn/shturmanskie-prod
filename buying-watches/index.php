<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"]."/local/scripts/get_images.php");
$APPLICATION->SetTitle("Выкуп часов");
?>

<section class="text-banner">
    <div class="container only-text center">
        <h2 class="title">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include", 
                ".default", 
                array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "COMPONENT_TEMPLATE" => ".default",
                    "PATH" => "components/title.php"
                ),
                false
            );?> 
        </h2>
    </div>
</section>

<section class="imaged-text engravings">
    <div class="container under-banner">
        <div class="grid">
            <div class="imaged-text__content">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", 
                    ".default", 
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "components/paragraf1.php"
                    ),
                    false
                );?> 
            </div>
            <div class="imaged-text__image-wrapper">
                <div 
                    class="imaged-text__image"
                    style="background-image: url('/images/buying/img-1.webp');"
                ></div>
            </div>
        </div>
    </div>
</section>

<section class="imaged-text engravings-paragraf left">
    <div class="container imaged-container">
        <div class="grid">
            <div class="imaged-text__image-wrapper">
                <div 
                    class="imaged-text__image"
                    style="background-image: url('/images/buying/img-2.webp');"
                ></div>
            </div>
            <div class="imaged-text__content">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", 
                    ".default", 
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "components/paragraf2.php"
                    ),
                    false
                );?>     
            </div>
        </div>
    </div>
</section>

<section class="imaged-text engravings-paragraf">
    <div class="container imaged-container">
        <div class="grid">
            <div class="imaged-text__content">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", 
                    ".default", 
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "components/paragraf3.php"
                    ),
                    false
                );?>         
            </div>
            <div class="imaged-text__image-wrapper">
                <div 
                    class="imaged-text__image"
                    style="background-image: url('/images/buying/img-3.webp');"
                ></div>
            </div>
        </div>
    </div>
</section>


<section style="margin-top: 80px; margin-bottom: 80px;">
	<div class="imaged-text">
		<div class="container">			
			<h3 style="margin-bottom: 30px;">Если у вас есть такие часы – свяжитесь с нами</h3>
			<p class="paragraf" style>
				<a href="https://api.whatsapp.com/send/?phone=79257713211&amp;text&amp;type=phone_number&amp;app_absent=0" target="_blank"><img src="/images/buying/icon-whatsapp.svg" alt="" style=" float: left; margin-right: 20px;" /></a>
				Напишите в <br><a href="https://api.whatsapp.com/send/?phone=79257713211&amp;text&amp;type=phone_number&amp;app_absent=0" target="_blank" style="color: #000000;"><b>WhatsApp</b></a>
			</p>
			<p class="paragraf" style="clear: both; margin-top: 30px;">
				<a href="tel:88007777815"><img src="/images/buying/icon-phone.svg" alt="" style=" float: left; margin-right: 20px;" /></a>
				Позвоните по телефону<br><a href="tel:88007777815" style="color: #000000;"><b>8 800 777-78-15</b></a>
			</p>
			<p class="paragraf" style="clear: both; margin-top: 30px;">
				<a href="mailto:info@sturmanskie.ru"><img src="/images/buying/icon-email.svg" alt="" style=" float: left; margin-right: 20px;" /></a>
				отправьте сообщение на почту<br><a href="mailto:info@sturmanskie.ru" style="color: #000000;"><b>info@sturmanskie.ru</b></a>
			</p>
		</div>
	</div>
</section>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>