<?php echo $this->Metronic->portlet(__d('public', 'Moje projekty')); ?>
<div ng-controller="MainCtrl">
    <div ng-init="projects = <?php if (isset($userProjectList)) echo h(json_encode($userProjectList)) ?>"></div>
    <div class="clearfix">
        <i 
            ng-click="f.delayed = !f.delayed" 
            class="fa fa-clock-o poitnier pull-right font-large margin-top-10 margin-bottom-10" 
            tooltip="Pokaż opóźnione" 
            ng-class="{'font-red-pink':f.delayed}"
            ></i>
        <div class="col-lg-3 col-md-4 col-xs-12 col-sm-6 margin-bottom-10">
            <div class="input-icon right">
                <i class="icon-magnifier"></i>
                <input 
                    type="text" 
                    ng-model="search" 
                    class="pull-left form-control form-control-inline ng-pristine ng-valid ng-touched" 
                    placeholder="<?php echo __d('public', 'Szukaj') ?>"
                    >
            </div>
        </div>
    </div>
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
                    <th>
                        <i class="fa fa-wrench"></i> <?php echo __d('public', 'Narzędzia') ?> 
                    </th>
                    <th>
                        <i class="fa fa-question"></i> <?php echo __d('public', 'Status') ?> 
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr ng-cloak ng-repeat="project in projects| pag: currentPage : 10 | filter:search | projectListFilter:f | orderBy:order:reverse" ng-class=" (project.delayed || (project.end_project < (date | date:'yyyy - MM - dd')))? 'bg - yellow - lemon' : ''">
                    <td ng-bind="project.name"></td>  
                    <td ng-bind="project.start_project"></td>  
                    <td ng-bind="project.end_project"></td>  
                    <td>
                        <a href="#"><i class="fa fa-file-text pull-right font-large" tooltip="TC" ></i></a>
                        <a href="#"><i class="fa fa-file-picture-o pull-right font-large" tooltip="GC" ></i></a>
                        <a href="#"><i class="fa fa-list-alt pull-right font-large" tooltip="CSMS" ></i></a>
                        <a href="#"><i class="fa fa-lightbulb-o pull-right font-large" tooltip="Briefing" ></i></a>
                        <a href="#"><i class="fa fa-sitemap pull-right font-large" tooltip="Makietowanie" ></i></a>
                    </td>  
                    <td>
                        <i ng-if="project.delayed || (project.end_project < (date | date:'yyyy - MM - dd'))" tooltip="Projekt opóźniony względem harmonogramu" class="cursor-help font-large fa font-large fa-clock-o font-red"></i>
                        <a ng-if="project.active" href="/client_projects/view/{{project.id}}" target="_blank"><i class="font-large fa fa-list-ul pull-right" tooltip="Przejście do strony projektu" ></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="projects | filter:search | projectListFilter:f:1| projectListFilter:f0:0 | length" boundary-links="true"></pagination>


<?php echo $this->Metronic->portletEnd(); ?>