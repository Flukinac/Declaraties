<div class="index">
<h2><?php echo __('Boekingen'); ?></h2>
	<dl>
		<dt><?php echo __('Gebruikersnaam'); ?></dt>
		<dd>
			<?php echo h($username); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Aangemaakt op'); ?></dt>
		<dd>
			<?php echo h($userMonthbooking['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gewijzigd op'); ?></dt>
		<dd>
			<?php echo h($userMonthbooking['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="users view">
	<?php if (isset($data[1])) { ?>
        <h3><?php echo __('Contract boekingen'); ?></h3>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __($date); ?></th>                                <!--aanmaak van tabel headers-->
                <?php foreach ($data[0] as $key => $value) { ?>
                    <th><?php echo __($key); ?></th>
                <?php }; ?>
            </tr>
            <?php for ($i = 1;$i < count($days); $i++) { ?>
                <tr>
                    <td><?php echo $i . ' ' . $days[$i]; ?></td>
                    <?php foreach ($data[$i] as $input): ?>
                        <?php echo "<td>" . (isset($input['hours']) ? $input['hours'] : $input) . "</td>"?>
                    <?php endforeach; ?>
                </tr>
            <?php }; ?>
        </table>
    <?php } else { ?>
        <h3><?php echo __('Geen geboekte uren gevonden'); ?></h3>
    <?php }; ?>
</div>