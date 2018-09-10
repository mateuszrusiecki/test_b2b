<?php echo $this->Metronic->portlet(__d('public', 'Pliki'), 1); ?>

<div ng-controller="ProjectFilesCtrl" >
    <button ng-click="addProjectFiles = true" ng-init="input.client_lead_id = <?php echo $lead['ClientLead']['id'];?>" class="btn btn-sm btn-circle red-sunglo"><?php echo __d('public', 'Dodaj plik do leada') ?>Dodaj plik do leada</button>
    <?php
    echo $this->element('ClientProjects/add_file_modal');
    ?>
<div class="getFiles" ng-init="getLeadFiles(); deleteFileType = 'lead';"></div>
<?php echo $this->element('ProjectFiles/table'); ?>
</div>

<?php echo $this->Metronic->portletEnd(); ?>