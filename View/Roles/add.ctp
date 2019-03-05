<div class="index">
    <?php echo $this->Form->create('AbilitiesRoles'); ?>
    <legend><?php echo __('Voeg rol toe'); ?></legend>
    <fieldset style="padding-top: 2rem;">
        <div class="row" style="padding-bottom: 20px;">
            <div class="col-sm-4">
                <div class="card" style="width: 25rem;">
                    <div class="card-body">
                        <h5 class="card-title" style=" ">Rol naam</h5>
                        <p class="card-text"><?php echo $this->Form->input('roleName', array('label' => '', 'class' => 'formText', 'required' => 'true'));?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card" style="width: 25rem;">
                    <div class="card-body">
                        <h5 class="card-title" style=" ">Rol authorisaties</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Vink aan waar de rol toegang toe heeft</h6><br/>
                        <?php foreach ($abilities as $key => $ability):?>
                            <div class="form-control" style="padding: .5em;">
                                <p class="card-text"><?php echo $this->Form->checkbox($key, array('value' => $ability['Abilities']['id'], 'style' => 'float: none; width: 30px; height: 20px;'));
                                    echo $ability['Abilities']['ability'] ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <?php echo $this->Form->end('Opslaan', array('class' => 'rad-button dark gradient')); ?>
</div>

