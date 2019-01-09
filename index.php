<?php
session_start();
//общие настройки
header('Content-Type: text/html; charset=UTF8');

//отображения ошибок
ini_set('display_errors',1);
error_reporting(E_ALL);

$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;

$err = array();

//Устанавливаем ключ защиты
define('KEY', true);

//соединение с бд
require('config/config.php');
require('config/functions.php');
DataBase::createUsers();
DataBase::createAdmins();
DataBase::createLog();
$db = DataBase::getInstance();

if($user === false){
    include 'auth/auth.php';
    include 'auth/form.php';

}
else if($user === true) {
    //Выход из авторизации
    if(isset($_GET['exit']) == true){
        //Уничтожаем сессию
        session_destroy();

        //Делаем редирект
        header('Location:/');
        exit;
    }
    $mode = '';
    if(isset($_GET['mode'])){
        $mode=$_GET['mode'];
    }
    switch($mode){
        case 'users': include('admin/index.php'); break;
        case 'log': include('admin/log.php'); break;
        default:include('admin/index.php');
    }

}