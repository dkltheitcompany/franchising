<?php
    $regex = include ROOT.'/application/config/registration_regex.php';
?>
<form action='' method='post'>
   <table>
    <tr>
        <td align='right'>Новый пароль:</td>      <?php echo "<td align='right'><input name='userpassword' type='password' pattern='{$regex['userpassword']}' required value=''></input></td>        <td align='right'>$report_password</td>"; ?>
    </tr>
    <tr>
        <td align='right'>Повторите пароль:</td>  <?php echo "<td align='right'><input name='repeatpassword' type='password' pattern='{$regex['userpassword']}' required value=''></input></td>"; ?>
    </tr>
    <tr>
        <td colspan='2' align='right'><input name='submit_reset' type='submit'></input></td>
    </tr>
    <?php echo "<input type='hidden' name='userid' value='$userid'></input>"; ?>
    </table>
</form>