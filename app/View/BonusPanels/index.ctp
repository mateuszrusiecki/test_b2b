<?php echo $this->Metronic->portlet(__d('public', 'Lista projektów')); ?>
<div ng-controller="BonusCtrl">
    <div ng-bind="message"></div>
    <div class="clearfix">

        <div class="col-lg-3 col-md-4 col-xs-12 col-sm-6 margin-bottom-10">
            <div class="input-icon right">
                <i class="icon-magnifier"></i>
                <input 
                    type="text" 
                    ng-model="search" 
                    class="pull-left form-control form-control-inline ng-pristine ng-valid ng-touched" 
                    placeholder=" <?php echo __d('public', 'Szukaj') ?>"
                    >
            </div>
        </div>
    </div>

    <div ng-init="projects = <?php if (isset($allProjects)) echo h(json_encode($allProjects)) ?>"></div>
    <div ng-hide="typeTable">

        <div class="table-scrollable">
            <table class="table table-striped table-bordered table-advance table-hover">
                <thead>
                    <tr>
                        <th  sort by="order" reverse="reverse" order="'name'">
                            <i class="fa fa-briefcase"></i> <?php echo __d('public', 'Nazwa Projektu') ?>
                        </th>
                        <th>
                            <span class="pull-left"  sort by="order" reverse="reverse" order="'start_project'">
                                <i class="fa fa-arrow-right"></i> <?php echo __d('public', 'Początek') ?>&nbsp;&nbsp;
                            </span>
                            <span class="pull-left">&nbsp;&nbsp;/&nbsp;&nbsp; </span>
                            <span class="pull-left" sort by="order" reverse="reverse" order="'end_project'">
                                <i class="fa fa-arrow-left "></i> <?php echo __d('public', 'Koniec') ?>&nbsp;&nbsp;
                            </span>
                        </th>
                        <th sort by="order" reverse="reverse" order="'budg'">
                            <i class="fa fa-money"></i> <?php echo __d('public', 'Rentowność') ?>
                        </th>
                        <th>
                            <i class="fa fa-gears"></i> <?php echo __d('public', 'Opcje') ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-cloak ng-repeat="project in projects| pag: currentPage : 10 | filter:search| orderBy:order:reverse" ng-class=" (project.delayed || (project.end_project < (date | date:'yyyy - MM - dd')))? 'bg - yellow - lemon' : ''">
                        <td ng-bind="project.name"></td>
                        <td>{{project.start_project}} / {{project.end_project}}</td>
                        <td ng-class="{'font-green-jungle': budg1 = (1 * project.total_costs_sum < 1 * project.total_development_costs),
									'font-yellow-gold': budg2 = (1 * project.total_costs_sum >= 1 * project.total_development_costs && 1 * project.total_costs_sum <= (project.total_development_costs * 1 + project.total_buffer * 1)), 
									'font-red-thunderbird': budg3 = (1 * project.total_costs_sum > (project.total_development_costs * 1 + project.total_buffer * 1))}">
                            {{ project.total_costs_sum ? project.budg = (project.total_development_costs * 1 + project.total_buffer * 1) - project.total_costs_sum * 1 : 'Brak danych'}} 
                            <i ng-if="project.total_costs_sum" class="fa fa-info-circle cursor-help pull-right" tooltip="{{budg1?'Bilans OK':'';}}{{budg2?'Przekroczono koszty projektu':'';}}{{budg3?'Przekroczono koszty i bufor':'';}}"></i>
                        </td>
                        <td>
                            <a href="/bonus_panels/bonus/{{project.id_md5}}" 
                               target="_blank">
                                <i class="fa fa-television"></i>
                            </a>
                            <i class="fa fa-link" 
                               ng-click="showLink = !showLink"
                               tooltip="<?php echo __d('public', 'Link do panelu premi króty można skopiować i udostępnić') ?>" 
                               target="_blank">
                            </i>
                            <div ng-cloak class="modal-backdrop fade in" ng-show="showLink"></div>
                            <div ng-show="showLink" class="modal angular" style="display: block;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button aria-hidden="true" class="close" type="button" ng-click="showLink = false"></button>
                                            <h4 class="modal-title"><?php echo __d('public', 'Link do panelu premi króty można skopiować i udostępnić.'); ?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                <?php $link = Router::url(array('action' => 'bonus'), true) ?>
                                                <input class="form-control" type="text" readonly="true" value="<?php echo $link; ?>/{{project.id_md5}}" />
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button ng-click="showLink = false" class="btn default" type="button"><?php echo __d('public', 'Zamknij'); ?></button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>


                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="projects | filter:search | length" boundary-links="true"></pagination>

</div>

<?php echo $this->Html->css('/fonts/chouette_alorsregular.css', null, array('inline' => 'false')); ?>

<?php echo $this->Html->script('angular/controllers/BonusCtrl', array('block' => 'angular')); ?>


<?php echo $this->Metronic->portletEnd(); ?>