<div class="index"><br><br>
    <h2><?php echo __('Bedrijf');?></h2>
    <dl>
        <dt><?php echo __('Naam'); ?></dt>
        <dd><?php echo h($company['Company']['postalcode']); ?></dd>
        <dt><?php echo __('Aangemaakt op'); ?></dt>
        <dd><?php echo h($company['Company']['created']); ?></dd>
        <dt><?php echo __('Gewijzigd op'); ?></dt>
        <dd><?php echo h($company['Company']['modified']); ?></dd>
        <dt><?php echo __('Huisnummer'); ?></dt>
        <dd><?php echo h($company['Company']['housenumber']); ?></dd>
        <dt><?php echo __('Huisnummer toevoeging'); ?></dt>
        <dd><?php echo h($company['Company']['housenumber_suffix']); ?></dd>
        <dt><?php echo __('Straat'); ?></dt>
        <dd><?php echo h($company['Company']['street']); ?></dd>
        <dt><?php echo __('Stad'); ?></dt>
        <dd><?php echo h($company['Company']['city']); ?></dd>
    </dl>
    <h3><?php echo __('Gerelateerde Contracten'); ?></h3>
    <?php if (!empty($company['Contract'])):
        foreach ($company['Contract'] as $contract) : ?>
            <br><br>
            <dl>
                <dt><?php echo __('Id'); ?></dt>
                <dd><?php echo $contract['contract_id']; ?></dd>
                <dt><?php echo __('Naam'); ?></dt>
                <dd><?php echo $contract['name']; ?></dd>
                <dt><?php echo __('Start datum'); ?></dt>
                <dd><?php echo $contract['start_date']; ?></dd>
                <dt><?php echo __('Eind datum'); ?></dt>
                <dd><?php echo $contract['end_date']; ?></dd>
                <dt><?php echo __('Aangemaakt op'); ?></dt>
                <dd><?php echo $contract['created']; ?></dd>
                <dt><?php echo __('Gewijzigd op'); ?></dt>
                <dd><?php echo $contract['modified']; ?></dd>
            </dl>
        <?php endforeach;
    endif;
    ?>
</div>
