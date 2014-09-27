<?php

define('SUCCESS', 0);
define('ERROR_CONNECTION_FAILED', 1);
define('ERROR_NODB', 2);
define('ERROR_LOGIN_OR_PASSWORD_EMPTY', 3);
define('ERROR_DB', 4);
define('LOGIN_ALREADY_EXISTS', 5);
define('INCORRECT_PAIR_LOGIN_PASSWORD', 6);

function getErrorMessage($code)
{
    switch($code)
    {
        case 1: return 'Ошибка соединения с базой данных';
        case 2: return 'База данных не найдена';
        case 3: return 'Логин или пароль пуст';
        case 4: return 'Ошибка базы данных';
        case 5: return 'Возможно пользователь с таким логином уже существует';
        case 6: return 'Некорректная пара логин/пароль';
        default: return '';
    }
}


