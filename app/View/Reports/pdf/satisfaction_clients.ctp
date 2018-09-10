<h2><?php echo __d('public', 'Zadowolonie klientów'); ?></h2>
<?php $named = $this->params->params['named']; ?>
<?php echo $this->element('Reports/date_header') ?>
<table cellpadding="0" cellspacing="0" class="table table-bordered">
    <thead>

        <tr>
            <th>
                <?php echo __d('public', 'Klient'); ?>
            </th>
            <th>
                <?php echo __d('public', 'Średnia'); ?>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($data as $d):
            ?>
            <tr >
                <td>
                    <?php echo $d['Client']['name']; ?>
                </td>
                <td>
                    <?php echo $d['average']; ?>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Html->css(Router::url('/css/bootstrap.css', true)); ?>