
<?php echo $this->Metronic->portlet(__d('public', 'Częściowe protokoły odbioru')); ?>	
    <?php //debug($acceptanceReports) //echo $this->Element('AcceptanceReports/table_index'); ?> 
 
<div ng-controller="AcceptanceReportCtrl">
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="form-body">
                    <div class="form-group">
                        <div class="input-icon right">
                            <i class="icon-magnifier"></i>
                            <input 
                                type="text" 
                                ng-model="search" 
                                class="form-control ng-pristine ng-valid ng-touched" 
                                placeholder="<?php echo __d('public', 'Szukaj') ?>..."
                                >
                        </div>
                    </div>
                </div>
            </div>
    <div class="clear"></div>

    <div class="table-scrollable">
        <table class="table table-striped table-bordered table-advance table-hover">
            <thead>
                <tr>
                    <th><i class="fa fa-briefcase"></i> <?php echo __d('cms', 'Projekt'); ?></th>
                    <th><i class="fa fa-user"></i> <?php echo __d('cms', 'Klient'); ?></th>
                    <th><i class="fa fa-anchor"></i> <?php echo __d('cms', 'Kamień milowy'); ?></th>
                    <th>
                        <i class="fa fa-calendar"></i> <?php echo __d('cms', 'Created'); ?>
                        <?php //echo $this->Paginator->sort('modified', __d('cms', 'Modified')); ?>
                    </th>
                    <th><i class="fa fa-check-circle-o"></i> <?php echo __d('cms', 'Akceptacja'); ?></th>
                    <th class="actions"><i class="fa fa-cog"></i> <?php echo __('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="report in reports | filter:search | pag: currentPage : 10">
                        <td ng-bind="report.ClientProject.name"></td>
                        <td ng-bind="report.Client.name"></td>
                        <td ng-bind="report.ClientProjectShedule.name"></td>
                        <td>
                            {{ report.AcceptanceReport.modified }}
                        </td>
                        <td> <i ng-if="report.AcceptanceReport.acceptance == 1" class="fa fa-check font-green"></i> <i ng-if="report.AcceptanceReport.acceptance == 0" class="fa fa-warning font-red"></i></td>
                        <td class="actions">
                            <a href="/acceptance_reports/fill/{{ report.AcceptanceReport.hid }}"><i tooltip="Formularz protokołu" class="fa fa-pencil-square large-icon pull-right"></i></a>
                            <a href="/acceptance_reports/view/{{ report.AcceptanceReport.id }}"><i tooltip="Podgląd protokołu" class="fa fa-eye  large-icon pull-right"></i></a>
                            <a href="/acceptance_reports/print/{{ report.AcceptanceReport.id }}.pdf"><i tooltip="Drukuj" class="fa fa-print large-icon pull-right"></i> </a>                        
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>
        <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="reports | filter:search | length" boundary-links="true"></pagination>
        
</div>

<?php echo $this->Metronic->portletEnd(); ?>

<?php echo $this->Html->script('angular/controllers/AcceptanceReportCtrl', array('block' => 'angular'))?>