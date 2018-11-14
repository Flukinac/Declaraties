<div class="users view">
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
	<?php if (!empty($contractBookings) || !empty($internBookings)): ?>
        <h3><?php echo __('Contract boekingen'); ?></h3>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __($date['month']['month'] . ' ' . $date['year']['year']); ?></th>
                <?php if (isset($contractBookings)): ?>
                    <?php foreach($contractBookings as $booking): ?>
                        <th><?php echo __('Contract ' . $contractNames[$booking[0]['contract_id']]); ?></th>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if (isset($internBookings)): ?>
                    <?php foreach($internBookings as $booking): ?>
                        <th><?php echo __('Intern ' . $types[$booking[0]['intern_hour_type_id']]); ?></th>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tr>
            <?php foreach ($days as $key => $value): ?>
                <tr>
                    <td><?php echo $key . ' ' . $value; ?></td>
                    <?php if (isset($contractBookings)): ?>
                        <?php $counterHour = 0; ?>
                        <?php foreach ($contractBookings as $booking): ?>
                            <?php if ($key == $booking[$counterHour]['day']): ?>
                                <td><?php echo $booking[$counterHour]['hours']; ?></td>
                                <?php $counterHour++; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (isset($internBookings)): ?>
                        <?php $counterIntern = 0; ?>
                        <?php foreach ($internBookings as $booking): ?>
                            <?php if ($key == $booking[$counterIntern]['day']): ?>
                                <td><?php echo $booking[$counterIntern]['hours']; ?></td>
                                <?php $counterIntern++; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tr>

            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <h3><?php echo __('Geen geboekte uren gevonden'); ?></h3>
    <?php endif; ?>
</div>