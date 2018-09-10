
<?php echo $this->Metronic->portlet('Edytuj użytkownika'); ?>
<div class="clearfix">
    <?php if ($this->Form->value('User.date_locked')) {
        ?>
        <?php echo $this->Permissions->postLink(__d('cms', 'Odblokuj %s', 'użytkownika'), array('action' => 'unlock', $this->Form->value('User.id')), array('class' => 'btn btn-sm red btn-sm margin-bottom pull-right poitnier'), __d('cms', 'Jesteś pewien, że chcesz odblokować użytkownika "%s"?', $this->Form->value('User.name'), 0)); ?>
    <?php } ?>        
    <?php echo $this->Permissions->postLink(__d('cms', 'Usuń %s', 'użytkownika'), array('action' => 'delete', $this->Form->value('User.id')), array('class' => 'btn btn-sm red btn-sm margin-bottom pull-right poitnier')); ?>
    <?php echo $this->Permissions->link(__d('cms', 'Lista %s', 'użytkowników'), array('action' => 'index'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>

</div>
<div class="portlet-body">
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <?php echo $this->Form->create('User'); ?>
            <h2><?php echo __d('cms', 'Edytuj %s', 'użytkownika'); ?></h2>
            <?php
            echo $this->Form->input('id');
            echo $this->Metronic->input('active', array('label' => __d('cms', 'Aktywne')));
            echo $this->Metronic->input('name', array('label' => __d('cms', 'Nazwa')));
            echo $this->Metronic->input('email');
            if (!$cantEditGroup) {
                echo $this->Metronic->input('Group', array('label' => __d('cms', 'Grupa')));
            }
            echo $this->Form->input('Section', array('label' => __d('cms', 'Dział'), 'multiple' => 'checkbox'));
            ?>
            <div class="pull-right">
                <?php
                echo $this->Form->submit('Zapisz', array('class' => 'btn blue-madison pull-right'));
                echo $this->Form->end();
                ?>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">

        </div>
        <div class="col-md-6 col-xs-12">
            <?php echo $this->Form->create('User', array('type' => 'file')); ?>
            <h2>Edycja Avatar-a</h2>
            <?php echo $this->Metronic->input('avatar', array('type' => 'file', 'label' => false)); ?>
            <?php
            //crop image
            echo $this->Jcrop->init();
            $imageOptions = array('width' => 100, 'height' => 100, 'x' => $user['User']['x'], 'y' => $user['User']['y']);
            echo $this->Image->thumb('/files/user/' . $user['User']['avatar'], $imageOptions, array('onclick' => "editCrop('User', 'avatar', '" . $user['User']['id'] . "');", 'default' => false), true);
            ?>
            <div class="pull-right">
                <?php
                echo $this->Form->submit('Zapisz', array('class' => 'btn blue-madison pull-right'));
                echo $this->Form->end();
                ?>

            </div>
            <?php echo $this->Form->create('User'); ?>
            <h2><?php echo __d('cms', 'Zmień hasło'); ?></h2>
            <?php
            echo $this->Form->input('id');
            echo $this->Metronic->input('pass', array('label' => __d('cms', 'Hasło'), 'type' => 'password', 'value' => ''));
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



