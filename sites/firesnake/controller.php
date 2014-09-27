<?php

require_once('dbaccess.php');

/**
 * Register a new user
 * @param $login - user login
 * @param $password - user password
 * @return bool - true if all right otherwise if an error was occur
 */
function registerUser($login, $password)
{
    $lastId = addUser($login, $password);
    setcookie('user_id', $lastId, time() + 30*24*60*60);  // one month
    return $lastId;
}

/**
 * Try login a user
 * @param $login - user login
 * @param $password - user password
 * @return bool - true if all right otherwise if an error was occur
 */
function login($login, $password)
{
    $row = findUser($login, $password);

    if($row != null)
        setcookie('user_id', $row['id_user'], time() + 30*24*60*60);  // one month

    return $row;
}

/**
 * Logout user
 */
function logout()
{
    setcookie('user_id', 0, time()-24*60*60);  // delete cookie
}

/**
 * Verify if user is authorised
 * @return true if user is authorized otherwise false
 */
function isAuthorized()
{
    //session_start();

    return isset($_COOKIE['user_id']);// || isset($_SESSION['user_id']);
}

/**
 * Generates template from given filename with given variables
 * @param $fileName - path to template file
 * @param array $vars - variables which are used in that template
 * @return string - html code
 */
function template($fileName, $vars = array())
{
    foreach($vars as $key => $value)
        $$key = $value;

    ob_start();
    include($fileName);
    return ob_get_clean();
}
function iterateArray($array)
{
    $str = '';

    foreach($array as $key => $value)
        $str .= $key . ':' . $value . "\n";

    return $str;
}

/**
 * Write message to log file
 * @param $message - message to write to log file
 */
function logmsg($message)
{
    $file = fopen('log.txt', 'a+');
    $line = str_repeat('_', 30);
    fputs($file, "\n" . $line . "\n" . $message);
    fclose($file);
}



