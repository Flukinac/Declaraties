<div class="index">
    <?php echo $this->Form->create('Monthbooking'); ?>
    <legend><?php echo __('Dien uw uren in ') . '(' . $month . ' ' . date("Y") . ')'; ?></legend>
    <fieldset>
        <?php
            echo '<table>';
            if (count($contracts) > 0) {
                foreach ($contracts as $contract) {
                    echo "<tr>"."<td>".$contract['Company']['name']."</td>";

                    foreach ($days as $key => $day) {
                        $color = 'yellow';
                        if ($day == 'weekend') {
                            $color = 'lightblue';
                        } elseif ($day == '') {
                            $color = 'white';
                        }
                        echo '<td>' . $this->Form->input('contract' . '_' . $key . '_' . $contract['Contracts']['contract_id'], array('label' => 'Dag&nbsp' . $key, 'style' => 'width: 30px; background: ' . $color)) . '</td>';
                    }
                    echo "</tr>";
                }
            } else {
                echo __('Geen contracten gevonden');
            }                                                               //@TODO foreach van $days en kleur selectie wordt nu 2x uitgevoerd. samenvoegen en de rest ombouwen zodat de uitkomst niet veranderd
            echo '</tr></table>'; ?>
            <hr>
            <?php echo '<table>';
            foreach ($bookingTypes as $bookingType) {
                echo "<tr>"."<td>".$bookingType['InternHoursTypes']['description']."</td>";

                foreach ($days as $key => $day) {
                    $color = 'yellow';
                    if ($day == 'weekend') {
                        $color = 'lightblue';
                    } elseif ($day == '') {
                        $color = 'white';
                    }
                    echo '<td>' . $this->Form->input('intern' . '_' . $key . '_' . $bookingType['InternHoursTypes']['intern_hour_type_id'], array('label' => 'Dag&nbsp' . $key, 'style' => 'width: 30px; background: ' . $color)) . '</td>';
                }
                echo "</tr>";
            }
            echo '</tr></table>'
        ?>
    </fieldset>
    <?php echo $this->Form->input('userMonthbookingId', array('type' => 'hidden', 'value' => $userMonthbookingId)); ?>
    <?php echo $this->Form->end('Opslaan'); ?>
</div>