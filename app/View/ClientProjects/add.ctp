<?php echo $this->Form->create('ClientProject', array('name' => 'forms.ClientProject')); ?>
<?php //debug($clientLead)   ?>
<?php // /debug($project) ?>
<?php $this->Html->addCrumb('CRM', array('controller' => 'clients', 'action' => 'index')); ?>
<?php
$project_id = empty($project['ClientProject']['id']) ? null : $project['ClientProject']['id'];
echo $this->element('ClientProjects/add_tabs', array('project_id' => $project_id, 'active' => 'edit'));
?>
<div class="row"  ng-controller="AddProjectCtrl">

    <div class="col-md-7">
<?php echo $this->Metronic->portlet(__d('public', 'Nowy projekt')); ?>

        <h3 class="inline"><?php echo __d('public', 'Na podstawie leadu'); ?></h3> 
<?php echo $this->Html->link('"' . $clientLead['ClientLead']['name'] . '"', array('controller' => 'client_leads', 'action' => 'view', $clientLead['ClientLead']['client_id'], $clientLead['ClientLead']['id']), array('target' => '_blank')); ?>
        <br /><br />

        <?php echo $this->element('ClientProjects/addForm'); ?>

<?php echo $this->Metronic->portletEnd(); ?>
    </div>
    <div class="col-md-5">

<?php echo $this->Metronic->portlet(__d('public', 'Informacje z leadu')); ?>
        <div class="clearfix">
            <h3><?php echo __d('public', 'Informacje kontaktowe'); ?></h3>

            <?php echo $this->element('ClientProjects/contactInfo'); ?>

            <?php
            echo $this->Metronic->input('ClientProject.account_manager_id', array(
                'label' => array('text' => __d('public', 'Account manager'), 'class' => 'control-label col-md-3'),
                'options' => $managers,
                'class' => 'form-control input-medium ',
                'default' => $session['Auth']['User']['id'],
                'div' => array('class' => 'form-group bordered')
            ));
            ?>

            <h3> <?php echo __d('public', 'Wybierz osoby kontaktowe w projekcie'); ?> </h3>

            <?php echo $this->element('ClientProjects/clientsScroller'); ?>
<?php echo $this->element('ClientProjects/fileQuestion'); ?>
            <h3><?php echo __d('public', 'Załączone pliki'); ?><div ng-click="infoPhoto = true;" class="pull-right poitnier" ><i class="fa fa-upload"></i><i class="fa fa-question"></i></div></h3>

            <?php echo $this->Form->input('ClientProject.client_id', array('type' => 'hidden', 'label' => false, 'value' => $clientLead['Client']['id'], 'div' => false)); ?>

            <?php echo $this->element('ClientProjects/filesList'); ?>

<?php echo $this->element('ClientProjects/projectWithoutAgreementNotification'); ?>

            <div class="col-md-6 col-md-offset-6 col-xs-12">
<?php echo $this->Form->button('<i class="fa fa-money"></i> ' . __d('public', 'Zapisz i kontynuuj'), array('class' => 'btn btn-sm red-sunglo pull-right', 'escape' => false, 'type' => 'submit')); ?>
            </div>

        </div>
<?php echo $this->Metronic->portletEnd(); ?>
    </div>
</div>


<?php echo $this->Form->end(); ?>

