<?php echo $this->Metronic->portlet(__d('public', 'Dodaj brief')); ?>


<div class="actions pull-left">
    <a href="/briefs/add" data-toggle="modal" class="btn btn-sm btn-circle red-sunglo">
        <i class="fa fa-plus"></i> <?php echo __d('public', 'Dodaj brief'); ?>
    </a>
</div>


<div class="table-scrollable">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th><i class="fa fa-briefcase"></i> <?php echo __d('public', 'Nazwa') ?></th>
                <th><i class="fa fa-user"></i> <?php echo __d('public', 'Opiekun'); ?></th>
                <th><i class="fa fa-comment"></i> <?php echo __d('public', 'Komentarz'); ?></th>
                <th><i class="fa fa-briefcase"></i> <?php echo __d('public', 'Lead') ?></th>
                <!--<th><i class="fa fa-calendar"></i> <?php //echo $this->Paginator->sort('created');    ?></th>-->
                <th><i class="fa fa-calendar"></i> <?php echo __d('public', 'Utworzono') ?></th>
                <th class="actions"><i class="fa fa-cog"></i> <?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tmp = null;
            foreach ($briefs as $brief):
                $silverClass = ($brief['Brief']['client_lead_id'] == $tmp)?'':'bg-grey-silver'
                ?>
                <tr class="<?php echo $silverClass; ?>">
                    <td><?php echo h($brief['Brief']['name']); ?>&nbsp;</td>
                    <td><?php echo $brief['Profile']['firstname'] . ' ' . $brief['Profile']['surname']; ?>&nbsp;</td>
                    <td><?php echo h($brief['Brief']['comment']); ?>&nbsp;</td>
                    <td><?php echo h($brief['ClientLead']['name']); ?>&nbsp;</td>
                    <td><?php echo h($brief['Brief']['created']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link('<i class="fa fa-eye large-icon pull-right" tooltip="Podgląd"></i> ', array('action' => 'view', $brief['Brief']['id']), array('escape' => false, 'class' => '')); ?>
                        <?php echo $this->Html->link('<i class="fa fa-pencil large-icon pull-right" tooltip="Edytuj"></i> ', array('action' => 'add', $brief['Brief']['client_lead_id'], $brief['Brief']['id']), array('escape' => false, 'class' => '')); ?>
                        <?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $clientLead['ClientLead']['id'])); ?>
                        <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $clientLead['ClientLead']['id']), null, __('Are you sure you want to delete # %s?', $clientLead['ClientLead']['id']));  ?>
                    </td>
                </tr>
                <?php $tmp = $brief['Brief']['client_lead_id']; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="profiles | filter:search | length" boundary-links="true"></pagination>

<?php //echo $this->element('cms/paginator');   ?>

<br/>
<div class="actions pull-left">
    <a href="/briefs/add_default_question" data-toggle="modal" class="btn btn-sm btn-circle red-sunglo">
        <i class="fa fa-plus"></i> <?php echo __d('public', 'Dodaj pytnie domyślne'); ?>
    </a>
</div>
<div class="table-scrollable">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th><i class="fa fa-user"></i> <?php echo __d('public', 'Grupa'); ?></th>
                <th><i class="fa fa-comment"></i> <?php echo __d('public', 'Kategoria'); ?></th>
                <th><i class="fa fa-briefcase"></i> <?php echo __d('public', 'Treść pytania') ?></th>
                <!--<th class="actions"><i class="fa fa-cog"></i> <?php echo __('Actions'); ?></th>-->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($brief_default_questions as $bdq): ?>
                <tr>
                    <td><?php echo $bdq['BriefDefaultQuestion']['group_name']; ?>&nbsp;</td>
                    <td><?php echo $bdq['BriefDefaultQuestion']['category_name']; ?>&nbsp;</td>
                    <td><?php echo $bdq['BriefDefaultQuestion']['content']; ?>&nbsp;</td>
    <!--                    <td class="actions">
                    <?php //echo $this->Html->link('<i class="fa fa-eye large-icon pull-right" tooltip="Edytuj"></i> ', array('action' => 'index'), array('escape'=>false, 'class'=>''));   ?>
                    </td>-->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="profiles | filter:search | length" boundary-links="true"></pagination>


<?php echo $this->Metronic->portletEnd(); ?>
