<table width="500">
    <?php foreach ($franchisors as $franch): ?>
        <tr align=\"center\">
            <?php foreach ($franch as $td): ?>
                <td><?php echo "<a href='/project/{$franch['userid']}'>$td</a></td>"; ?>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>