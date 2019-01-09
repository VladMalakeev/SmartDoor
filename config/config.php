<?php
if(!defined('KEY'))
{
    header("HTTP/1.1 404 Not Found");
    exit(file_get_contents('../404.html'));
}
class DataBase
{
    private static $instance = null;
    private function __construct(){}

    public static function getInstance(){
        if(self::$instance==null){
            $host = 'localhost';
            $db = 'vlad_malakeev';
            $user = 'vlad_malakeev';
            $pass = 'Vlad2020';
            $charset = 'utf8';
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            self::$instance = new PDO($dsn, $user, $pass);
        }
        return self::$instance;
    }
    
    public static function createUsers(){
        $db = self::getInstance();
        $users = "CREATE TABLE IF NOT EXISTS users_411(
         id_users int(11) AUTO_INCREMENT primary key,
         access boolean,
         name varchar (255),
         last_name varchar (255),
         group_name varchar (255),
         mac varchar (255),
         phone varchar (255))";

        if($db->exec($users))
            return true;
        else return false;
    }

    public static function createAdmins(){
        $db = self::getInstance();
        $admins = "CREATE TABLE IF NOT EXISTS admins_411(
         id_admins int(11) AUTO_INCREMENT primary key,
         active boolean,
         name varchar (255),
         last_name varchar (255),
         email varchar (255),
         password varchar (255),
         salt varchar (255))";
        if($db->exec($admins))
            return true;
        else return false;
    }

    public static function createLog(){
        $db = self::getInstance();
        $log = "CREATE TABLE IF NOT EXISTS log_411(
        id_log int(11) AUTO_INCREMENT primary key,
        user_id int(11),
        time int(11),
        FOREIGN KEY (user_id) REFERENCES users_411(id_users) ON DELETE CASCADE)";
        if($db->exec($log))
            return true;
        else return false;
    }
}