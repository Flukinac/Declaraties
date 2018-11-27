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
        <?php echo $this->Form->create('Monthbooking'); ?>
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
                        <?php if (isset($input['hours'])) { ?>  <!--hieronder wordt een tag gemaakt die op de volgende regel in de form wordt toegepast om later het type booking en ids te kunnen achterhalen -->
                            <?php $store = (isset($input['contract_id']) ? 'contract_' . $input['contract_id'] : 'intern_' . $input['intern_hour_type_id']) . '_' . $input['day']; ?>   <!--afhankelijk of er een contract id of een intern id inzit wordt deze toegevoegd-->
                            <?php $store .= (isset($input['contract_hour_id']) ? '_' . $input['contract_hour_id'] : '_' . $input['intern_hour_id']); ?>                                 <!-- zelfde als bovenstaande regel maar dan voor het unieke id-->
                            <?php echo '<td>' . $this->Form->input($store, array('value' => $input['hours'], 'label' => '', 'style' => 'width: 30px; height: 20px;')) . '</td>'; ?>
                        <?php } else { ?>
                            <?php echo "<td></td>"; ?>
                        <?php }; ?>
                    <?php endforeach; ?>
                </tr>
            <?php }; ?>
        </table>
        <?php echo $this->Form->end('Opslaan. Weet u het zeker? Ja'); ?>
    <?php } else { ?>
        <h3><?php echo __('Geen geboekte uren gevonden'); ?></h3>
    <?php }; ?>
</div>

