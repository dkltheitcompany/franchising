<form action="" method="post">
    <table>
    <tr>
        <td align="right">Тел.:</td>                  <?php echo "<td align='right'>+<input name='userpnum' type='tel' value='{$_POST['userpnum']}'></input></td> <td align='right'>$report</td>" ?>
    </tr>
    <tr>
        <td align="right">Пароль:</td>                <td align="right"><input name="userpassword" type="password" value=""></input></td>
    </tr>
    <tr>
        <td colspan="2" align="right"><input name="submit_auth" type="submit"></input></td>
    </tr>
    </table>
</form>
<a href='/reset'>Забыли пароль?</a>
