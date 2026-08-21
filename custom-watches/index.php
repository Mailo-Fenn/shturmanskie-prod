<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"]."/local/scripts/get_images.php");
$APPLICATION->SetTitle("Гравировка");
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
                    style="background-image: url('<?=$IMAGES_LIST[464]; ?>');"
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
                    style="background-image: url('<?=$IMAGES_LIST[465]; ?>');"
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
                    style="background-image: url('<?=$IMAGES_LIST[466]; ?>');"
                ></div>
            </div>
        </div>
    </div>
</section>

<section class="imaged-text engravings-paragraf left">
    <div class="container imaged-container middle-padding">
        <div class="grid">
            <div class="imaged-text__image-wrapper">
                <div 
                    class="imaged-text__image"
                    style="background-image: url('<?=$IMAGES_LIST[467]; ?>');"
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
                        "PATH" => "components/paragraf4.php"
                    ),
                    false
                );?>     
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container form form-padding engravings-form">
        <form>
            <h2 class="form-title">Отправьте нам сообщение с вашими пожеланиями по изготовлению часов на заказ.</h2>
            <div class="form-result" style="display: none;">Ваша заявка отправлена</div>
            <div class="form-section">
                <h3 class="form-section__title">Ваши личные данные</h3>
                <label>
                    <input placeholder="Имя" name="fname" required />
                </label>
                <label>
                    <input placeholder="Фамилия" name="lname" required />
                </label>
                <label>
                    <input placeholder="Электронная почта" type="email" name="email" required />
                </label>
                <label>
                    <input placeholder="Номер телефона" name="phone" required />
                </label>
                <h3 class="form-section__paragraf">Ваше сообщение</h3>
                <label>
                    <textarea placeholder="Ваше сообщение" name="message"></textarea>
                </label>
                <button>Отправить сообщение</button>
            </div>
        </form>
    </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>