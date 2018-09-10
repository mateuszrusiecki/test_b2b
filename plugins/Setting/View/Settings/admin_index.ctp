<div class="settings index">
    <h2><?php echo $title_for_layout; ?></h2>
    <table cellpadding="0" cellspacing="0">
        <?php
        $tableHeaders = $this->Html->tableHeaders(array(
            $this->Paginator->sort('id'),
            $this->Paginator->sort('key', __('Klucz')),
            $this->Paginator->sort('value', __('Wartość')),
            $this->Paginator->sort('editable', __('Możliwość edycji')),
            __('Actions'),
                ));
        echo $tableHeaders;

        $rows = array();
        foreach ($settings AS $setting) {
            $actions = ' ' . $this->Html->link(__('Edit'), array('controller' => 'settings', 'action' => 'edit', $setting['Setting']['id']), array('class' => 'button'));
            $actions .= ' ' . $this->Html->link(__('Delete'), array(
                        'controller' => 'settings',
                        'action' => 'delete',
                        $setting['Setting']['id'],
                            ), array('class' => 'button'), __('Are you sure?'));

            $actions .= ' ' . $this->Html->link(__('▼'), array('controller' => 'settings', 'action' => 'movedown', $setting['Setting']['id']), array('class' => 'button'));
            $actions .= $this->Html->link(__('▲'), array('controller' => 'settings', 'action' => 'moveup', $setting['Setting']['id']), array('class' => 'button'));
            $key = $setting['Setting']['key'];
            $keyE = explode('.', $key);
            $keyPrefix = $keyE['0'];
            if (isset($keyE['1'])) {
                $keyTitle = '.' . $keyE['1'];
            } else {
                $keyTitle = '';
            }

            $rows[] = array(
                $setting['Setting']['id'],
                $this->Html->link($keyPrefix, array('controller' => 'settings', 'action' => 'index', 'p' => $keyPrefix)) . $keyTitle,
                $this->Text->truncate($setting['Setting']['value'], 20),
                $setting['Setting']['editable'],
                $actions,
            );
        }

        echo $this->Html->tableCells($rows);
        echo $tableHeaders;
        ?>
    </table>
</div>


<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Dodaj ustawienie'), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('Import/Export'), array('action' => 'import')); ?></li>
    </ul>
</div>


<?php echo $this->element('cms/paginator'); ?>