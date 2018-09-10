<div id="table_index_no_ajax" ng-controller="MainCtrl" ng-init="hidenClient = <?php echo (int)!empty($hidenClient) ?>" data-intro="<?php echo __d('public', 'Panel projektów w których bierzesz udział') ?>" data-step="50">
    <div ng-bind="message"></div>
    <div class="clearfix">
        <div style="float: right" data-intro="<?php echo __d('public', 'Filtry projetków i przełącznik do widoku progresbar') ?>" data-step="60">
            <i id="project_timetable"
                ng-click="typeTable = !typeTable" 
                class="fa poitnier pull-right font-large font-blue margin-top-10 margin-bottom-10" 
                ng-class="{'fa-arrows-h':!typeTable,'fa-list':typeTable}"
                tooltip="<?php echo __d('public', 'Widok progresbar') ?>" 
                ></i>
            <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</span>
            <i id="project_no_agreement"
                ng-click="f0.agreement = !f0.agreement" 
                class="fa fa-warning poitnier pull-right font-large margin-top-10 margin-bottom-10" 
                tooltip="<?php echo __d('public', 'Pokaż brak umowy') ?>" 
                ng-class="{'font-red-pink':f0.agreement}"
                ></i>
            <i id="project_no_acceptance_report"
                ng-click="f0.acceptance_report = !f0.acceptance_report" 
                class="fa fa-warning poitnier pull-right font-large margin-top-10 margin-bottom-10" 
                tooltip="<?php echo __d('public', 'Pokaż brak protokołu odbioru') ?>" 
                ng-class="{'font-red-pink':f0.acceptance_report}"
                ></i>
            <i id="project_close_realization"
                ng-click="f.close_realization = !f.close_realization" 
                class="fa fa-check poitnier pull-right font-large margin-top-10 margin-bottom-10" 
                tooltip="<?php echo __d('public', 'Pokaż projekty zakończone') ?>" 
                ng-class="{'font-red-pink':f.close_realization}"
                ></i>
            <i id="project_delayed"
                ng-click="f.delayed = !f.delayed" 
                class="fa fa-clock-o poitnier pull-right font-large margin-top-10 margin-bottom-10" 
                tooltip="<?php echo __d('public', 'Pokaż opóźnione') ?>" 
                ng-class="{'font-red-pink':f.delayed}"
                ></i>
        </div>
            <div class="col-lg-3 col-md-4 col-xs-12 col-sm-6 margin-bottom-10">
                <div class="input-icon right">
                    <i class="icon-magnifier"></i>
                    <input 
                        type="text" 
                        ng-model="search" 
                        class="pull-left form-control form-control-inline ng-pristine ng-valid ng-touched" 
                        placeholder="<?php echo __d('public', 'Szukaj') ?>..."
                        >
                </div>
            </div>
    </div>
    <div ng-init="projects = <?php echo a(@$allProjects); ?>"></div>
	<div ng-init="user_permission = '<?php echo $_SESSION['user_permission'] ?>'"></div>
    <div ng-hide="typeTable">

        <div class="table-scrollable">
            <table class="table table-striped table-bordered table-advance table-hover projectTable">
                <thead>
                    <tr>
                        <th>
                            <i class="fa fa-info-circle font-red-sunglo font-large info-circle" tooltip-placement="right"
                               tooltip-html-unsafe="<?php echo __d('public', 'Mail do projektu:<br/> aby wysłac mail do projektu <br/>należy wpisać adres<br/> crm@febdev.pl a w tytule podać <br/>poniższe oznaczenie np. $8') ?>">
                            </i> 
                        </th>
                        <th  sort by="order" reverse="reverse" order="'name'">
                            <i class="fa fa-briefcase"></i> <?php echo __d('public', 'Nazwa Projektu') ?>
                        </th>
                        <th  sort by="order" reverse="reverse" order="'start_project'">
                            <i class="fa fa-arrow-right"></i> <?php echo __d('public', 'Początek') ?>
                        </th>
                        <th sort by="order" reverse="reverse" order="'end_project'">
                            <i class="fa fa-arrow-left "></i> <?php echo __d('public', 'Koniec') ?>
                        </th>
                        <th ng-hide="user_permission == 'user'" sort by="order" reverse="reverse" order="'budg'" ng-show="user_permission">
                            <i class="fa fa-money"></i> <?php echo __d('public', 'Budżet') ?>
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
                    <tr ng-cloak ng-repeat="project in projects| pag: currentPage : 10 | filter:search| projectListFilter:f:1| projectListFilter:f0:0 | orderBy:order:reverse" ng-class=" (project.delayed || (project.end_project < (date | date:'yyyy - MM - dd')))? 'bg - yellow - lemon' : ''">
                        <td> ${{project.id}} </td>
                        <td ng-bind="project.name"></td>
                        <td ng-bind="project.start_project"></td>
                        <td ng-bind="project.end_project"></td>
                        <td ng-hide="user_permission == 'user'" ng-class="{'font-green-jungle': budg1 = (1 * project.total_costs_sum < 1 * project.total_development_costs),
									'font-yellow-gold': budg2 = (1 * project.total_costs_sum >= 1 * project.total_development_costs && 1 * project.total_costs_sum <= (project.total_development_costs * 1 + project.total_buffer * 1)), 
									'font-red-thunderbird': budg3 = (1 * project.total_costs_sum > (project.total_development_costs * 1 + project.total_buffer * 1))}"

                            >
                            {{ project.total_costs_sum ? project.budg = (project.total_development_costs * 1 + project.total_buffer * 1) - project.total_costs_sum * 1 : '<?php echo __d('public', 'Brak danych') ?>'}} 
							<i ng-if="project.total_costs_sum" class="fa fa-info-circle cursor-help pull-right" tooltip="{{budg1?'<?php echo __d('public', 'Bilans OK') ?>':'';}}{{budg2?'<?php echo __d('public', 'Przekroczono koszty projektu') ?>':'';}}{{budg3?'<?php echo __d('public', 'Przekroczono koszty i bufor') ?>':'';}}"></i>
                        </td>
                        <td style="min-width: 195px;">
                            <a href="mailto:{{ project.Client.email }}?subject=Projekt ${{ project.id }}&bcc=crm@feb.net.pl" tooltip="Mail do klienta, który zostanie umieszczny w logu projektu"><i class="fa fa-envelope-o"></i></a>
                            <!--<a href="/text_documents/update_from_client_project/{{project.id}}" class="margin-left-5"><i class="fa fa-file-text pull-right font-large" tooltip="TC" ></i></a>-->
                            <a href="/text_documents/index/{{project.client_lead_id}}" class="margin-left-5"><i class="fa fa-file-text pull-right font-large" tooltip="<?php echo __d('public', 'TC') ?>" ></i></a>
                            <a href="/new_clients/main#/projects/lead_id/{{project.client_lead_id}}" class="margin-left-5"><i class="fa fa-file-picture-o pull-right font-large" tooltip="<?php echo __d('public', 'GC') ?>" ></i></a>
                            <a href="/poll/polls/view/client_project_id/{{project.id}}" class="margin-left-5"><i class="fa fa-list-alt pull-right font-large" tooltip="<?php echo __d('public', 'CSMS') ?>" ></i></a>
                            <a ng-hide="user_permission == 'client' || !project.client_lead_id" href="/briefs/view/{{project.client_lead_id}}/1" class="margin-left-5"><i class="fa fa-lightbulb-o pull-right font-large" tooltip="<?php echo __d('public', 'Briefing') ?>" ></i></a>
                            <a href="/project_mockups/project_mockups/index/{{project.id}}" class="margin-left-5"><i class="fa fa-sitemap pull-right font-large" tooltip="<?php echo __d('public', 'Makietowanie') ?>" ></i></a>
                            <a ng-show="user_permission != 'client'" href="/bonus_panels/bonus/{{project.id_md5}}"><i class="fa fa-money pull-right font-large margin-left-5" tooltip="<?php echo __d('public', 'Panel premii') ?>" ></i></a>
                        </td>
                        <td>
                           
                            <a ng-if="project.active" href="/client_projects/{{hidenClient?'view_client':'view'}}/{{project.id}}" target="_blank"><i class="view_project_{{project.id}} font-large fa fa-list-ul pull-right" tooltip="<?php echo __d('public', 'Przejście do strony projektu') ?>" ></i></a>
                            <a ng-if="!project.active && !hidenClient" href="/client_projects/edit/{{project.id}}" target="_blank"><i class="font-large fa fa-edit  pull-right" tooltip="<?php echo __d('public', 'Proces tworzenia projektu nie został ukończony') ?>"></i></a>
                            <i ng-if="project.close_realization == true && project.acceptance_report == true" tooltip="<?php echo __d('public', 'Zakończono realizację, powinien być protokół odbioru') ?>" class="cursor-help font-large fa font-large fa-check"></i>
                            <i ng-if="project.close_financing == true" tooltip="<?php echo __d('public', 'Zakończono finansowanie') ?>" class="cursor-help font-green font-large fa font-large fa-money"></i>
                            <i ng-if="project.delayed || (project.end_project < (date | date:'yyyy - MM - dd'))" tooltip="<?php echo __d('public', 'Projekt opóźniony względem harmonogramu') ?>" class="cursor-help font-large fa font-large fa-clock-o font-red"></i>
                            <i ng-if="project.active == true && project.agreement == false" tooltip="<?php echo __d('public', 'Po rozpoczęciu projektu brak umowy') ?>" class="cursor-help font-red-pink font-large fa font-large fa-warning"></i>
                            <i ng-if="project.close_realization == true && project.agreement == true && project.acceptance_report == false" tooltip="<?php echo __d('public', 'Po zakończeniu realizacji brak protokołu odbioru') ?>" class="cursor-help font-yellow-lemon font-large fa font-large fa-warning"></i>
                            <i ng-if="project.close_realization == true && project.agreement == false && project.acceptance_report == false" tooltip="<?php echo __d('public', 'Po zakończeniu realizacji brak umowy i protokołu odbioru') ?>" class="cursor-help font-red-thunderbird font-large fa font-large fa-warning"></i>
                            <i ng-if="project.close_realization == true && project.project_database == false" tooltip="<?php echo __d('public', 'Mimo zakończenia realizacji projekt nie jest dodany do bazy projektów') ?>" class="cursor-help owl owl-1"><span class="through"></span></i>
                            <i ng-if="project.close_realization == true && project.project_database == true" tooltip="<?php echo __d('public', 'Po zakończeniu realizacji projekt jest dodany do bazy projektów') ?>" class="cursor-help owl owl-1"></i>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <div ng-show="typeTable" ng-init="allProjects = <?php echo a(@$allProjects); ?>">
        <div class="table-scrollable">
            <table class="table table-striped table-bordered table-advance table-hover">
                <thead>
                    <tr>
                        <th sort by="order" reverse="reverse" order="'name'">
                            <i class="fa fa-briefcase"></i> <?php echo __d('public', 'Nazwa Projektu') ?> <br>
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
    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="projects | filter:search | projectListFilter:f:1| projectListFilter:f0:0 | length" boundary-links="true"></pagination>
</div>


<?php echo $this->Html->css('/fonts/chouette_alorsregular.css', null, array('inline' => 'false')); ?>


