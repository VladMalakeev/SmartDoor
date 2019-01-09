<?php
define('KEY', true);
header('Content-Type: text/html; charset=UTF8');
require('../config/config.php');
$db = DataBase::getInstance();

if(isset($_GET['login'],$_GET['password'])){
    $login = $_GET['login'];
    $password = $_GET['password'];

    $admin = $db->query("SELECT * FROM admins_411 WHERE email = '$login' AND active = 1")->fetch(PDO::FETCH_LAZY);
    if($admin) {
        if (md5(md5($password) . $admin->salt) == $admin->password) {
            if(isset($_GET['get_users'])){
                $users = $db->query("SELECT * FROM users_411")->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($users);
            }
            else if(isset($_GET['get_log'])){
                $log = $db->query("SELECT * FROM log_411")->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($log);
            }
            else if(isset($_GET['access'],$_GET['id'])) {
                $id = $_GET['id'];
                $result = $db->exec("UPDATE users_411 SET access=1 WHERE id_users = '$id'");
                if ($result) {
                    echo 'success';
                } else 'false';
            }
            else if(isset($_GET['disable'],$_GET['id'])){
                $id =  $_GET['id'];
                $result = $db->exec("UPDATE users_411 SET access=0 WHERE id_users = '$id'");
                if($result){
                    echo 'success';
                }else 'false';
            }
            else if(isset($_GET['delete'],$_GET['id'])){
                $id =  $_GET['id'];
                $result = $db->exec("DELETE FROM users_411 WHERE id_users = '$id'");
                if($result){
                    echo 'success';
                }else 'false';
            }
            else echo 'Ошибка в запросе!';

        }else echo 'Неверный логин или пароль!';

    }else echo 'Неверный логин или пароль!';

}else echo 'Ошибка в запросе!';

