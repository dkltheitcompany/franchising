<table width="500">
    <?php foreach ($franchisors as $franch): ?>
        <tr align=\"center\">
            <?php if (is_array($franch)): ?>
                <?php foreach ($franch as $td): ?>
                <?php if ($td == $franch['userid']) continue; ?>
                <td><?php echo "<a href='/project/{$franch['userid']}'>$td</a></td>"; ?>
            <?php endforeach; ?>
                    <?php endif; ?>
        </tr>
    <?php endforeach; ?>
</table>