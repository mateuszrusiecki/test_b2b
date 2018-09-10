<?php //echo $this->element('angular/date_range')  ?>
<?php $this->Html->script('angular/controllers/CrmReportCtrl.js?v=' . rand(), array('block' => 'angular')); ?>
<div ng-controller="CrmReportCtrl">
    <?php echo $this->Metronic->portlet(__d('public', 'Filtr')); ?>
    <div >
        <div class="clearfix"></div>
        <div class="clearfix row">
            <form class="form ng-pristine ng-valid">
                <?php /**/ ?>
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <?php echo $this->Metronic->input('date_from', array('date-picker', 'ng-model' => 'input.date_from')); ?>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <?php echo $this->Metronic->input('date_to', array('date-picker', 'ng-model' => 'input.date_to')); ?>
                </div>
                <?php /** / ?>
                  <input type="text" date-range-picker ranged="true" ng-model="range" ng-cloak />
                  <?php /* */ ?>
                <?php
                if ($workers)
                {
                    ?>
                    <div class="col-md-12">
                        <label><?php echo __d('public', 'Lista pracowników'); ?></label>
                        <?php echo $this->Metronic->input('workers', array('multiple' => 'true', 'options' => $workers, 'ng-model' => 'input.workers')); ?>
                    </div>
                <?php } ?>
                <?php
                if (!empty($user_id))
                {
                    ?>
                    <div ng-init="input.workers = ['<?php echo $user_id; ?>']"></div>
                <?php }
                ?>

                <div id="create_report" class="btn btn-default" ng-click="worker_report()"><?php echo __d('public', 'Utwórz raport'); ?></div>

            </form>
        </div>
    </div>

    <?php echo $this->Html->css('/fonts/chouette_alorsregular.css', null, array('inline' => 'false')); ?>

    <?php echo $this->Metronic->portletEnd(); ?>

    <?php echo $this->Metronic->portlet(__d('public', 'Raporty')); ?>

    <div class="portlet-body ng-cloak" ng-show="report">
        <div class="tabbable-custom nav-justified">
            <ul class="nav nav-tabs nav-justified">
                <li class="active">
                    <a href="#report_1" data-toggle="tab">
                        <?php echo __d('public', 'Ogólnie'); ?> </a>
                </li>
                <li>
                    <a href="#report_2" data-toggle="tab">
                        <?php echo __d('public', 'Lejek sprzedaży'); ?> </a>
                </li>
                <li>
                    <a href="#report_3" data-toggle="tab">
                        <?php echo __d('public', 'Pozostałe'); ?> </a>
                </li>
            </ul>
            <!--BEGIN TABS-->
            <div class="tab-content">
                <div class="tab-pane active" id="report_1">
                    <div class="tiles">

                        <div class="tile double bg-red-sunglo notStandardTile">
                            <div class="tile-body">
                                <div class="number">{{report.count_client|| 0}}</div>
                            </div>
                            <div class="tile-object">
                                <div class="name">
                                    <?php echo __d('public', 'Nowi klienci'); ?>
                                </div>
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                        <div class="tile double bg-grey-cascade notStandardTile">
                            <div class="tile-body">
                                <div class="number">{{report.count_lead|| 0}}</div>
                            </div>
                            <div class="tile-object">
                                <div class="name">
                                    <?php echo __d('public', 'Nowe leady'); ?>
                                </div>
                                <i class="fa fa-suitcase"></i>
                            </div>
                        </div>
                        <div class="tile double bg-green notStandardTile">
                            <div class="tile-body">
                                <div class="number smaller">{{report.count_amount|| 0}} PLN</div>
                            </div>
                            <div class="tile-object">
                                <div class="name">
                                    <?php echo __d('public', 'Wartość otwartych interesów'); ?>
                                </div>
                                <i class="fa fa-dollar"></i>
                            </div>
                        </div>
                        <div class="tile double bg-blue-dark notStandardTile">
                            <div class="tile-body">
                                <div class="number smaller">{{report.count_lead_status_new|| 0}} PLN</div>
                            </div>
                            <div class="tile-object">
                                <div class="name">
                                    <?php echo __d('public', 'Wartość wygranych interesów'); ?>
                                </div>
                                <i class="fa fa-dollar"></i>
                            </div>
                        </div>
                        <div class="tile double bg-red-sunglo notStandardTile">
                            <div class="tile-body">
                                <div class="number smaller">{{report.count_lead_status_close|| 0}} PLN</div>
                            </div>
                            <div class="tile-object">
                                <div class="name">
                                    <?php echo __d('public', 'Wartość przegranych interesów'); ?>
                                </div>
                                <i class="fa fa-dollar"></i>
                            </div>
                        </div>

                        <form method="post" class="tile double bg-purple notStandardTile pointer" action="<?php echo $this->Html->url(array('action' => 'raport_xls', 'ext' => 'xlsx')); ?>" onclick="this.submit()">
                            <input name="data[date_from]" type="hidden" value="{{input.date_from}}"/>
                            <input name="data[date_to]" type="hidden" value="{{input.date_to}}"/>
                            <input name="data[user_id]" type="select" multiple class="hidden" ng-model="input.workers"/>
                            <div class="tile-body">
                                <div class="fa fa-bar-chart number"></div>
                            </div>
                            <div class="tile-object" >
                                <div class="name">
                                    <?php echo __d('public', 'Raport do pobrania'); ?>

                                </div>
                                <i class="fa fa-download"></i>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="report_2">
                    <div class="clearfix">
                        <?php echo $this->Metronic->portlet(__d('public', 'Lejek sprzedaży'), 0, 'fa  fa-bar-chart', 'purple', 0); ?>
                        <div class="portlet-body">
                            <div id="chart_1_1" class="chart">
                                <div ng-repeat="pipeline in report.pipeline">
                                    <div class="mt5 center">
                                        <span class="pull-right">{{pipeline.count}} leadów</span>
                                        {{pipeline.name}}
                                    </div>
                                    <div  style="height: 30px;  margin: auto; width: {{pipeline.width}}%" class="bg-yellow"></div>
                                </div>
                            </div>
                        </div>

                        <?php echo $this->Metronic->portletEnd(); ?>
                    </div>

                </div>
                <div class="tab-pane" id="report_3">
                    <div class="clearfix">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <?php echo $this->Metronic->portlet(__d('public', 'Kategorie leadów'), 0, 'fa  fa-pie-chart', 'blue', 0); ?>
                                <div class="portlet-body">
                                    <div id="pie_category" class="chart">
                                    </div>
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-bordered table-advance table-hover">
                                            <thead>
                                                <tr>
                                                    <th class='vertical-middle'  sort by="pie_category.order" reverse="pie_category.reverse" order="'name'">
                                                        <i class="fa fa-suitcase"></i> <?php echo __d('public', 'Kategoria'); ?>
                                                    </th>
                                                    <th class='vertical-middle' sort by="pie_category.order" reverse="pie_category.reverse" order="'count'">
                                                        <i class="fa fa-bar-chart"></i> <?php echo __d('public', 'Liczba'); ?>
                                                    </th>
                                                    <th sort by="pie_category.order" reverse="pie_category.reverse" order="'percent'">
                                                        <i class="fa fa-pie-chart"></i> <?php echo __d('public', 'Wszystkich'); ?>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="category in report.pie_category.leadCategories| orderBy:pie_category.order:pie_category.reverse | pag: pie_category.currentPage : 5">

                                                    <td>{{category.name}}</td>
                                                    <td>
                                                        {{category.count}}
                                                    </td>
                                                    <td>
                                                        {{category.percent}}%
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="pie_category.currentPage" items-per-page="5" total-items="report.pie_category.leadCategories.length" boundary-links="true"></pagination>
                                </div>
                                <?php echo $this->Metronic->portletEnd(); ?>
                                <?php echo $this->Metronic->portlet(__d('public', 'Sprzedaż/Klient'), 0, 'fa  fa-pie-chart', 'red', 0); ?>
                                <div class="portlet-body">
                                    <div id="pie_customer_sales" class="chart">
                                    </div>
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-bordered table-advance table-hover">
                                            <thead>
                                                <tr>
                                                    <th class='vertical-middle' sort by="pie_customer_sales.order" reverse="pie_customer_sales.reverse" order="'name'">
                                                        <i class="fa fa-suitcase"></i> <?php echo __d('public', 'Klient'); ?>
                                                    </th>
                                                    <th class='vertical-middle' sort by="pie_customer_sales.order" reverse="pie_customer_sales.reverse" order="'count'">
                                                        <i class="fa fa-bar-chart"></i> <?php echo __d('public', 'Liczba'); ?>
                                                    </th>
                                                    <th sort by="pie_customer_sales.order" reverse="pie_customer_sales.reverse" order="'sum'">
                                                        <i class="fa fa-pie-chart"></i> <?php echo __d('public', 'Wartość'); ?>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="client in report.pie_customer_sales.clients| orderBy:pie_customer_sales.order:pie_customer_sales.reverse | pag: pie_customer_sales.currentPage : 5">

                                                    <td>{{client.name}}</td>
                                                    <td>
                                                        {{client.count}}
                                                    </td>
                                                    <td>
                                                        {{client.sum}}
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="pie_customer_sales.currentPage" items-per-page="5" total-items="report.pie_customer_sales.clients.length" boundary-links="true"></pagination>
                                </div>

                                <?php echo $this->Metronic->portletEnd(); ?>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <?php echo $this->Metronic->portlet(__d('public', 'Kategorie leadów zamknietych'), 0, 'fa  fa-pie-chart', 'yellow', 0); ?>
                                <div class="portlet-body">
                                    <div id="pie_category_close" class="chart">
                                    </div>
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-bordered table-advance table-hover">
                                            <thead>
                                                <tr>
                                                    <th class='vertical-middle'  sort by="pie_category_close.order" reverse="pie_category_close.reverse" order="'name'">
                                                        <i class="fa fa-suitcase"></i> <?php echo __d('public', 'Kategoria'); ?>
                                                    </th>
                                                    <th class='vertical-middle' sort by="pie_category_close.order" reverse="pie_category_close.reverse" order="'count'">
                                                        <i class="fa fa-bar-chart"></i> <?php echo __d('public', 'Liczba'); ?>
                                                    </th>
                                                    <th sort by="pie_category_close.order" reverse="pie_category_close.reverse" order="'percent'">
                                                        <i class="fa fa-pie-chart"></i> <?php echo __d('public', 'Wszystkich'); ?>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="category in report.pie_category_close.leadCategories| orderBy:pie_category_close.order:pie_category_close.reverse | pag: pie_category_close.currentPage : 5">

                                                    <td>{{category.name}}</td>
                                                    <td>
                                                        {{category.count}}
                                                    </td>
                                                    <td>
                                                        {{category.percent}}%
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="pie_category_close.currentPage" items-per-page="5" total-items="report.pie_category_close.leadCategories.length" boundary-links="true"></pagination>

                                </div>

                                <?php echo $this->Metronic->portletEnd(); ?>
                                <?php echo $this->Metronic->portlet(__d('public', 'Kategorie leadów otwartych'), 0, 'fa  fa-pie-chart', 'green', 0); ?>
                                <div class="portlet-body">
                                    <div id="pie_category_open" class="chart">
                                    </div>
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-bordered table-advance table-hover">
                                            <thead>
                                                <tr>
                                                    <th class='vertical-middle'  sort by="pie_category_open.order" reverse="pie_category_open.reverse" order="'name'">
                                                        <i class="fa fa-suitcase"></i> <?php echo __d('public', 'Kategoria'); ?>
                                                    </th>
                                                    <th class='vertical-middle' sort by="pie_category_open.order" reverse="pie_category_open.reverse" order="'count'">
                                                        <i class="fa fa-bar-chart"></i> <?php echo __d('public', 'Liczba'); ?>
                                                    </th>
                                                    <th sort by="pie_category_open.order" reverse="pie_category_open.reverse" order="'percent'">
                                                        <i class="fa fa-pie-chart"></i> <?php echo __d('public', 'Wszystkich'); ?>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="category in report.pie_category_open.leadCategories| orderBy:pie_category_open.order:pie_category_open.reverse | pag: pie_category_open.currentPage : 5">

                                                    <td>{{category.name}}</td>
                                                    <td>
                                                        {{category.count}}
                                                    </td>
                                                    <td>
                                                        {{category.percent}}%
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="pie_category_open.currentPage" items-per-page="5" total-items="report.pie_category_open.leadCategories.length" boundary-links="true"></pagination>

                                </div>

                                <?php echo $this->Metronic->portletEnd(); ?>
                            </div>
                            <div class="col-xs-12">
                                <?php echo $this->Metronic->portlet(__d('public', 'Wartość podpisanych umów'), 0, 'fa  fa-pie-chart', 'purple', 0); ?>
                                <div class="portlet-body">
                                    <div id="graph_chart" class="chart">
                                    </div>
                                </div>

                                <?php echo $this->Metronic->portletEnd(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->Metronic->portletEnd(); ?>
</div>