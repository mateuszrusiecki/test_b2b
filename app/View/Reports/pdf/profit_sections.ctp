<h2><?php echo __d('public', 'Raport zyskowności działu'); ?></h2>
<?php echo $this->element('Reports/date_header') ?>
<?php
foreach ($data as $section)
{
    $s_id = reset($section);
    $s_id = $s_id['ClientProjectBudget']['section_id'];
    ?>
    <h3>Dział <?php echo $sections[$s_id]; ?></h3>
    <table cellpadding="0" cellspacing="0" class="table table-bordered">
        <thead>

            <tr>
                <th>
                    <?php echo __d('public', 'Projekt'); ?>
                </th>
                <th>
                    <?php echo __d('public', 'Zysk'); ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sumProfit = 0;
            foreach ($section as $d):
                ?>
                <tr >
                    <td>
                        <?php echo $d['ClientProject']['name']; ?>
                    </td>
                    <td>
                        <?php $profit =  $d['ClientProjectBudget']['position_value'] - $d['work_cost']; ?>
                        <?php echo $profit; ?>
                        <?php $sumProfit += $profit; ?>
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
<?php } ?>
<?php echo $this->Html->css(Router::url('/css/bootstrap.css', true)); ?>