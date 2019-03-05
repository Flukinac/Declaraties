<div class="index" style="width: 99%;">
    <div class="row" style="padding-bottom: 20px;">
        <div class="col-sm-4">
            <?php echo $this->Form->create('UserMonthbooking', array('url' => 'edit/' . $userMonthbookingId)); ?>
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
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header" style="background-color: silver;text-align: center;">
                    <strong>Houd rekening met de volgende punten bij het invullen van uren:</strong>
                </div>
                <div class="card-body" style="background-color: lightskyblue;">
                    <ul>
                        <li>Er kunnen maximaal 16 uren per dag worden geboekt.</li>
                        <li>Als er overige uren worden geboekt moet er een verklaring worden afgegeven voor iedere dag waar deze uren geboekt zijn.</li>
                        <li>Invoeren van minuten moet op deze manier: 8:30 waarbij de twee cijfers na de dubbele punt daadwerkelijke minuten voorstellen.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
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
                echo "<tr>" . "<td><strong>Opdracht </strong>" . $contract['Contracts']['name'] . "</td>";
                for ($i = 0; $i < count($daysColor);) {
                    echo '<td>' . $this->Form->input('contract_' . ++$i . '_' . $contract['Contracts']['contract_id'], array('label' => '', 'maxlength' => '5', 'class' => 'testy', $checked,  'style' => 'text-align:center; width:35px; background: ' . $daysColor[$i])) . '</td>';
                }
                echo "</tr>";
            }
        }
        //uitrollen van interne uren
        foreach ($bookingTypes as $bookingType) {
            echo "<tr>" . "<td><strong>Intern </strong>" . $bookingType['InternHoursTypes']['description'] . "</td>";
            for ($a = 0; $a < count($daysColor);) {
                $a++;
                $idOverig = ($bookingType['InternHoursTypes']['description'] == 'overig' ? $a : null);      //set deze ids wanneer bookingtype overig is zodat de overige uren die ingevult worden ook beargumenteerd moeten worden in de view
                echo '<td>' . $this->Form->input('intern_' . $a . '_' . $bookingType['InternHoursTypes']['intern_hour_type_id'], array('label' => '', 'id' => $idOverig, 'maxlength' => '5', 'class' => 'testy', 'style' => 'text-align:center; width: 35px; background: ' . $daysColor[$a])) . '</td>';
            }
            echo "</tr>";
        }
        echo '</tr></table>'
        ?>
    </fieldset><br>
    <div class="row" style="padding-bottom: 20px;">
        <div class="col-sm-4">
            <div class="card">
                <?php if ($bookingInfo['status'] == '0') {
                    echo '<button type="submit" class="rad-button dark gradient">Opslaan</button>' . '<br>';
                }
                echo $this->Html->link(__('toon print versie'), array('action' => 'view_pdf', $userMonthbookingId), array('class' => 'rad-button dark gradient'));
                ?>
            </div>
        </div>
        <div class="col-sm-8">

            <div class="card">
                <div class="card-header" style="background-color: silver;text-align: center;">
                    <strong>Verklaring van overige uren:</strong>
                </div>
                <div class="card-body"  style="background-color: lightskyblue;">
                    <strong id="noComment">Geen overige uren ingevuld.</strong>
                    <?php for ($i = 0; $i < count($daysColor);) {
                        echo '<div id=comment' . ++$i . ' hidden>' . $this->Form->input('comment_' . $i, array('label' => 'Verklaring van overige uren op dag ' . $i . ':')) . '</div>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!--'onchange' => 'addRosterHours(this.value)', toegevoegd aan de inputs maar geen idee meer waarvoor. is ook undefined -->