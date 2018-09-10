<fieldset>
    <legend><?php echo __d('cms', 'Media Product Data'); ?></legend>
    <?php
		echo $this->Form->input('name', array('label' => __d('cms', 'Name')));
		echo $this->Form->input('amout', array('label' => __d('cms', 'Amout')));
		echo $this->Form->input('disc', array('label' => __d('cms', 'Disc')));
		echo $this->Form->input('disc_overprint', array('label' => __d('cms', 'Disc Overprint')));
		echo $this->Form->input('package_type', array('label' => __d('cms', 'Package Type')));
		echo $this->Form->input('package', array('label' => __d('cms', 'Package')));
		echo $this->Form->input('package_overprint', array('label' => __d('cms', 'Package Overprint')));
		echo $this->Form->input('typography', array('label' => __d('cms', 'Typography')));
		echo $this->Form->input('overprint_type', array('label' => __d('cms', 'Overprint Type')));
		echo $this->Form->input('format', array('label' => __d('cms', 'Format')));
		echo $this->Form->input('confection', array('label' => __d('cms', 'Confection')));
	?>
</fieldset>
