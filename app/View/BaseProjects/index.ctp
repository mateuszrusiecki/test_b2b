<?php echo $this->Metronic->portlet(__d('public', 'Baza projektów')); ?>

<div ng-controller="BaseProjectsCtrl">
    <div aria-hidden="true" role="dialog" tabindex="-1" id="delete_base_project" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    <h4 class="modal-title"><?php echo __d('public', 'Usuń projekt z bazy projektów') ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo __d('public', 'Czy na pewno chcesz usunąć projekt z bazy projektów?') ?>?
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij') ?></button>
                    <button data-dismiss="modal" ng-click="deleteBaseProject()" class="btn blue-madison"><?php echo __d('public', 'Potwierdź') ?></button>
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
                Znaleziono: <span>{{(baseProjects | filter:search).length}}</span>
            </div>
        </div>
        <div class="portlet-body">            
            <div class="table-scrollable">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <th>
                            #
                        </th>
                        <th sort by="order" reverse="reverse" order="'ClientProject.name'" class='vertical-middle'>
                            <i class="fa fa-briefcase"></i>
                            <?php echo __d('public', 'Nazwa projektu'); ?>
                        </th>
                        <th class='vertical-middle'>
                            <i class="fa fa-calendar"></i>
                            <span class="inline-block-display" sort by="order" reverse="reverse" order="'ClientProject.start_project'">Data utworzenia</span> / <span class="inline-block-display" sort by="order" reverse="reverse" order="'ClientProject.end_project'">zakończenia</span>                           
                        </th>
                        <th sort by="order" reverse="reverse" order="'BaseProject.description'" class='vertical-middle'>
                            <i class="fa fa-edit"></i>
                            <?php echo __d('public', 'Opis'); ?>
                        </th>
                        <th>
                            <i class="fa fa-cog"></i>  
                            <?php echo __d('public', 'Opcje'); ?>
                        </th>
                    </thead>
                    <div ng-init="user_permission = '<?php echo $user_permission ?>'"></div>
                    <tbody>
                        <tr ng-cloak ng-repeat="baseProject in baseProjects | filter:search | orderBy:order:reverse | pag: currentPage : 10">
                            <td>
                                {{$index + 1}}
                            </td>
                            <td>
                                <a ng-href="{{'/client_projects/view/' + baseProject.ClientProject.id}}">{{baseProject.ClientProject.name}}</a>
                            </td>
                            <td>
                                {{(baseProject.ClientProject.start_project || 'brak danych') + ' / ' + (baseProject.ClientProject.end_project || 'brak danych')}}
                            </td>
                            <td>
                                <span ng-if="baseProject.BaseProject.description_no_html.length > 4">
                                    {{baseProject.BaseProject.description_no_html | limitChars:50 }}
                                </span>
                                <span ng-if="baseProject.BaseProject.description_no_html.length <= 4">
                                    {{baseProject.BaseProject.tags | limitChars:50 }}
                                </span>
                            </td>
                            <td>
                                
                                <a class="pointer" ng-click="setClickedBaseProjectId(baseProject.BaseProject.id, $index)" ng-if="user_permission == 'all' || user_permission == 'manager'" class="action" id="delete_base_project" href="#delete_base_project" data-toggle="modal">
                                    <i class="fa fa-close  large-icon pull-right" tooltip="<?php echo __d('public', 'Usuń') ?>"></i>
                                </a>  
                                <a class="pointer" href="/base_projects/update/{{baseProject.BaseProject.id}}" ng-if="user_permission == 'all' || user_permission == 'manager'">
                                    <i class="fa fa-edit  large-icon pull-right" tooltip="<?php echo __d('public', 'Edycja') ?>"></i> 
                                </a>  
                                <a class="pointer" href="/base_projects/view/{{baseProject.BaseProject.id}}">
                                    <i class="fa fa-eye  large-icon pull-right" tooltip="<?php echo __d('public', 'Podgląd') ?>"></i> 
                                </a>  
                                
                                <span ng-if="baseProject.ClientProject.BaseModule.length == 0"><i class="fa fa-unlink  large-icon pull-right" tooltip="<?php echo __d('public', 'Brak powiązanych modułów') ?>"></i></span>
                                <span ng-if="baseProject.ClientProject.BaseModule.length > 0">
                                    <a ng-href="{{'/base_modules/index/' + baseProject.ClientProject.id}}"><i class="fa fa-link  large-icon pull-right" tooltip="<?php echo __d('public', 'Link do bazy modułów projektu') ?>"></i></a>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="baseProjects | filter:search | length" boundary-links="true"></pagination>
</div>
<?php echo $this->Metronic->portletEnd(); ?>