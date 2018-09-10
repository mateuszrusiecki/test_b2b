<h2><?php echo __d('public', 'Raport zyskowności kontrahentów'); ?></h2>
<?php echo $this->element('Reports/date_header') ?>
<table cellpadding="0" cellspacing="0" class="table table-bordered">
    <thead>

        <tr>
            <th>
                <?php echo __d('public', 'Klient'); ?>
            </th>
            <th>
                <?php echo __d('public', 'Budżet'); ?>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sumProfit = 0;
        foreach ($data as $d):
            ?>
            <tr >
                <td>
                    <?php echo $d['Client']['name']; ?>
                </td>
                <td>
                    <?php
                    $sumProfit += $d['budget'];
                    echo $d['budget'];
                    ?>
                </td>

            </tr>
        <?php endforeach; ?>
        <tr >
            <td>
                <b class="pull-right"><?php echo __d('public', 'Suma:') ?></b>
            </td>
            <td>
                <?php echo $sumProfit; ?>
            </td>

        </tr>
    </tbody>
</table>
<?php echo $this->Html->css(Router::url('/css/bootstrap.css', true)); ?>