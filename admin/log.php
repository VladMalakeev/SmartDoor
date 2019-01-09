<?php
if(!defined('KEY'))
{
    header("HTTP/1.1 404 Not Found");
    exit(file_get_contents('../404.html'));
}
include('php/handler.php');
$admin = getAdminData();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>AdminPanel</title>
    <link rel="stylesheet" type="text/css" href="admin/css/style.css">
</head>
<body>
<table>
    <caption>
        <div id="header">
            <div id="left">
                <h3><?php echo $admin['name'].' '.$admin['last_name'] ?></h3>
            </div>

            <div id="center">
                <a class="passive" href="?mode=users"">Пользователи</a>
                <a class="active">Лог</a>
            </div>

            <div id="right">
                <a id="exit" href="index.php?exit=true"><img  src="admin/img/exit.png" width="50" height="50"></a>
            </div>
        </div>
    </caption>
    <tr>
        <th>№</th>
        <th>Пользователь</th>
        <th>Группа</th>
        <th>Время</th>
        <th>Статус</th>
    </tr>
    <?php
    foreach (getLog() as $log){
        ?>
        <tr>
            <td><?php echo $log['id_log'] ?></td>
            <td><?php echo $log['name'].' '.$log['last_name'] ?></td>
            <td><?php echo $log['group_name'] ?></td>
            <td><?php echo gmdate("Y/m/d (H:i:s) ",$log['time']) ?></td>
            <td><?php echo $log['access'] == 1 ? 'Доступ открыт' : 'Без доступа' ?></td>
            <td></td>
        </tr>
        <?php
    }
    ?>

</table>
</body>
</html>