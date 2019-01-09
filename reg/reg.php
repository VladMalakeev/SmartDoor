<?php
/**
 * Обработчик формы регистрации
 */
if(!defined('KEY'))
{
    header("HTTP/1.1 404 Not Found");
    exit(file_get_contents('../404.html'));
}
/*Если нажата кнопка на регистрацию,
начинаем проверку*/
if(isset($_POST['submit_reg']))
{
    $db = DataBase::getInstance();
    $name =  $_POST['name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $salt = substr(md5(uniqid()), -8);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $hesh_password = md5(md5($_POST['password']).$salt);

    if($password != $confirm_password){
    $err[] = 'пароли не совпадают';
    }

    /*Проверяем существует ли у нас такой пользователь в БД*/
    $sql = "SELECT `email` 
					FROM admins_411
					WHERE `email` = '$email'";
    //Подготавливаем PDO выражение для SQL запроса
    $result = $db->query($sql);
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows) > 0)
        $err[] = 'Пользователь с таким email уже существует';

    //Проверяем наличие ошибок и выводим пользователю
    if(count($err) > 0)
        echo showErrorMessage($err);
    else
    {
        /*Если все хорошо, пишем данные в базу*/
        $db->exec("ALTER TABLE admins_411 AUTO_INCREMENT=1");
        $sql = "INSERT INTO admins_411(active, name, last_name, email, password,salt)
						VALUES(0, '$name','$last_name', '$email', '$hesh_password', '$salt')";
        //Подготавливаем PDO выражение для SQL запроса
        if(!$db->exec($sql)){
            $err[] = 'Ошибка добавления пользователя';
            echo showErrorMessage($err);
        }else {
            header('Location:/index.php?reg=true');
            exit;
        }
    }
}

