<div ng-controller="ProjectListCtrl">
    <!-- projects -> '/client_projects/get.json'-->
	<div ng-init="client_id = <?php if(isset($client_id)) echo $client_id; else echo 0; ?>"></div>
    <div ng-bind="message"></div>
    <div class="clearfix">
        <i 
            ng-click="typeTable = !typeTable" 
            class="fa poitnier pull-right font-large font-blue" 
            ng-class="{'fa-arrows-h':!typeTable,'fa-list':typeTable}"
            ></i>
        <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</span>
        <i 
            ng-click="f0.agreement = !f0.agreement" 
            class="fa fa-warning poitnier pull-right font-large" 
            tooltip="<?php echo __d('public', 'Pokaż brak umowy') ?>" 
            ng-class="{'font-red-pink':f0.agreement}"
            ></i>
        <i 
            ng-click="f0.acceptance_report = !f0.acceptance_report" 
            class="fa fa-warning poitnier pull-right font-large" 
            tooltip="<?php echo __d('public', 'Pokaż brak protokołu odbioru') ?>" 
            ng-class="{'font-red-pink':f0.acceptance_report}"
            ></i>
        <i 
            ng-click="f.close_realization = !f.close_realization" 
            class="fa fa-check poitnier pull-right font-large" 
            tooltip="<?php echo __d('public', 'Pokaż projekty zakończone') ?>" 
            ng-class="{'font-red-pink':f.close_realization}"
            ></i>
        <i 
            ng-click="f.delayed = !f.delayed" 
            class="fa fa-clock-o poitnier pull-right font-large" 
            tooltip="<?php echo __d('public', 'Pokaż opóźnione') ?>" 
            ng-class="{'font-red-pink':f.delayed}"
            ></i>

        <input 
            type="text" 
            ng-model="search" 
            class="col-md-6 col-xs-12 mobile-mt5 pull-left fa-border input-circle ng-pristine ng-valid ng-touched" 
            placeholder="<?php echo __d('public', 'Szukaj') ?>..."
            >
    </div>
    <div ng-hide="typeTable">
        <div class="table-scrollable">
            <table class="table table-striped table-bordered table-advance table-hover">
                <thead>
                    <tr>
                        <th  sort by="order" reverse="reverse" order="'name'">
                            <i class="fa fa-briefcase"></i> <?php echo __d('public', 'Nazwa Projektu') ?>
                        </th>
                        <th  sort by="order" reverse="reverse" order="'start_project'">
                            <i class="fa fa-arrow-right"></i> <?php echo __d('public', 'Początek') ?>
                        </th>
                        <th sort by="order" reverse="reverse" order="'end_project'">
                            <i class="fa fa-arrow-left "></i> <?php echo __d('public', 'Koniec') ?>
                        </th>
                        <th sort by="order" reverse="reverse" order="'budget'">
                            <i class="fa fa-money"></i> <?php echo __d('public', 'Budżet') ?>
                        </th>
                        <th>
                            <i class="fa fa-question"></i> <?php echo __d('public', 'Status') ?> 
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <tr ng-cloak ng-repeat="project in projects| orderBy:order:reverse | pag: currentPage : 10 | filter:search| projectListFilter:f:1| projectListFilter:f0:0" ng-class=" delayedProjectMilestones[ project.id ]['ClientProjectShedules'] ? 'bg-yellow-lemon' : ''">
                        <td ng-bind="project.name"></td>
                        <td ng-bind="project.start_project"></td>
                        <td ng-bind="project.end_project"></td>
                        <td ng-bind="project.budget"></td>
                        <!--<td  status-project id="project.id"></td> webroot\js\angular\template\status-project.html-->
                        <td>
                            <a  ng-if="project.active" href="/client_projects/view/{{project.id}}"><i class="font-large fa fa-list-ul pull-right" tooltip="<?php echo __d('public', 'Przejście do strony projektu') ?>" ></i></a>
                            <a ng-if="!project.active" href="/client_projects/edit/{{project.id}}"><i class="font-large fa fa-edit  pull-right" tooltip="<?php echo __d('public', 'Proces tworzenia projektu nie został ukończony') ?>"></i></a>
                            <i ng-if="project.close_realization == true && project.acceptance_report == true" tooltip="<?php echo __d('public', 'Zakończono realizację, powinien być protokół odbioru') ?>" class="cursor-help font-large fa font-large fa-check"></i>
                            <i ng-if="project.close_financing == true" tooltip="<?php echo __d('public', 'Zakończono finansowanie') ?>" class="cursor-help font-green font-large fa font-large fa-money"></i>
                            <i ng-if="project.delayed" tooltip="<?php echo __d('public', 'Projekt opóźniony względem harmonogramu') ?>" class="cursor-help font-large fa font-large fa-clock-o font-red"></i>
                            <i ng-if="project.active == true && project.agreement == false" tooltip="<?php echo __d('public', 'Po rozpoczęciu projektu brak umowy') ?>" class="cursor-help font-red-pink font-large fa font-large fa-warning"></i>
                            <i ng-if="project.close_realization == true && project.agreement == true && project.acceptance_report == false" tooltip="<?php echo __d('public', 'Po zakończeniu realizacji brak protokołu odbioru') ?>" class="cursor-help font-yellow-lemon font-large fa font-large fa-warning"></i>
                            <i ng-if="project.close_realization == true && project.agreement == false && project.acceptance_report == false" tooltip="<?php echo __d('public', 'Po zakończeniu realizacji brak umowy i protokołu odbioru') ?>" class="cursor-help font-red-thunderbird font-large fa font-large fa-warning"></i>
                            <i ng-if="project.close_realization == true && project.project_database == false" tooltip="<?php echo __d('public', 'Mimo zakończenia realizacji projekt nie jest dodany do bazy projektów') ?>" class="owl owl-1"><span class="through"></span></i>
                            <i ng-if="project.close_realization == true && project.project_database == true" tooltip="<?php echo __d('public', 'Po zakończeniu realizacji projekt jest dodany do bazy projektów') ?>" class="owl owl-1"></i>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <div ng-show="typeTable" ng-init="allProjects = <?php echo h(json_encode($allProjects)) ?>">
        <div class="table-scrollable">
            <table class="table table-striped table-bordered table-advance table-hover">
                <thead>
                    <tr>
                        <th sort by="order" reverse="reverse" order="'name'">
                            <i class="fa fa-briefcase"></i> <?php echo __d('public', 'Nazwa Projektu') ?><br>
                            <i class="fa fa-arrows-h"></i> <?php echo __d('public', 'Harmonogram') ?> 
                        </th>
                    </tr>
                </thead>
                <tbody ng-cloak  ng-repeat="project in projects| orderBy:order:reverse | pag: currentPage : 10 | filter:search | projectListFilter:f:1| projectListFilter:f0:0">
                    <tr>
                        <td ng-bind="project.name"></td>
                    </tr>
                    <tr>
                        <td  bar-project id="project.id" data="allProjects[project.id]"></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="(projects | filter:search | projectListFilter:f:1| projectListFilter:f0:0).length" boundary-links="true"></pagination>
</div>
<?php echo $this->Html->script('angular/controllers/ProjectListCtrl', array('block' => 'angular')); ?>
<?php echo $this->Html->css('/fonts/chouette_alorsregular.css', null, array('inline' => 'false')); ?>


