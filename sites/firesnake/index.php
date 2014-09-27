<?php

error_reporting(0);
require_once('controller.php');

$records = array();
$maxRecord = 0;
$errorMsg = '';
$error = '';

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if(isAuthorized())
    {
        try
        {
            connect();
            $records = getRecords($_COOKIE['user_id']);

            $maxRecord = getMaxRecord();
            if($maxRecord == '')
                $maxRecord = 0;
        }
        catch(Exception $e)
        {
            switch($e->getCode())
            {
                case ERROR_DB:
                    $errorMsg = getErrorMessage($e->getCode()) . ': ' . $e->getMessage();
                    break;
                case ERROR_CONNECTION_FAILED:
                case ERROR_NODB:
                default:
                    $errorMsg = getErrorMessage($e->getCode());
            };
        }
    }
}

header("Content-Type: text/html; charset=utf-8");

if(isAuthorized())
{
    if($errorMsg != '')
        $error = template('tpl_error.php', array('errorMsg' => $errorMsg));

    $content = template('tpl_authview.php', array('error' => $error,'maxRecord' => $maxRecord, 'records' => $records));
}
else
    $content = template('tpl_unauthview.php', array('errorMsg' => '', 'login' => ''));

echo template('tpl_general.php', array('content' => $content));
?>
