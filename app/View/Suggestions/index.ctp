<?php echo $this->Metronic->portlet(__d('public','Lista uwag')); ?>
<div class="clearfix">
    <div class="col-md-3">
        <form>
            <?php
//            echo $this->Metronic->input('search_box', array(
//                //'label' => __d('public','Szukaj'),
//                'placeholder' => __d('public', 'Szukaj'),
//                'type' => 'text',
//                'ng-model' => 'name',
//                'class' => ' form-control form-control-inline',
//            ));
            ?>
        </form>
    </div>	
</div>
<div class="table-scrollable" id="issuesAssignedTo">
    <table class="table table-striped table-bordered table-advance table-hover">
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><i class="fa fa-suitcase"></i> <?php echo $this->Paginator->sort('Profile.surname'); ?></th>
            <th><i class="fa fa-user"></i> <?php echo $this->Paginator->sort('name'); ?></th>
            <th><i class="fa fa-link"></i> <?php echo $this->Paginator->sort('href'); ?></th>
            <th><i class="fa fa-comment"></i> <?php echo $this->Paginator->sort('content'); ?></th>
            <th><i class="fa fa-briefcase "></i> <?php echo $this->Paginator->sort('type'); ?></th>
            <th><i class="fa fa-briefcase "></i> <?php echo $this->Paginator->sort('file'); ?></th>
            <th><i class="fa fa-calendar"></i> <?php echo $this->Paginator->sort('modified'); ?></th>
            <th><i class="fa fa-calendar"></i> <?php echo $this->Paginator->sort('created'); ?></th>
            <th class="actions"><i class="fa fa-cog"></i> <?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($suggestions as $suggestion): ?>
            <tr>
                <td><?php echo h($suggestion['Suggestion']['id']); ?>&nbsp;</td>
                <td><?php echo h($suggestion['Profile']['firstname']).' '.h($suggestion['Profile']['surname']); ?>&nbsp;</td>
                <td><?php echo h($suggestion['Suggestion']['name']); ?>&nbsp;</td>
                <td><?php echo h($suggestion['Suggestion']['href']); ?>&nbsp;</td>
                <td><?php echo h($suggestion['Suggestion']['content']); ?>&nbsp;</td>
                <td><?php echo h($suggestion['Suggestion']['type']); ?>&nbsp;</td>
                <td><?php echo $this->Html->link($suggestion['Suggestion']['file'], '/files/suggestion/'.$suggestion['Suggestion']['file']); ?>&nbsp;</td>
                <td><?php echo h($suggestion['Suggestion']['modified']); ?>&nbsp;</td>
                <td><?php echo h($suggestion['Suggestion']['created']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $suggestion['Suggestion']['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $suggestion['Suggestion']['id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $suggestion['Suggestion']['id']), null, __('Are you sure you want to delete # %s?', $suggestion['Suggestion']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php echo $this->Metronic->portletEnd(); ?>