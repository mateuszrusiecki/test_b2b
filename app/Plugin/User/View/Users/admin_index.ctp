<?php echo $this->Metronic->portlet('Użytkownicy'); ?>
<div class="clearfix">
    
    <?php if ($this->Session->read('Auth.User._referer_id')): ?>
        <?php echo $this->Html->link(__d('public', 'Powrót do konta'), array('plugin' => 'user', 'admin' => 'admin', 'controller' => 'users', 'action' => 'back_login'), array('class' => 'btn btn-sm purple btn-sm margin-bottom pull-left poitnier')); ?>
    <?php endif; ?>
    
    <?php echo $this->Permissions->link(__d('cms', 'Dodaj %s', 'użytkownika'), array('action' => 'admin_add'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
<div class="filterPhp">
    <?php echo $this->Filter->formCreate($filtersSettings, array('legend' => 'Filtruj', 'submit' => 'filtruj')); ?>
    <?php $this->Paginator->options(array('url' => $filtersParams)); ?>
</div>
<?php echo $this->element('Users/table_index'); ?>
<?php echo $this->element('cms/paginator'); ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>
