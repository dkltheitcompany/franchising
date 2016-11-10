<?php
    $regex = include ROOT.'/application/config/registration_regex.php';
?>
<form action='' method='post'>
    <table>
    <tr>
        <td align='right'>Фамилия:</td>               <?php echo "<td align='right'><input name='userfname' type='text' pattern='{$regex['username']}' required value='{$_POST['userfname']}'></input></td>      <td align='right'>$report_fname</td>"; ?>
    </tr>
    <tr>
        <td align='right'>Имя:</td>                   <?php echo "<td align='right'><input name='usersname' type='text' pattern='{$regex['username']}' required value='{$_POST['usersname']}'></input></td>      <td align='right'>$report_sname</td>"; ?>
    </tr>
    <tr>
        <td align='right'>Отчество:</td>              <?php echo "<td align='right'><input name='usertname' type='text' pattern='{$regex['username']}' required value='{$_POST['usertname']}'></input></td>      <td align='right'>$report_tname</td>"; ?>
    </tr>
    <tr>
        <td align='right'>E-mail:</td>                <?php echo "<td align='right'><input name='usermail' type='text' pattern='{$regex['usermail']}' required value='{$_POST['usermail']}'></input></td>        <td align='right'>$report_mail</td>"; ?>
    </tr>
    <tr>
        <td align='right'>Тел.:</td>                  <?php echo "<td align='right'>+<input name='userpnum' type='tel' pattern='{$regex['userpnum']}' required value='{$_POST['userpnum']}'></input></td>        <td align='right'>$report_pnum</td>"; ?>
    </tr>
    <tr>
        <td align='right'>Пароль:</td>                <?php echo "<td align='right'><input name='userpassword' type='password' pattern='{$regex['userpassword']}' required value=''></input></td>                <td align='right'>$report_password</td>"; ?>
    </tr>
    <tr>
        <td align='right'>Повторите пароль:</td>      <?php echo "<td align='right'><input name='repeatpassword' type='password' pattern='{$regex['userpassword']}' required value=''></input></td>"; ?>
    </tr>
    <tr>
        <td colspan='2' align='right'><input name='submit_reg' type='submit'></input></td>
    </tr>
    </table>
    <a href='/registration/confirm'>Ввести код.</a>
</form>