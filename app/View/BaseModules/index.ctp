<?php echo $this->Metronic->portlet(__d('public', 'Baza modułów')); ?>

<div ng-controller="BaseModulesCtrl">
    <div aria-hidden="true" role="dialog" tabindex="-1" id="delete_base_module" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    <h4 class="modal-title"><?php echo __d('public', 'Usuń projekt z bazy modułów') ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo __d('public', 'Czy na pewno chcesz usunąć projekt z bazy modułów?') ?>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij') ?></button>
                    <button data-dismiss="modal" ng-click="deleteBaseModule()" class="btn blue-madison"><?php echo __d('public', 'Potwierdź') ?></button>
                </div>
            </div>
        </div>
    </div>

    <div class="table-scrollable table-scrollable-borderless">
        <div class="clearfix">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form>
                    <div class="input-icon right">
                        <i class="icon-magnifier"></i>
                        <div class="form-group">
                            <div class="input-icon right">
                                <input ng-model="search" type="text" id="search_box" placeholder="<?php echo __d('public', 'Szukaj') ?>" side="right" class="form-control form-control-inline" />
                            </div>
                        </div>                    
                    </div>
                </form>
            </div>
            <div class="pull-right caption-subject font-blue-madison bold uppercase mr ng-cloak">
                Znaleziono: <span>{{(baseModules | filter:search).length}}</span>
            </div>
        </div>
        <div class="portlet-body" ng-init="user_permission = '<?php echo $user_permission ?>'">            
            <div class="table-scrollable">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <th>
                            #
                        </th>
                        <th sort by="order" reverse="reverse" order="'BaseModule.category'" class='vertical-middle'>
                            <i class="fa fa-server"></i>
                            <?php echo __d('public', 'Kategoria'); ?>
                        </th>
                        <th sort by="order" reverse="reverse" order="'BaseModule.name'" class='vertical-middle'>
                            <i class="fa fa-barcode"></i>
                            <?php echo __d('public', 'Nazwa'); ?>
                        </th>
                        <th sort by="order" reverse="reverse" order="'ClientProject.name'" class='vertical-middle'>
                            <i class="fa fa-briefcase"></i>
                            <?php echo __d('public', 'Nazwa projektu'); ?>
                        </th>
                        <th sort by="order" reverse="reverse" order="'BaseModule.comments'" class='vertical-middle'>
                            <i class="fa fa-edit"></i>
                            <?php echo __d('public', 'Uwagi'); ?>
                        </th>
                        <th>
                            <i class="fa fa-cog"></i>  
                            <?php echo __d('public', 'Opcje'); ?>
                        </th>
                    </thead>
                    <tbody>
                        <tr ng-cloak ng-repeat="baseModule in baseModules | filter:search | orderBy:order:reverse | pag: currentPage : 10">
                            <td>
                                {{$index + 1}}
                            </td>
                            <td>
                                {{baseModule.BaseModule.category}}
                            </td>  
                            <td>
                                {{baseModule.BaseModule.name}}
                            </td>  
                            <td>
                                <a ng-href="{{'/client_projects/view/' + baseModule.ClientProject.id}}">{{baseModule.ClientProject.name}}</a>
                            </td>    
                            <td>
                                <span ng-if="baseModule.BaseModule.comments.length > 4">
                                    {{baseModule.BaseModule.comments | limitChars:50 }}
                                </span>
                                <span ng-if="baseModule.BaseModule.comments.length <= 4">
                                    {{baseModule.BaseModule.specification | limitChars:50 }}
                                </span>
                            </td>  
                            <td>
                                <a ng-if=" user_permission == 'all' || user_permission == 'manager' " class="pointer" ng-click="setClickedBaseModuleId(baseModule.BaseModule.id, $index)" class="action" id="delete_base_module" href="#delete_base_module" data-toggle="modal">
                                    <i class="fa fa-close  large-icon pull-right" tooltip="<?php echo __d('public', 'Usuń') ?>"></i>
                                </a>  
                                <a ng-if="client_project_id == null && (user_permission == 'all' || user_permission == 'manager') " class="pointer" href="/base_modules/update/{{baseModule.BaseModule.id}}">
                                    <i class="fa fa-edit  large-icon pull-right" tooltip="<?php echo __d('public', 'Edycja') ?>"></i> 
                                </a>  
                                <a ng-if="client_project_id == null" class="pointer" href="/base_modules/view/{{baseModule.BaseModule.id}}">
                                    <i class="fa fa-eye  large-icon pull-right" tooltip="<?php echo __d('public', 'View') ?>"></i>
                                </a>  
                                <a ng-if="client_project_id != null && (user_permission == 'all' || user_permission == 'manager') " class="pointer" href="/base_modules/update/{{baseModule.BaseModule.id}}/{{client_project_id}}">
                                    <i class="fa fa-edit  large-icon pull-right" tooltip="<?php echo __d('public', 'Edycja') ?>"></i> 
                                </a> 
                                <a ng-if="client_project_id != null" class="pointer" href="/base_modules/view/{{baseModule.BaseModule.id}}/{{client_project_id}}">
                                    <i class="fa fa-eye  large-icon pull-right" tooltip="<?php echo __d('public', 'View') ?>"></i>
                                </a> 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="baseModules | filter:search | length" boundary-links="true"></pagination>
</div>
<?php echo $this->Metronic->portletEnd(); ?>