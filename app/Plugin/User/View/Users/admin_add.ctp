<?php echo $this->Metronic->portlet('Dodaj użytkownika'); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'Lista %s', 'użytkowników'), array('action' => 'admin_index'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
<div class="portlet-body">
    <?php echo $this->Form->create('User'); ?>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <?php
            echo $this->Metronic->input('active', array('label' => __d('cms', 'Aktywne')));
            echo $this->Metronic->input('Profile.firstname', array('label' => __d('cms', 'Imię')));
            echo $this->Metronic->input('Profile.surname', array('label' => __d('cms', 'Nazwisko')));
            echo $this->Metronic->input('email', array('label' => __d('cms', 'E-mail')));
            echo $this->Metronic->input('pass', array('label' => __d('cms', 'Hasło'), 'type' => 'password'));
            echo $this->Metronic->input('Group', array('label' => __d('cms', 'Grupa uprawnień')));
            ?>
        </div>
        <div class="col-md-6 col-xs-12">
            <?php
            echo $this->Form->input('Section', array('label' => __d('cms', 'Dział'), 'multiple' => 'checkbox', 'separator' => '<br />'));
            ?>
            <div class="pull-right">
                <?php
                echo $this->Form->submit('Zapisz', array('class' => 'btn blue-madison pull-right'));
                echo $this->Form->end();
                ?>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Metronic->portletEnd(); ?>