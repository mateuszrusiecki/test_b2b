<fieldset>
    <legend><?php echo $desc; ?></legend>
    <?php
		echo $this->Form->input('name', array('label' => __d('cms', 'Name')));
		echo $this->FebForm->file('img', array('type' => 'file', 'label' => __d('cms', 'Img')));
		echo $this->Form->input('shipment_price', array('label' => __d('cms', 'Shipment Price')));
		echo $this->Form->input('cash_on_delivery_price', array('label' => __d('cms', 'Cash On Delivery Price')));
		echo $this->Form->input('tax_rate', array('label' => __d('cms', 'Tax Rate')));
		echo $this->Form->input('track_link', array('label' => __d('cms', 'Track Link')));
		echo $this->Form->input('deleted', array('label' => __d('cms', 'Deleted')));
	?>
</fieldset>
