<?php
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

    // Получаем "сырое" тело запроса (ожидаем JSON)
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Проверяем, что данные получены и это массив
    if (is_array($data)) {
        $fname = htmlspecialchars(trim($data['fname']));
        $lname = htmlspecialchars(trim($data['lname']));
        $email = htmlspecialchars(trim($data['email']));
        $phone = htmlspecialchars(trim($data['phone']));
        $message = htmlspecialchars(trim($data['message']));

        // Формируем массив для почтового события
        $arEventFields = array(
            "FNAME" => $fname,
            "LNAME" => $lname,
            "EMAIL" => $email,
            "PHONE" => $phone,
            "MESSAGE" => $message,
        );

        // Отправляем почтовое событие NEW_MSG
        $result = CEvent::Send("NEW_MSG", SITE_ID, $arEventFields);

        // Возвращаем результат в формате JSON
        header('Content-Type: application/json');
        if ($result) {
            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("success" => false, "error" => "Ошибка отправки сообщения"));
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(array("success" => false, "error" => "Некорректные данные"));
    }
