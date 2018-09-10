<?php echo $this->Metronic->portlet(__d('public', 'Informacje')); ?>
<?php // echo $this->element('Clients/client_contact'); ?> <?php echo __d('public', 'Do odkomentowania') ?>
<?php echo $this->Metronic->portletEnd(); ?>

<?php echo $this->Metronic->portlet(__d('public', 'Lista dokumentów')); ?>

<div class="portlet-body">
    <div class="tabbable-custom nav-justified">
        <ul class="nav nav-tabs nav-justified">
            <li class="active">
                <a href="#change_document" data-toggle="tab">
                    <?php echo __d('public', 'Dokumenty'); ?> </a>
            </li>
            <li>
                <a href="#change_sale" data-toggle="tab">
                    <?php echo __d('public', 'Faktury sprzedażowe'); ?> </a>
            </li>
        </ul>
        <!--BEGIN TABS-->
        <div class="tab-content">
            <div class="tab-pane active" id="change_document">
                <?php // echo $this->element('Hrs/hrs_documents'); ?><?php echo __d('public', 'Odkomentować element') ?>
            </div>
            <div class="tab-pane" id="change_sale">
                <div class="table-scrollable table-scrollable-borderless">
                    <?php // echo $this->element('Hrs/hrs_invocies', array('type' => 1)); ?>
                </div>
            </div>

            <div class="modal modal1 fade" id="basic" tabindex="-1" role="basic" aria-hidden="true" style="display: none;" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title"><?php echo __d('public', 'Zmień opis faktury') ?></h4>
                        </div>
                        <div class="modal-body">
                            <div class="note note-warning" ng-if="desc_error">
                                <p> <?php echo __d('public', 'Wystąpił błąd') ?>. </p>
                            </div>

                            <textarea name="description" ng-model="invoice.description" class="col-md-12 mb5 form-control margin-bottom-10 ng-pristine ng-valid ng-scope ng-touched float-none">
								{{ invoice.description}} </textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn default" data-dismiss="modal"><?php echo __d('public', 'Zamknij') ?></button>
                            <button type="button" ng-click="updateDescription()" class="btn blue"><?php echo __d('public', 'Zapisz') ?> </button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal modal2 fade" id="link_invoice_to_project" tabindex="-1" role="link_invoice_to_project" aria-hidden="true" style="display: none;" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title"><?php echo __d('public', 'Przypisz fakturę do projektu') ?></h4>
                        </div>
                        <div class="modal-body">
                            <?php
                            echo $this->Metronic->input('project_id', array(
                                'label' => false,
                                'ng-model' => 'project_id',
                                'class' => 'form-control clear',
                                'type' => 'select',
                                'options' => $projectList,
                                'required' => 'required',
                                'empty' => __d('public', 'wybierz projekt')
                            ));
                            ?>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn default" data-dismiss="modal">Close</button>
                            <button type="button" ng-click="linkInvoiceToProject(project_id)" class="btn blue"><img ng-if="loading" src="/img/loader_orange_blue.gif" alt="loading" /><?php echo __d('public', 'Zapisz') ?></button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
    </div>
</div>
<?php echo $this->Metronic->portletEnd(); ?>

<?php echo $this->Metronic->portlet(__d('public', 'Lista projektów')); ?>
<table class="table table-striped table-bordered table-advance table-hover" ng-init="projects = <?php echo a($allProjects); ?> ">
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
                        <th sort by="order" reverse="reverse" order="'budg'">
                            <i class="fa fa-money"></i> <?php echo __d('public', 'Budżet') ?>
                        </th>
                        <th>
                            <i class="fa fa-question"></i> <?php echo __d('public', 'Status') ?> 
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <tr ng-cloak ng-repeat="project in projects | pag: currentPage : 10 | filter:search| projectListFilter:f:1| projectListFilter:f0:0 | orderBy:order:reverse" ng-class=" (project.delayed || (project.end_project < (date | date:'yyyy - MM - dd')))? 'bg - yellow - lemon' : ''">
                        <td ng-bind="project.name"></td>
                        <td ng-bind="project.start_project"></td>
                        <td ng-bind="project.end_project"></td>
                        <td ng-class="{'font-green-jungle': budg1 = (1 * project.total_costs_sum < 1 * project.total_development_costs),
									'font-yellow-gold': budg2 = (1 * project.total_costs_sum >= 1 * project.total_development_costs && 1 * project.total_costs_sum <= (project.total_development_costs * 1 + project.total_buffer * 1)), 
									'font-red-thunderbird': budg3 = (1 * project.total_costs_sum > (project.total_development_costs * 1 + project.total_buffer * 1))}"

                            >
                            {{ project.budg = (project.total_development_costs * 1 + project.total_buffer * 1) - project.total_costs_sum * 1}}
                            <i class="fa fa-info-circle cursor-help pull-right" tooltip="{{budg1?'<?php echo __d('public', 'Bilans OK') ?>':'';}}{{budg2?'<?php echo __d('public', 'Przekroczono koszty projektu') ?>':'';}}{{budg3?'<?php echo __d('public', 'Przekroczono koszty i bufor') ?>':'';}}"></i>
                        </td>
                        <td>
                            <a ng-if="project.active" href="/client_projects/view/{{project.id}}" target="_blank"><i class="font-large fa fa-list-ul pull-right" tooltip="<?php echo __d('public', 'Przejście do strony projektu') ?>" ></i></a>
                            <a ng-if="!project.active" href="/client_projects/edit/{{project.id}}" target="_blank"><i class="font-large fa fa-edit  pull-right" tooltip="<?php echo __d('public', 'Proces tworzenia projektu nie został ukończony') ?>"></i></a>
                            <i ng-if="project.close_realization == true && project.acceptance_report == true" tooltip="<?php echo __d('public', 'Zakończono realizację, powinien być protokół odbioru') ?>" class="cursor-help font-large fa font-large fa-check"></i>
                            <i ng-if="project.close_financing == true" tooltip="<?php echo __d('public', 'Zakończono finansowanie') ?>" class="cursor-help font-green font-large fa font-large fa-money"></i>
                            <i ng-if="project.delayed || (project.end_project < (date | date:'yyyy - MM - dd'))" tooltip="<?php echo __d('public', 'Projekt opóźniony względem harmonogramu') ?>" class="cursor-help font-large fa font-large fa-clock-o font-red"></i>
                            <i ng-if="project.active == true && project.agreement == false" tooltip="<?php echo __d('public', 'Po rozpoczęciu projektu brak umowy') ?>" class="cursor-help font-red-pink font-large fa font-large fa-warning"></i>
                            <i ng-if="project.close_realization == true && project.agreement == true && project.acceptance_report == false" tooltip="<?php echo __d('public', 'Po zakończeniu realizacji brak protokołu odbioru') ?>" class="cursor-help font-yellow-lemon font-large fa font-large fa-warning"></i>
                            <i ng-if="project.close_realization == true && project.agreement == false && project.acceptance_report == false" tooltip="<?php echo __d('public', 'Po zakończeniu realizacji brak umowy i protokołu odbioru') ?>" class="cursor-help font-red-thunderbird font-large fa font-large fa-warning"></i>
                            <i ng-if="project.close_realization == true && project.project_database == false" tooltip="<?php echo __d('public', 'Mimo zakończenia realizacji projekt nie jest dodany do bazy projektów') ?>" class="owl owl-1"><span class="through"></span></i>
                            <i ng-if="project.close_realization == true && project.project_database == true" tooltip="<?php echo __d('public', 'Po zakończeniu realizacji projekt jest dodany do bazy projektów') ?>" class="owl owl-1"></i>
                        </td>
                    </tr>

                </tbody>
            </table>
    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="projects | filter:search | projectListFilter:f:1| projectListFilter:f0:0 | length" boundary-links="true"></pagination>
</div>
<?php echo $this->Html->css('/fonts/chouette_alorsregular.css', null, array('inline' => 'false')); ?>
<?php echo $this->Metronic->portletEnd(); ?>