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
                    <a class="active">Пользователи</a>
                    <a class="passive" href="?mode=log">Лог</a>
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
            <th>MAC</th>
            <th>Телефон</th>
            <th>Доступ</th>
            <th>Удалить</th>
        </tr>
        <?php
        foreach (getUsers() as $user){
            $id = $user['id_users'];
        ?>
        <tr>
            <td><?php echo $id ?></td>
            <td><?php echo $user['name'].' '.$user['last_name'] ?></td>
            <td><?php echo $user['group_name'] ?></td>
            <td><?php echo $user['mac'] ?></td>
            <td><?php echo $user['phone'] ?></td>
            <td><?php
                if($user['access']== 1){
                    echo "<form method='post' action=''>
                                     <input type='hidden' value='$id' name='user_id'>
                                     <input class='button' type='submit' value='лишить доступа' name='not_access'>
                           </form>";
                }
                else{
                    echo "<form method='post' action=''>
                                     <input type='hidden' value='$id' name='user_id'>
                                     <input class='button' type='submit' value='открыть доступ' name='access'>
                          </form>";
                }?></td>
            <td>
                <form method='post' action=''>
                    <input type='hidden' value='<?php echo $id ?>' name='user_id'>
                    <input class='button' type='submit'  value='удалить пользователя' name='delete'>
                </form>
            </td>
        </tr>
        <?php
        }
        ?>

    </table>
</body>
</html>