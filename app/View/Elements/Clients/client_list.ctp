<div class="col-md-3 client_list ng-cloak" ng-init="clients = <?php echo htmlspecialchars(json_encode($clients)); ?>;
        active = '<?php echo reset($this->request->params['pass']); ?>'">

    <?php echo $this->Metronic->portlet(__d('public', 'Lista klientów'), 1); ?>
    <form class="form">
        <div class="form-body">
            <div class="form-group">
                <div class="input-icon right">
                    <i class="icon-magnifier"></i>
                    <input type="text" placeholder="<?php echo __d('public', 'Wpisz nazwę klienta') ?>..." class="form-control input-circle" ng-model="search.Client.name">
                </div>
            </div>
        </div>
    </form>
    <div class="todo-tasklist">
        <div ng-cloak ng-repeat="client in clients| filter:search | pag: paginatioCurrentPage : 5" class="todo-tasklist-item archive_{{client.Client.archive}}" 
             ng-class="{'todo-tasklist-item-border-red' : active === client.Client.id, 'todo-tasklist-item-border-blue' : active != client.Client.id}" >

            <div class="todo-tasklist-item-title">
                <a href="/clients/view/{{client.Client.id}}">
                    {{client.Client.name}}
                    <span ng-show="client.Client.archive" style="font-size: 80%"><?php echo __d('public', '(zarchiwizowany)') ?></span>
                </a> 
            </div>
            <div class="todo-tasklist-item-text">
                {{client.Client.site}}
            </div>
            <div class="todo-tasklist-item-text">
                {{client.Client.email}}
            </div>
            <div class="todo-tasklist-controls">
                <span class="todo-tasklist-date"><i class="fa fa-phone"></i> {{client.Client.phone}}</span>
            </div>	
            <div class="clearfix">
                <label class="pull-left btn btn-sm btn-circle green-seagreen" ng-show="client.Client.comarch_id" tooltip-placement="right" tooltip="<?php echo __d('public', 'Klient zsynchronizowany z optimą'); ?>"><i class="fa fa-exchange red-sunglo"></i></label>
    
                <a href="/clients/connect_client_to_optima/{{client.Client.id}}" class="pull-left btn btn-sm btn-circle red-sunglo" ng-show="!client.Client.comarch_id" tooltip-placement="right" tooltip="<?php echo __d('public', 'Synchronizuj klienta z optimą'); ?>"><i class="fa fa-exchange red-sunglo" ></i></a>
            
                <a ng-show="!client.Client.archive" id="show_client_{{client.Client.id}}" href="/clients/view/{{client.Client.id}}" class="pull-right btn btn-sm btn-circle red-sunglo">
                    <i class="fa fa-eye"></i>  
                    <?php echo __d('public', 'więcej') ?>
                </a>
            </div>
            <div class="clearfix" ng-show="client.Client.archive">
                <a href="/clients/unarchive_client/{{client.Client.id}}" class="pull-right btn btn-sm btn-circle red-sunglo"><?php echo __d('public', 'Przywróć klienta') ?></a>
            </div>
        </div>
    </div>

    <pagination boundary-links="true" total-items="(clients | filter:search).length" items-per-page="5" ng-model="paginatioCurrentPage"   class="pagination-sm fr" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></pagination>

    
    <?php echo $this->Metronic->portletEnd(); ?>

</div>