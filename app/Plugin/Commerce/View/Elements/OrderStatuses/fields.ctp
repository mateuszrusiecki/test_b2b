<fieldset>
    <legend><?php echo $desc; ?></legend>
    <?php
		echo $this->Form->input('name', array('label' => __d('cms', 'Name')));
		echo $this->Form->input('deleted', array('label' => __d('cms', 'Deleted')));
	?>
</fieldset>
