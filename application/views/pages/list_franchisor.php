<table width="500">
    <tr>
        <td>Фамилия</td>
        <td>Имя</td>
        <td>Телефон</td>
        <td>Город</td>
        <td>ID</td>
    </tr>
    <?php foreach ($franchisors as $franch): ?>
        <tr align=\"center\">
            <?php foreach ($franch as $td): ?>
                <?php if ($td == $franch['userid']) 
                {
                   echo "<td><a href='/project/{$franch['userid']}'>$td</a></td>";
                    continue;
                }?>
            <td><?php echo $td;?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>