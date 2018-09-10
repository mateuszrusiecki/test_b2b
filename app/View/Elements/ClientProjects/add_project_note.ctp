<!--Modal: Dodawanie notatek-->

<?php
echo $this->Form->create('ClientProjectNote', array(
    'url' => array(
        'controller' => 'client_projects',
        'action' => 'add_project_note'
    ), 'class' => 'form-horizontal'
));

?>

<div class="form-body">
    <div class="form-group">
        <div class="col-md-12">
            <?php
            echo $this->Form->input('content', array(
                'placeholder' => __d('public', 'Wpisz treść notatki'),
                'class' => 'form-control',
                'label' => false,
                'type' => 'textarea',
                'required' => 'required'
            ));
            ?>
        </div>
        <div  class="col-md-12 label-block mt10">

            <?php echo $this->Form->submit('Dodaj notatkę', array('class' => 'btn blue col-md-4 col-xs-6 pull-right', 'div' => false)); ?>
            <?php
            echo $this->Form->input('client_access', array(
                'label' => '<span aria-hidden="true" class="fa icon-star margin-top-10 ng-cloak" ng-class="class" ng-click="changeClass()" tooltip="'.__d('public', 'Gwiazdka żłóta - notatka staje się widoczna dla klienta').' &#13;'.__d('public', 'Gwiazdka czarna - notatka niewidoczna').'"> </span>',
                'div' => false,
                'type' => 'checkbox'
            ));
            echo $this->Form->input('project_id', array(
                'value' => $clientProject['ClientProject']['id'],
                'type' => 'hidden',
                'label' => false
            ));
            echo $this->Form->input('client_id', array(
                'value' => $clientProject['ClientProject']['client_id'],
                'type' => 'hidden',
                'label' => false
            ));
            ?>
        </div>

    </div>
</div>

<?php echo $this->Form->end(); ?>
        