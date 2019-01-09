<?php
define('KEY', true);
header('Content-Type: text/html; charset=UTF8');
require('../config/config.php');
$db = DataBase::getInstance();

if(isset($_GET['mac'],$_GET['name'],$_GET['last_name'],$_GET['phone'],$_GET['group'])){
    $mac = $_GET['mac'];
    $name = $_GET['name'];
    $last_name = $_GET['last_name'];
    $group = $_GET['group'];
    $phone = $_GET['phone'];

    $checkMacAddress = "SELECT * FROM users_411 WHERE mac = '$mac'";
    $user = $db->query($checkMacAddress)->fetch(PDO::FETCH_LAZY);
    if(empty($user)){
        $db->exec("ALTER TABLE admins_411 AUTO_INCREMENT=1");
        $addUser = "INSERT INTO users_411(access,name,last_name,group_name,mac,phone) VALUES(0,'$name','$last_name','$group','$mac','$phone')";
        if($db->exec($addUser)){
           addLog($mac);
        }
        echo 'false';
    }
    else {
        addLog($mac);
        if($user['access']== 1){
            echo 'true';
        }
        else echo 'false';
    }

}
else echo 'Ошибка в запросе!';

function addLog($mac){
    $db = DataBase::getInstance();
    $getUser = "SELECT id_users FROM users_411 WHERE mac = '$mac'";
    $data = $db->query($getUser)->fetch(PDO::FETCH_LAZY);
    $user_id  = $data['id_users'];
    $time = time();

    $db->exec("ALTER TABLE log_411 AUTO_INCREMENT=1");
    $newLog = "INSERT INTO log_411(user_id,time) VALUES($user_id,$time)";
    $db->exec($newLog);
}