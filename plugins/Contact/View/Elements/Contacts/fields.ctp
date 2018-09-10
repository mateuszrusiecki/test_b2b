<fieldset>
    <legend><?php echo __d('cms', 'Contact Data'); ?></legend>
    <?php
		echo $this->Form->input('email', array('label' => __d('cms', 'Email')));
		echo $this->Form->input('name', array('label' => __d('cms', 'Name')));
		echo $this->Form->input('show', array('label' => __d('cms', 'Show')));
	?>
</fieldset>
