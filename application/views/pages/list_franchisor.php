<table width="500">
    <?php foreach ($franchisors as $franch): ?>
        <tr align=\"center\">
            <?php foreach ($franch as $td): ?>
                <?php if ($td == $franch['userid']) continue; ?>
                <td><?php echo "<a href='/project/{$franch['userid']}'>$td</a></td>"; ?>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>