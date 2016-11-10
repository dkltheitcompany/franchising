<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <?php
            eval('?>'.$view_header);
        ?>
    </head>
    <body>
        <a href="/">На главную</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php if (isset($_SESSION['userid'])): ?>
            <a href="/user"><?php echo $_SESSION['userfname'].' '.$_SESSION['usersname']; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="/exit">Выйти</a><br><br>
        <?php else: ?>
            <a href="/authorization">Войти</a><br><br>
        <?php endif; ?>
        <?php
            eval('?>'.$view_body);
        ?>
    </body>
</html>