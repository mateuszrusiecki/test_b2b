<div class="portlet-body">
    <?php echo $this->Form->create('Section'); ?>
    <div class="row">
        <div class="col-md-6 col-xs-12">
    <?php echo $this->Form->create('Cron'); ?>
	<?php echo $this->Form->input('id'); ?>
	<?php echo $this->Element('Crons/fields'); ?>
        </div>
        <div class="col-xs-12">
            <div class="pull-right">
                <?php
                echo $this->Form->submit('Dodaj', array('class' => 'btn blue-madison pull-right'));
                ?>
            </div>
        </div>
    </div>
    <?php
    echo $this->Form->end();
    ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>