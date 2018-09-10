<div class="customers index">
    <div class="filtruj clearfix">
        <?php echo $this->Filter->formCreate($filtersSettings, array('legend'=>'Status zamówienia','submit'=>'szukaj')); ?>
        <?php $this->Paginator->options(array('url' => $filtersParams)); ?>
    </div>
    <?php echo $this->Element('Customers/table_index'); ?> 
    <?php echo $this->Element('cms/paginator'); ?></div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<?php echo $this->Permissions->link(__d('cms', 'New Customer'), array('action' => 'add'), array('outter'=>'<li>%s</li>')); ?>
        <?php //echo $this->Permissions->link(__d('cms', 'List Users'), array('plugin' => false, 'controller' => 'users', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New User'), array('plugin' => false, 'controller' => 'users', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
<?php //echo $this->Permissions->link(__d('cms', 'List Addresses'), array('plugin' => false, 'controller' => 'addresses', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Address'), array('plugin' => false, 'controller' => 'addresses', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
<?php //echo $this->Permissions->link(__d('cms', 'List Invoice Identities'), array('plugin' => false, 'controller' => 'invoice_identities', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Invoice Identity'), array('plugin' => false, 'controller' => 'invoice_identities', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
<?php //echo $this->Permissions->link(__d('cms', 'List Orders'), array('plugin' => false, 'controller' => 'orders', 'action' => 'index'), array('outter'=>'<li>%s</li>')); ?> 
		<?php //echo $this->Permissions->link(__d('cms', 'New Order'), array('plugin' => false, 'controller' => 'orders', 'action' => 'add'), array('outter'=>'<li>%s</li>')); ?> 
	</ul>
</div>
