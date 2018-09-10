<fieldset>
    <legend><?php echo __d('cms', 'Vacation Data'); ?></legend>
    <?php
		echo $this->Form->input('vacation_type_id', array('label' => __d('cms', 'Vacation Type Id')));
		echo $this->Form->input('date_start', array('label' => __d('cms', 'Date Start')));
		echo $this->Form->input('date_end', array('label' => __d('cms', 'Date End')));
		echo $this->Form->input('hour_start', array('label' => __d('cms', 'Hour Start')));
		echo $this->Form->input('hour_end', array('label' => __d('cms', 'Hour End')));
		echo $this->Form->input('vacation_status_id', array('label' => __d('cms', 'Vacation Status Id')));
	?>
</fieldset>
