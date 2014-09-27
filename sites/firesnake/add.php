<?php

error_reporting(0);
require_once("controller.php");

$data = array('result' => false, 'content' => '');

if(isAuthorized() && isset($_POST['score']))
{
    $id = $_COOKIE['user_id'];
    $score = $_POST['score'];
    $errorMsg = '';
    $error = '';
    $records = array();
    $maxRecord = 0;

    try
    {
        connect();

        try {
            addRecord($id, $score);
        }
        catch(Exception $e) {}

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
            case ERROR_CONNECTION_FAILED:
            case ERROR_NODB:
                $errorMsg = getErrorMessage($e->getCode());
        }

        $error = template('tpl_error.php', array('errorMsg' => $errorMsg));
    }

    $data['result'] = true;
    $data['content'] = template('tpl_authview.php', array('error' => $error, 'records' => $records, 'maxRecord' => $maxRecord));
}

echo json_encode($data);
