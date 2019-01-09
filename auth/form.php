<?php
if(!defined('KEY'))
{
    header("HTTP/1.1 404 Not Found");
    exit(file_get_contents('../404.html'));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>411 AdminPanel</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<form class="form" action="" method="post">
    <table>
        <tr>
            <td><label>Email</label></td>
            <td><input type="email" name="email" required placeholder="Ваш mail" maxlength="50" size="30"></td>
        </tr>

        <tr>
            <td><label>Пароль</label></td>
            <td><input type="password" name="password" required placeholder="Ваш пароль" maxlength="50" size="30"></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center"><input class="button" type="submit" name="login_btn" value="Войти"></td>
        </tr>
    </table>

</form>
</body>
</html>