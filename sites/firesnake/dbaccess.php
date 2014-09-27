<?php

require_once('dbconfig.php');
require_once('error.php');

/**
 * Connect to mysql database with given connection parameters from dbconfig.php
 * @return bool if all right | string if an error was occur
 */
function connect()
{
    $error = SUCCESS;

    setlocale(LC_ALL, 'ru_RU.UTF8');
    date_default_timezone_set('Europe/Moscow');

    if(!mysql_connect(server, userName, password))
        throw new Exception('', ERROR_CONNECTION_FAILED);

    mysql_query('set names utf8');

    if(!mysql_select_db(dbname))
        throw new Exception('', ERROR_NODB);
}

/**
 * Add a new record
 * @param $userId - user which record should be added
 * @param $record - value of record
 * @return true if all right, false if an error was occur
 */
function addRecord($userId, $record)
{
    $q = "insert into records (id_user, record, dt) values ('%d', '%d', CURRENT_DATE)";
    $buff = sprintf($q, $userId, $record);

    if(!mysql_query($buff))
        throw new Exception(mysql_error(), ERROR_DB);
}

/**
 * Return records for user
 * @param $userId - user id
 * @return array with data
 */
function getRecords($userId)
{
    $userId = "'" . (int)$userId . "'";
    $q = "select record, DATE_FORMAT(dt, '%e.%c.%Y') dt from records where id_user = $userId order by record asc";
    $res = mysql_query($q);

    if(!$res)
        throw new Exception(mysql_error(), ERROR_DB);

    $array = array();

    while($row = mysql_fetch_assoc($res))
        $array[] = $row;

    return $array;
}

/**
 * Return max value of all record
 * @return int - max record or -1 if function failed
 */
function getMaxRecord()
{
    $res = mysql_query("select max(record) from records");

    if(!$res)
        throw new Exception(mysql_error(), ERROR_DB);

    $array = mysql_fetch_assoc($res);
    return $array['max(record)'];
}

function addUser($login, $password)
{
    $login = trim($login);
    $password = trim($password);

    if($login == '' || $password == '')
        throw new Exception('', ERROR_LOGIN_OR_PASSWORD_EMPTY);

    $q = "insert into users (login, password) values ('%s', '%s')";
    $buff = sprintf($q, protect($login), protect($password));

    if(!mysql_query($buff))
        throw new Exception('', LOGIN_ALREADY_EXISTS);

    return mysql_insert_id();
}

function findUser($login, $password)
{
    $login = trim($login);
    $password = trim($password);

    if($login == '' || $password == '')
        throw new Exception('', ERROR_LOGIN_OR_PASSWORD_EMPTY);

    $q = "select * from users where login = '%s' and password = '%s'";
    $buff = sprintf($q, protect($login), protect($password));

    if(!($res = mysql_query($buff)))
       throw new Exception(mysql_error(), ERROR_DB);

    if(mysql_num_rows($res) != 1)
        throw new Exception('', INCORRECT_PAIR_LOGIN_PASSWORD);

    return mysql_fetch_assoc($res);
}

/**
 * Protects string from XSS
 * @param $str - string to be protected
 * @return string - protected string
 */
function protect($str)
{
    return htmlspecialchars(mysql_real_escape_string($str));
}
