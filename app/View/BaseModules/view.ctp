<div class="portlet light" ng-controller="BaseModuleCtrl">
    <div class="portlet-title tabbable-line">
        <div class="caption caption-md">
            <i class="icon-globe theme-font hide"></i>
            <span class="caption-subject font-blue-madison bold uppercase"><?php echo $subtitle; ?></span>
        </div>
    </div>
    <div class="clearfix">
        <span ng-if="!client_project_id">
            <a class="btn btn-sm yellow margin-bottom pull-right ml" ng-href="/base_modules/index"><?php echo __d('public', 'Powrót do listy') ?></a>
        </span>
        <span ng-if="client_project_id">
            <a class="btn btn-sm yellow margin-bottom pull-right ml" ng-href="/base_modules/index/{{client_project_id}}"><?php echo __d('public', 'Powrót do listy') ?></a>
        </span>
    </div>
    <div class="portlet-body" ng-controller="BaseModuleCtrl"> 
        <strong><?php echo __d('public', 'Nazwa modułu') ?></strong>
        <p><?php echo $baseModule['BaseModule']['name']; ?></p>
        
        <strong><?php echo __d('public', 'Nazwa projektu') ?></strong>
        <p><?php echo $baseModule['ClientProject']['name']; ?></p>
        
        <strong><?php echo __d('public', 'Założenia') ?></strong>
        <p><?php echo $baseModule['BaseModule']['foundations']; ?></p>
        
        <strong><?php echo __d('public', 'Typ repozytorium') ?></strong>
        <p><?php echo $baseModule['BaseModule']['repository_type']; ?></p>
        
        <strong><?php echo __d('public', 'Ścieżka do repozytorium') ?></strong>
        <p><?php echo $baseModule['BaseModule']['repository_path']; ?></p>
        
        <strong><?php echo __d('public', 'Kierownik kontaktowy') ?></strong>
        <p><?php if(!empty($baseModule['Coordinator']['Profile'])) echo $baseModule['Coordinator']['Profile']['name']; ?></p>
        
        <strong><?php echo __d('public', 'Kategoria') ?></strong>
        <p><?php echo $baseModule['BaseModule']['category']; ?></p>
            
        <strong><?php echo __d('public', 'Językowość') ?></strong>
        <p><?php echo $baseModule['BaseModule']['languages'] == 1 ? 'Tak' : 'Nie'; ?></p>
        
        <strong><?php echo __d('public', 'Programista kontaktowy') ?></strong>
        <p><?php if(!empty($baseModule['Programmer']['Profile'])) echo $baseModule['Programmer']['Profile']['name']; ?></p>
        
        <strong><?php echo __d('public', 'Uwagi') ?></strong>
        <p><?php echo $baseModule['BaseModule']['comments']; ?></p>
        
        <strong><?php echo __d('public', 'Specyfikacja') ?></strong>
        <div class="specification-container">
            <p><?php echo $baseModule['BaseModule']['specification']; ?></p>
        </div>
    </div>
</div>