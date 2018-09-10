<?php $tables = $this->requestAction(array('admin' => 'admin', 'plugin' => 'panel', 'controller' => 'panel', 'action' => 'ga_tableslist')); ?>
<?php if (!empty($tables)): ?>
    <h2><span><?php echo __d('cms', 'Wybierz tabelę do raportów (nie będzie możliwości zmiany wyboru)') ?></span></h2>
    <ul>
        <?php foreach ($tables AS $table): ?>
            <li><?php echo $this->Html->link($table['Account']['title'], array('admin' => 'admin', 'controller' => 'panel', 'action' => 'ga_tableslist', $table['Account']['tableId'])); ?></li>
        <?php endforeach; ?>
    </ul>    
<?php endif; ?>

