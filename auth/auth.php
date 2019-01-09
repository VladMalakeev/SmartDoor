<?php
if(!defined('KEY'))
{
    header("HTTP/1.1 404 Not Found");
    exit(file_get_contents('../404.html'));
}
/**
 * Обработчик формы авторизации
 * Авторизация пользователя
 */

//Если нажата кнопка то обрабатываем данные
if(isset($_POST['login_btn']))
{
    $email=$_POST['email'];
    $password = $_POST['password'];
    /*Создаем запрос на выборку из базы
    данных для проверки подлиности пользователя*/
    $sql = 'SELECT * 
				FROM admins_411
				WHERE `email` = :email
				AND `active` = 1';
    //Подготавливаем PDO выражение для SQL запроса
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    //Получаем данные SQL запроса
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //Если логин совподает, проверяем пароль
    if(count($rows) > 0)
    {
        //Получаем данные из таблицы
        if(md5(md5($password).$rows[0]['salt']) == $rows[0]['password'])
        {
            $_SESSION['email'] = $email;
            $_SESSION['user'] = true;
            //Сбрасываем параметры
            header('Location:/' );
            exit;
        }
        else
            $err[] = 'Неверный логин или пароль';
        echo showErrorMessage($err);
    }else{
        $err[] = 'Неверный логин или пароль';
        echo showErrorMessage($err);
    }
}
if(isset($_GET['reg'])){
    echo "<h2>Данные сохранены, ждите активации вашего аккаунта</h2>";
}