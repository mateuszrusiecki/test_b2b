<?php $this->Html->addCrumb(__d('public', 'Lista'), array('action'=>'index',$clientDomain['ClientDomain']['client_id'])); ?>
<?php echo $this->Metronic->portlet($title); ?>
<div class="clientDomains view">
    <dl>
        <dt><?php echo __('public','Domain'); ?></dt>
        <dd>
            <?php echo h($clientDomain['ClientDomain']['domain']); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('public','Edit Client Domain'), array('action' => 'edit', $clientDomain['ClientDomain']['id'],$project_id)); ?> </li>
        <li><?php echo $this->Form->postLink(__('public','Delete Client Domain'), array('action' => 'delete', $clientDomain['ClientDomain']['id']), null, __('Are you sure you want to delete # %s?', $clientDomain['ClientDomain']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('public','New Client Domain'), array('action' => 'add',$project_id)); ?> </li>
    </ul>
</div>
<?php echo $this->Metronic->portletEnd(); ?>
