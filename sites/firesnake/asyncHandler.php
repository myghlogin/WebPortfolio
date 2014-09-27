<?php

error_reporting(0);
require_once('controller.php');

$records = array();
$maxRecord = 0;
$errorMsg = '';
$login = '';
$userId = null;
$content = template('tpl_error.php', array('errorMsg' => 'Отправлен некорректный запрос. Обновите страницу.'));

if(!empty($_POST))
{
    if(isset($_POST['login']) && isset($_POST['password']))
    {
        try
        {
            connect();
            if(isset($_POST['loginBtn']))
            {
                $user = login($_POST['login'], $_POST['password']);
                $userId = $user['id_user'];
            }
            else if(isset($_POST['registerBtn']))
            {
                $userId = registerUser($_POST['login'], $_POST['password']);
            }

            if($userId != null)
                $records = getRecords($userId);
            else if(isAuthorized())
                $records = getRecords($_COOKIE['user_id']);

            $maxRecord = getMaxRecord();

            if($maxRecord == '')
                $maxRecord = 0;

            $content = template('tpl_authview.php', array('error' => '','maxRecord' => $maxRecord, 'records' => $records));
        }
        catch(Exception $e)
        {
            switch($e->getCode())
            {
                case ERROR_DB:
                case ERROR_CONNECTION_FAILED:
                case ERROR_NODB:
                case ERROR_LOGIN_OR_PASSWORD_EMPTY:
                case INCORRECT_PAIR_LOGIN_PASSWORD:
                case LOGIN_ALREADY_EXISTS:
                    $errorMsg = getErrorMessage($e->getCode());
            };

            $login = $_POST['login'];
            $error = template('tpl_error.php', array('errorMsg' => $errorMsg));
            $content = template('tpl_unauthview.php', array('error' => $error, 'login' => $login));
        }
    }
    else if(isset($_POST['logoutBtn']))
    {
        $content = template('tpl_unauthview.php', array('error' => '', 'login' => ''));
        logout();
    }
}

header("Content-Type: text/html; charset=utf-8");
echo $content;

?>