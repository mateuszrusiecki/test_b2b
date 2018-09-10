<fieldset>
    <legend><?php echo $desc; ?></legend>
    <?php
		echo $this->Form->input('shipment_method_id', array('label' => __d('cms', 'Shipment Method Id')));
		echo $this->Form->input('weight', array('label' => __d('cms', 'Weight')));
		echo $this->Form->input('price', array('label' => __d('cms', 'Price')));
		echo $this->Form->input('tax_rate', array('label' => __d('cms', 'Tax Rate')));
	?>
</fieldset>
