<?php

$regex = include ROOT.'/application/config/registration_regex.php';

return "
<form action=\"\" method=\"post\">
    <table>
   <tr>
        <td align=\"right\">E-mail:</td>                <td align=\"right\"><input name=\"usermail\" type=\"text\" pattern=\"{$regex['usermail']}\" required value=\"{$_POST['usermail']}\"></input></td>        <td align=\"right\">$report_mail</td>
    </tr>
    
    <tr>
        <td colspan=\"2\" align=\"right\"><input name=\"submit_apply_reset\" type=\"submit\"></input></td>
    </tr>
    </table>
</form>
";