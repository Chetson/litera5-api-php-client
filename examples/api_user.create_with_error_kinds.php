<?php

/**
 * Работа с учётными записями пользователей
 */

require_once "_litera5_api_config.php";

$api = new Litera5\API(API_SECRET_KEY);

/**
 * Создание нового пользователя
 * Указав требуемый пароль и задав типы примечаний показываемых по умолчанию
 */
$resp = $api->user(
    Litera5\UserRequest::start(COMPANY, "withpassword")
        ->name("Василий Петрович")
        ->password("lthgfhjkm")
        ->ortho_kinds([
            Litera5\OrthoKind::SPELLING,
            Litera5\OrthoKind::GRAMMAR,
            Litera5\OrthoKind::PUNCTUATION,
            Litera5\OrthoKind::YO
        ])
        ->cicero_kinds([
            Litera5\CiceroKind::SYNONYM
        ])
);

if ($resp->is_success()) {
    if ($resp->has_valid_signature()) {
        print "Пользователь создан\n";
        print "Новый пароль: " . $resp->password . "\n";
    } else {
        print "Ошибка проверки подписи.\n";
    }
} else {
    print "Ошибка запроса\n";
    print "error_code: " . $resp->error_code . "\n";
    print "error_message: " . $resp->error_message . "\n";
}
