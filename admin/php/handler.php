<?php
if(!defined('KEY'))
{
    header("HTTP/1.1 404 Not Found");
    exit(file_get_contents('../../404.html'));
}
function getAdminData(){
    $db = DataBase::getInstance();
    $email = $_SESSION['email'];
    $query = "SELECT * FROM admins_411 WHERE email = '$email'";
    $admin = $db->query($query)->fetch(PDO::FETCH_LAZY);
    return $admin;
}

function getUsers(){
    $db = DataBase::getInstance();
    return $db->query("SELECT * FROM users_411")->fetchAll(PDO::FETCH_ASSOC);
}

function getLog(){
    $db = DataBase::getInstance();
   $query = " SELECT name, last_name, group_name, access,id_log, time FROM `users_411` `user` INNER JOIN `log_411` `log` ON `user`.`id_users`=`log`.`user_id`;";
   return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

}

if(isset($_POST['not_access'])){
  $id =  $_POST['user_id'];
  $db->exec("UPDATE users_411 SET access=0 WHERE id_users = '$id'");
}

if(isset($_POST['access'])){
    $id =  $_POST['user_id'];
    $db->exec("UPDATE users_411 SET access=1 WHERE id_users = '$id'");
}

if(isset($_POST['delete'])){
    $id =  $_POST['user_id'];
    $db->exec("DELETE FROM users_411 WHERE id_users = '$id'");
}