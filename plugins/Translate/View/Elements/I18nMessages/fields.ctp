<fieldset>
    <legend><?php echo __d('cms', 'I18n Message Data'); ?></legend>
    <?php
		echo $this->Form->input('msgid', array('label' => __d('cms', 'Msgid')));
		echo $this->Form->input('msgstr', array('label' => __d('cms', 'Msgstr')));
		echo $this->Form->input('user_id', array('label' => __d('cms', 'User Id')));
		echo $this->Form->input('domain', array('label' => __d('cms', 'Domain')));
		echo $this->Form->input('lang', array('label' => __d('cms', 'Lang')));
	?>
</fieldset>
