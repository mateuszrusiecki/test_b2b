<?php echo $this->Metronic->portlet(__d('public', 'Monitorowanie aktywności użytkowników')); ?>	

<div ng-controller="UserActivityCtrl">
    <div class="clearfix">
        <div class="col-lg-3 col-md-4 col-xs-12 col-sm-6 margin-bottom-10">
            <div class="input-icon right">
                <i class="icon-magnifier"></i>
                <input 
                    type="text" 
                    ng-model="search_project" 
                    ng-keyup="currentPage =1" 
                    class="pull-left form-control form-control-inline ng-pristine ng-valid ng-touched" 
                    placeholder="<?php echo __d('public', 'Szukaj') ?>..."
                    >
            </div>
        </div>
    </div>


    <div class="table-scrollable">
        <table class="table table-striped table-bordered table-advance table-hover projectTable">
            <thead>
                <tr>
                    <th  sort by="order" reverse="reverse" order="'type'">
                        <i class="fa fa-info-circle"></i> <?php echo __d('public', 'Zdarzenie') ?>
                    </th>
                    <th  sort by="order" reverse="reverse" order="'name'">
                        <i class="fa fa-briefcase"></i> <?php echo __d('public', 'Nazwa') ?>
                    </th>
                    <th  sort by="order" reverse="reverse" order="'user'">
                        <i class="fa fa-user"></i> <?php echo __d('public', 'Użytkownik/login') ?>
                    </th>
                    <th sort by="order" reverse="reverse" order="'date'">
                        <i class="fa fa-calendar"></i> <?php echo __d('public', 'Data') ?>
                    </th>

                </tr>
            </thead>
            <tbody>


                <tr ng-cloak ng-repeat="project_log in all_logs| pag: currentPage : 20 | filter:search_project | orderBy:order:reverse">
                    <td>
                        <i title="<?php echo __d('public', 'Zmiany w projekcie'); ?>" ng-if="project_log.model == 'ClientProjectLog'" class="fa fa-briefcase cursor-help"></i>
                        <i title="<?php echo __d('public', 'Zmiany w leadzie'); ?>" ng-if="project_log.model == 'LeadLog'" class="icon-layers cursor-help"></i>
                        <i title="<?php echo __d('public', 'Zmiany użytkowników'); ?>" ng-if="project_log.model == 'UsersLog'" class="fa fa-users cursor-help"></i>
                        {{project_log.type}}
                    </td>
                    <td ng-bind="project_log.name"></td>
                    <td ng-bind="project_log.user"></td>
                    <td ng-bind="project_log.date"></td>
                </tr>


            </tbody>
        </table>
    </div>


    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="20" total-items="all_logs |  filter:search_project | length" boundary-links="true"></pagination>
</div>

<?php echo $this->Metronic->portletEnd(); ?>


<?php echo $this->Html->script('angular/controllers/UserActivityCtrl', array('block' => 'angular')); ?>
<?php echo $this->Html->css('/fonts/chouette_alorsregular.css', null, array('inline' => 'false')); ?>