<?php

class view_project {

    public static function make() {
        $view_body = 'Ваш id: ' . $_SESSION['userid'] . '<br>' . 'Ваш тип: ' . $_SESSION['usertype'];

        include ROOT . '/application/views/view_template.php';
    }
    
    public static function make_project_info($franch)
    {
         $view_body = '<table width="100%">'
                . '<tr align="center">'
                . '<td colspan="3">ФИО</td>'
                . '<td>E-mail</td>'
                . '<td>Тел.</td>'
                . '<td>Город</td>'
                . '<td>ID<td>'
                . '</tr>';
         
            $view_body .= "<tr align=\"center\">"
                    . "<td>{$franch['userfname']}</td>"
                    . "<td>{$franch['usersname']}</td>"
                    . "<td>{$franch['usertname']}</td>"
                    . "<td>{$franch['usermail']}</td>"
                    . "<td>{$franch['userpnum']}</td>"
                    . "<td>{$franch['cityid']}</td>"
                    . "<td><a href='/project/{$franch['userid']}'>{$franch['userid']}</a></td>"
                    . "</tr>";
                    
        $view_body .= '</table>';

        include ROOT . '/application/views/view_template.php'; 
    }

    public static function make_list_franch($franchisors) {
        $view_body = '<table width="100%">'
                . '<tr align="center">'
                . '<td colspan="3">ФИО</td>'
                . '<td>E-mail</td>'
                . '<td>Тел.</td>'
                . '<td>Город</td>'
                . '<td>ID</td>'
                . '</tr>';
        foreach ($franchisors as $franch) {
            $view_body .= "<tr align=\"center\">"
                    . "<td>{$franch['userfname']}</td>"
                    . "<td>{$franch['usersname']}</td>"
                    . "<td>{$franch['usertname']}</td>"
                    . "<td>{$franch['usermail']}</td>"
                    . "<td>{$franch['userpnum']}</td>"
                    . "<td>{$franch['cityid']}</td>"
                    . "<td><a href='/project/{$franch['userid']}'>{$franch['userid']}</a></td>"
                    . "</tr>";
        }
        $view_body .= '</table>';

        include ROOT . '/application/views/view_template.php';
    }

    public static function make_stage($info) {
        $view_body = "Этап: {$info['stage']}<br>Обновлён: {$info['lastupdate']}";
        if (!$info['applied'])
            $view_body .= "<br><form><input type='submit' name='submit_apply_stage'></form>";
        else
            $view_body .= 'Ваши действия обрабатываются';
    }

}
