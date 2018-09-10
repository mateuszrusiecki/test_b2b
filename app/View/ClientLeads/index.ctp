<?php echo $this->Metronic->portlet(__d('public', 'Lista leadów')); ?>

<div class="table-scrollable">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('#'); ?></th>
                <th><i class="fa fa-briefcase"></i> <?php echo $this->Paginator->sort('name'); ?></th>
                <th><i class="fa fa-user"></i> <?php echo $this->Paginator->sort('client_id'); ?></th>
                <th><i class="fa fa-sitemap"></i> <?php echo $this->Paginator->sort('lead_category_id'); ?></th>
                <th><i class="fa fa-question"></i> <?php echo $this->Paginator->sort('lead_status_id'); ?></th>
                <th><i class="fa fa-magic"></i> <?php echo $this->Paginator->sort('probability'); ?></th>
                <th><i class="fa fa-usd "></i> <?php echo $this->Paginator->sort('amount'); ?></th>
                <th><i class="fa fa-usd "></i> <?php echo $this->Paginator->sort('currency_id'); ?></th>
                <th><i class="fa fa-user"></i> <?php echo $this->Paginator->sort('user_id'); ?></th>
                <th><i class="fa fa-comment"></i> <?php echo $this->Paginator->sort('comment'); ?></th>
                <th><i class="fa fa-calendar"></i> <?php echo $this->Paginator->sort('closing_date'); ?></th>
                <th><i class="fa fa-calendar"></i> <?php echo $this->Paginator->sort('modified'); ?></th>
                <th><i class="fa fa-calendar"></i> <?php echo $this->Paginator->sort('created'); ?></th>
                <th class="actions"><i class="fa fa-cog"></i> <?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientLeads as $clientLead): ?>
                <tr>
                    <td><?php echo h($clientLead['ClientLead']['id']); ?>&nbsp;</td>
                    <td><?php echo h($clientLead['ClientLead']['name']); ?>&nbsp;</td>
                    <td>
                        <?php echo $this->Html->link($clientLead['Client']['name'], array('controller' => 'clients', 'action' => 'view', $clientLead['Client']['id'])); ?>
                    </td>
                    <td>
                        <?php echo $this->Html->link($clientLead['LeadCategory']['name'], array('controller' => 'lead_categories', 'action' => 'view', $clientLead['LeadCategory']['id'])); ?>
                    </td>
                    <td>
                        <?php echo $this->Html->link($clientLead['LeadStatus']['name'], array('controller' => 'lead_statuses', 'action' => 'view', $clientLead['LeadStatus']['id'])); ?>
                    </td>
                    <td><?php echo h($clientLead['ClientLead']['probability']); ?>&nbsp;</td>
                    <td><?php echo h($clientLead['ClientLead']['amount']); ?>&nbsp;</td>
                    <td>
                        <?php echo $this->Html->link($clientLead['Currency']['name'], array('controller' => 'currencies', 'action' => 'view', $clientLead['Currency']['id'])); ?>
                    </td>
                    <td>
                        <?php echo $this->Html->link($clientLead['User']['email'], array('controller' => 'users', 'action' => 'view', $clientLead['User']['id'])); ?>
                    </td>
                    <td><?php echo h($clientLead['ClientLead']['comment']); ?>&nbsp;</td>
                    <td><?php echo h($clientLead['ClientLead']['closing_date']); ?>&nbsp;</td>
                    <td><?php echo h($clientLead['ClientLead']['modified']); ?>&nbsp;</td>
                    <td><?php echo h($clientLead['ClientLead']['created']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link('<i class="fa fa-eye large-icon pull-right" tooltip="Podgląd"></i> ', array('action' => 'view', $clientLead['ClientLead']['client_id'],$clientLead['ClientLead']['id']), array('escape'=>false, 'class'=>'')); ?>
                        <?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $clientLead['ClientLead']['id'])); ?>
                        <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $clientLead['ClientLead']['id']), null, __('Are you sure you want to delete # %s?', $clientLead['ClientLead']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!--<pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="profiles | filter:search | length" boundary-links="true"></pagination>-->

<?php echo $this->element('cms/paginator'); ?>


<div class="actions pull-left">
    <a href="#new_report" data-toggle="modal" class="btn btn-sm btn-circle red-sunglo">
        <i class="fa fa-plus"></i> <?php echo __d('public', 'Generuj raport'); ?>
    </a>
</div>


<?php echo $this->element('Clients/add_lead_report_all'); ?>

<div class="clearfix"></div>

<?php echo $this->Metronic->portletEnd(); ?>
