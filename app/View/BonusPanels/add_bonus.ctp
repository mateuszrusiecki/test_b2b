<?php echo $this->Metronic->portlet(__d('public','Dodaj premię')); ?>

<div class="portlet-body">
    <div class="row">
        <?php echo $this->Form->create('bonus'); ?>
        <div class="col-md-6 col-xs-12">
            <?php
            echo $this->Metronic->input('worker', array('label' => 'Pracownik', 'options' => ''
            ));
            ?>
            <?php
            echo $this->Metronic->input('prices', array('label' => __d('cms', 'Wysokość premii')));
            ?>
        </div>
        <div class="col-md-6 col-xs-12">
            <?php
            echo $this->Metronic->input('project', array('label' => __d('cms', 'Projekt'), 'options' => ''
            ));
            ?>
            <?php
            echo $this->Metronic->input('comment', array('label' => __d('cms', 'Uwagi')));
            ?>
        </div>
    </div>
    <?php
    echo $this->Form->submit('Zapisz', array('class' => 'btn blue-madison pull-right'));
    echo $this->Form->end();
    ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>
