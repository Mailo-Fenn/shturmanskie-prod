<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Request an appointment");
?>

<section class="manuals-title">
    <div class="container first bottom-mid top-mid">
        <h1 class="title-middle center">Назначить Встречу</h1>
    </div>
</section>

        <section class="manuals-body">
            <div class="container bottom-mid top-mid form">
                <form>
                    <h2 class="form-title">Выберите бутик</h2>
                    <div class="form-section">
                        <label>
                            <span> Местоположение</span>
                            <select>
                                <option>Russia</option>
                            </select>
                        </label>
                        <label>
                            <span>Выберите город</span>
                            <select>
                                <option>Blagoveshensk</option>
                                <option>Russia</option>
                            </select>
                        </label>
                        <p class="form-section__result">12 результатов по Россия</p>
                    </div>

                    <div class="form-contact">
                        <h3>"Женева"</h3>
                        <p>
                            Shevchenko st.,65<br/>
                            +7(4162)518323<br/>
                            kavsig@mail.ru
                        </p>
                        <button class="button">
                            Выбрать этот бутик
                            <svg width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 14L13 9L8 4" stroke="white" stroke-width="1.5" />
                            </svg>
                        </button>
                    </div>

                    <div class="form-contact">
                        <h3>"Цюрих"</h3>
                        <p>
                            Shevchenko st.,65<br/>
                            +7(4162)518323<br/>
                            kavsig@mail.ru
                        </p>
                        <button class="button">
                            Select this boutique
                            <svg width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 14L13 9L8 4" stroke="white" stroke-width="1.5" />
                            </svg>
                        </button>
                    </div>

                    <div class="form-section second">
                        <h2 class="form-title">Цель вашего визита</h2>
                        <label>
                            <span>Причина визита</span>
                            <select>
                                <option>Посмотреть часы Штурманские</option> 
                            </select>
                        </label>
                    </div>

                    <div class="form-section third">
                        <h2 class="form-title">Личная Информация и Детали Встречи</h2>
                        <label>
                            <span class="margened">Ваши личные данные</span>
                            <input required placeholder="Имя" />
                        </label>
                        <label>
                            <input required placeholder="Фамилия" />
                        </label>
                        <label>
                            <input required type="email" placeholder="Электронная почта" />
                        </label>
                        <label>
                            <input required placeholder="Номер телефона" />
                        </label>
                    </div>

                    <div class="form-section fourth">
                        <label>
                            <span class="margened">Ваши предпочтения</span>
                            <input type="date" placeholder="Дата" />
                        </label>
                        <label>
                            <input required placeholder="Предпочитаемый Язык" />
                        </label>
                        <button style="letter-spacing: -0.01em;">Назначить встречу</button>
                    </div>
                </form>
            </div>
        </section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>