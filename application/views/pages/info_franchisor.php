<table>
    <tr>
        <td>Этап</td><td><?php echo $project['stage']; ?></td>
    </tr>
    <tr>
        <td>Последнее обновление</td><td><?php echo $project['lastupdate']; ?></td>
    </tr>
</table>
Мои задания:
<form action="" enctype="multipart/form-data" method="post">
    <?php TaskPool::get_form_franch(); ?>
</form>