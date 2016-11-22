<table width="500">
    <?php foreach ($pms as $pm): ?>
        <tr align=\"center\">
            <?php foreach ($pm as $td): ?>
                <?php if ($td == $pm['userid']) continue; ?>
                <td><?php echo "$td"; ?></td>
            <?php endforeach; ?>
                <td><form action="" method="post"><input type="submit" name="choose" value="Назначить">
                        <?php echo "<input type='hidden' name='userid' value='{$pm['userid']}'>"; ?>
                    </form></td>
        </tr>
    <?php endforeach; ?>
</table>