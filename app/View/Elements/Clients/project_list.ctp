
<div class="table-scrollable">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th>
                    <i class="fa fa-info-circle font-red-sunglo font-large info-circle"
                       title="<?php echo __d('public', 'Mail do leadu:aby wysłac mail do leadu należy w tytule dodać poniższe oznaczenie np. #7') ?>">
                    </i> 
                </th>
                <th>
                    <i class="fa fa-briefcase"></i> <?php echo __d('public', 'Nazwa'); ?>
                </th>
                <th>
                    <i class="fa fa-inbox "></i> <?php echo __d('public', 'Kategoria'); ?>
                </th>
                <th>
                    <i class="fa fa-bar-chart-o "></i> <?php echo __d('public', 'Status'); ?>
                </th>
                <th>
                    <i class="fa fa-money  "></i> <?php echo __d('public', 'Kwota'); ?>
                </th>
                <th>
                    <i class="fa fa-dollar "></i> <?php echo __d('public', 'Waluta'); ?>
                </th>
                <th>
                    <i class="fa fa-user"></i> <?php echo __d('public', 'Handlowiec'); ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($projects as $project): ?>
                <tr>
                    <td> #<?php echo $project['ClientProject']['id']; ?> </td>
                    <td class="highlight">
                        <?php
                        echo $this->Html->link($project['ClientProject']['name'], array('controller' => 'client_projects', 'action' => 'view', $project['ClientProject']['id']))
                        ?>
                    </td>
                    <td>  </td>
                    <td> <?php echo $project['ClientProject']['status']; ?> </td>
                    <td> <?php echo $project['ClientProject']['budget']; ?> </td>
                    <td> EUR </td>
                    <td> <?php echo $project['ClientLead']['user_id']; ?> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>