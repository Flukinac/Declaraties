
<div class="index">
    <h2><?php echo __('Contract');?></h2>

    <?php if (!empty($contract)): ?>
            <br><br>
            <dl>
                <dt><?php echo __('Contractnaam'); ?></dt>
                <dd><?php echo $contract['Contracts']['name']; ?></dd>
                <dt><?php echo __('Gebruikersnaam'); ?></dt>
                <dd><?php echo $contract['User']['username']; ?></dd>
                <dt><?php echo __('Start datum'); ?></dt>
                <dd><?php echo $contract['Contracts']['start_date']; ?></dd>
                <dt><?php echo __('Eind datum'); ?></dt>
                <dd><?php echo $contract['Contracts']['end_date']; ?></dd>
                <dt><?php echo __('Bedrijfsnaam'); ?></dt>
                <dd><?php echo $contract['Company']['name']; ?></dd>
                <dt><?php echo __('Aangemaakt op'); ?></dt>
                <dd><?php echo $contract['Contracts']['created']; ?></dd>
                <dt><?php echo __('Gewijzigd op'); ?></dt>
                <dd><?php echo $contract['Contracts']['modified']; ?></dd>
            </dl>
    <?php endif; ?>
</div>
