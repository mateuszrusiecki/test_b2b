<fieldset>
    <legend><?php echo __d('cms', 'Code Error Data'); ?></legend>
    <?php
		echo $this->Form->input('user_id', array('label' => __d('cms', 'User Id')));
		echo $this->Form->input('name', array('label' => __d('cms', 'Name')));
		echo $this->Form->input('message', array('label' => __d('cms', 'Message')));
		echo $this->Form->input('url', array('label' => __d('cms', 'Url')));
		echo $this->Form->input('line', array('label' => __d('cms', 'Line')));
	?>
</fieldset>
