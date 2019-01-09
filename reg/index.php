<?php
define('KEY', true);
require('../config/config.php');
require('../config/functions.php');
require('reg.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
<form class="form" action="" method="post">

    <table>
        <tr>
            <td><label>Имя</label></td>
            <td><input type="text" name="name" placeholder="Ваше имя" maxlength="50"></td>
        </tr>

        <tr>
            <td><label>Фамилия</label></td>
            <td><input type="text" name="last_name" placeholder="Ваша фамилия" maxlength="50"></td>
        </tr>

        <tr>
            <td><label>email</label></td>
            <td><input type="email" name="email" placeholder=" Ваш email" maxlength="50"></td>
        </tr>

        <tr>
            <td><label>Пароль</label></td>
            <td><input type="password" name="password" placeholder="Придумайте пароль" maxlength="32"></td>
        </tr>

        <tr>
            <td><label>Повторите пароль</label></td>
            <td><input type="password" name="confirm_password" placeholder="Подтвердите пароль" maxlength="32"></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center">
                <input class="button" type="submit" name="submit_reg" value="зарегистрироваться">
            </td>
        </tr>

    </table>
</form>

</body>
</html>