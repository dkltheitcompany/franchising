<table>
    <tr>
        <td>ФИО</td><td><?php echo $project['userfname'].' '.$project['usersname'].' '.$project['usertname']; ?></td>
    </tr>
    <tr>
        <td>Город</td><td><?php echo $project['cityid']; ?></td>
    </tr>
    <tr>
        <td>Тел.</td><td><?php echo $project['userpnum']; ?></td>
    </tr>
    <tr>
        <td>E-mail</td><td><?php echo $project['usermail']; ?></td>
    </tr>
    <tr>
        <td>Последнее обновление</td><td><?php echo $project['lastupdate']; ?></td>
    </tr>
</table>