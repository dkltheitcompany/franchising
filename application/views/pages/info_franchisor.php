<table>
    <tr>
        <td>Этап</td><td><?php echo $project['stage']; ?></td>
    </tr>
    <tr>
        <td>Последнее обновление</td><td><?php echo $project['lastupdate']; ?></td>
    </tr>
</table>
Задания:
<form action="" method="post">
    <?php TaskPool::get_form_franch(); ?>
    <input type="submit" name="submit" value="Подтвердить">
</form>