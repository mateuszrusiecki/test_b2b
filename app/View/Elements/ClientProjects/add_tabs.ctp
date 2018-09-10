<div>
    <ul class="nav nav-tabs nav-justified">
        <li class="<?php echo $active == 'edit' ? 'active' : ''; ?> ">
            <a <?php echo empty($project_id) ? '' : 'href="' . $this->Html->url(array('controller' => 'client_projects', 'action' => 'edit', $project_id)) . '"'; ?>>
                <?php echo __d('public', 'Ogólne'); ?> </a>
        </li>
        <li class="<?php echo $active == 'add_budget' ? 'active' : ''; ?> <?php echo empty($project_id) ? 'disabled' : ''; ?>">
            <a <?php echo empty($project_id) ? '' : 'href="' . $this->Html->url(array('controller' => 'client_projects', 'action' => 'add_budget', $project_id)) . '"'; ?>>
                <?php echo __d('public', 'Budżet'); ?> </a>
        </li>
        <li class="<?php echo $active == 'add_payment' ? 'active' : ''; ?> <?php echo empty($project_id) ? 'disabled' : ''; ?>">
            <a <?php echo empty($project_id) ? '' : 'href="' . $this->Html->url(array('controller' => 'client_projects', 'action' => 'add_payment', $project_id)) . '"'; ?>>
                <?php echo __d('public', 'Płatności'); ?> </a>
        </li>
        <li class="<?php echo $active == 'add_realization' ? 'active' : ''; ?> <?php echo empty($project_id) ? 'disabled' : ''; ?>">
            <a <?php echo empty($project_id) ? '' : 'href="' . $this->Html->url(array('controller' => 'client_projects', 'action' => 'add_realization', $project_id)) . '"'; ?>>
                <?php echo __d('public', 'Realizacja'); ?> </a>
        </li>
    </ul>
</div>