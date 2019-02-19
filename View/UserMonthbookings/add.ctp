<div class="index" style="width: 99%;">
    <?php echo $this->Form->create('UserMonthbooking', array('url' => 'addHours/' . $userMonthbookingId)); ?>
    <legend><?php echo __('Dien uw uren in ') . '(' . $month . ' ' . $year . ')'; ?></legend>
    <p>
        <dl>
            <dt><?php echo __('Aangemaakt op'); ?></dt>
            <dd>
                <?php echo h($bookingInfo['created']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Gewijzigd op'); ?></dt>
            <dd>
                <?php echo h($bookingInfo['modified']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Status'); ?></dt>
            <dd>
                <?php if ($bookingInfo['status'] == '0') {
                    echo 'Nog niet gekeurd.';
                    $checked = '';
                } else {
                    echo 'Goedgekeurd.';
                    $checked = 'readonly';
                };
                ?>
            </dd>
        </dl>
    </p>
    <fieldset>
        <?php
        echo '<table><thead><tr>';
        echo '<th><h4>Dagen:</h4></th>';
        for ($i = 0; $i < count($daysColor);) {
            echo '<th>' . ++$i . '</th>';
        }
        echo '</tr></thead>';
        //uitrollen van contracturen
        if (count($contracts) > 0) {
            foreach ($contracts as $contract) {
                echo "<tr>" . "<td><strong>Bedrijf </strong>" . $contract['Company']['name'] . "</td>";
                for ($i = 0; $i < count($daysColor);) {
                    echo '<td>' . $this->Form->input('contract' . '_' . ++$i . '_' . $contract['Contracts']['contract_id'], array('label' => '', 'onchange' => 'addRosterHours(this.value)', 'class' => 'testy', $checked,  'style' => 'text-align:center; width: 25px; background: ' . $daysColor[$i])) . '</td>';
                }
                echo "</tr>";
            }
        } else {
            $this->Flash->error(__('Geen contracten gevonden'));
        }
        //uitrollen van interne uren
        foreach ($bookingTypes as $bookingType) {
            echo "<tr>" . "<td><strong>Intern </strong>" . $bookingType['InternHoursTypes']['description'] . "</td>";
            for ($a = 0; $a < count($daysColor);) {
                echo '<td>' . $this->Form->input('intern' . '_' . ++$a . '_' . $bookingType['InternHoursTypes']['intern_hour_type_id'], array('label' => '', 'onchange' => 'addRosterHours(this.value)', 'class' => 'testy', 'style' => 'text-align:center; width: 25px; background: ' . $daysColor[$a])) . '</td>';
            }
            echo "</tr>";
        }
        echo '</tr></table>'
        ?>
    </fieldset>
    <?php if ($bookingInfo['status'] == '0') {
        echo $this->Form->end('Opslaan', array('class' => 'rad-button dark gradient'));
    }
        echo $this->Html->link(__('toon print versie'), array('action' => 'view_pdf', $userMonthbookingId), array('class' => 'rad-button dark gradient'));
    ?>
</div>