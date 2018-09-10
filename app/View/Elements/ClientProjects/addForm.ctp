
<?php
$projectNameTmp = $this->Form->value('ClientProject.name');
if (!empty($projectNameTmp))
{
    echo $this->Metronic->input('ClientProject.name', array('label' => __d('public', 'Nazwa projektu'), 'required' => true, 'ng-init' => 'projectname ="' . $projectNameTmp . '"; promtAlias(projectname);', 'ng-model' => 'projectname', 'ng-change' => 'promtAlias(projectname);'));
} else {
    echo $this->Metronic->input('ClientProject.name', array('label' => __d('public', 'Nazwa projektu'), 'required' => true, 'ng-model' => 'projectname', 'ng-change' => 'promtAlias(projectname);'));
}
echo $this->Metronic->input('ClientProject.alias', array('label' => __d('public', 'Alias'), 'required' => true, 'ng-model' => 'alias'));
echo $this->Metronic->input('ClientProject.user_id', array('label' => __d('public', 'Kierownik projektu'), 'required' => true, 'options' => $bossList));
echo $this->Form->hidden('ClientProject.project_author_id');
echo $this->Metronic->input('ClientProject.project_author', array('label' => __d('public', 'Autor projektu'), 'value' => $projectAuthor['Profile']['firstname'].' '.$projectAuthor['Profile']['surname'], 'readonly'));
echo $this->Metronic->input('ClientProject.created', array('label' => __d('public', 'Data utworzenia'), 'type' => 'text', 'readonly', 'value' => date('Y-m-d')));
?>


<datalist>
    <?php $seoList = empty($seoList) ? array() : $seoList; ?>
    <?php foreach ($seoList as $seoLink){ ?>
        <option value="<?php echo $seoLink ?> ">
    <?php } ?>
</datalist>

<label><?php echo __d('public', 'SEO - wybierz domeny') ?></label>

<div id="seolist" ng-init="seolists =<?php echo  empty($seoLists) ? '{}' :a($seoLists); ?>">

    <div class="form-group" ng-cloak ng-repeat="seolist in seolists">
        <div class="input-icon right">
            <div class="checker" id="uniform-ClientProjectSeoDomain">
                <span ng-class="{checked:seolist.checked}">
                    <input style="display:none;" type="hidden" value="0" name="data[ClientProject][seo_domain][{{seolist.id}}]">
                    <input ng-model="seolist.checked" type="checkbox" id="ClientProjectSeoDomain{{seolist.id}}" value="{{seolist.checked?'1':'0'}}" side="right" class="form-control" name="data[ClientProject][seo_domain][{{seolist.id}}]">
                </span>
            </div>
            <label for="ClientProjectSeoDomain{{seolist.id}}">{{seolist.domain}}</label></div>
    </div>
</div>

<div>
    <div class="col-md-6">
        <?php echo $this->Metronic->input('ClientDomain.new_seo_domain', array('label' => false, 'class' => 'form-control input-sm new_seo_domain', 'ng-model' => 'new_seo_domain')); ?>
    </div>
    <div class="col-md-4">
        <a class="btn btn-sm green" href="#new_lead" data-toggle="modal" ng-click="addClientDomain(<?php echo $clientLead['ClientLead']['client_id'] ?>, new_seo_domain);"><?php echo __d('public', 'Dodaj domenę') ?> <i class="fa fa-plus"></i> </a>
    </div>
    <div class="col-md-12 error-message" ng-if="seoMessageError">{{seoMessageError}}</div>
</div>
<?php echo $this->Metronic->input('ClientProject.client_lead_id', array('label' => false, 'type' => 'hidden', 'value' => $clientLead['ClientLead']['id'])); ?>


<div aria-hidden="false" role="new_lead" tabindex="-1" id="new_lead" ng-if="lol" class="modal fade in ng-cloak"><div class="modal-backdrop fade in"></div>
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo __d('public', 'Dodaj domenę'); ?></h4>
            </div>
            <div class="modal-body">
                [<?php echo __d('public', 'Komunikat') ?>]
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij'); ?></button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
