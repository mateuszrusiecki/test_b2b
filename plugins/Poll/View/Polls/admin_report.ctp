<?php echo $this->Metronic->portlet('Lista ankiet'); ?>
<div>
    <div class="clearfix filter">
        <div class="col-lg-2 col-md-3 col-xs-12 col-sm-6 margin-bottom-10">
            <div class="input-icon right">
                <i class="icon-magnifier"></i>
                <input type="text" side="right" class="pull-left form-control form-control-inline" name="" placeholder="Szukaj">
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-12 margin-bottom-10">
            <div class="row">
                <div class="col-xs-6">
                    <div class="input-icon right">
                        <i class="icon-calendar"></i>
                        <input type="text" side="right" class="form-control form-control-inline" name="" placeholder="Data od">
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="input-icon right">
                        <i class="icon-calendar"></i>
                        <input  type="text" side="right" class="form-control form-control-inline"  name="" placeholder="Data do">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-scrollable">
        <table class="table table-striped table-bordered table-advance table-hover">
            <thead>
                <tr>
                    <th class='vertical-middle text-center hidden-md hidden-sm hidden-xs'>
                        #
                    </th>
                    <th class='vertical-middle'>
                        <i class="fa fa-user"></i> Klient
                    </th>
                    <th class='vertical-middle'>
                        <i class="fa fa-suitcase"></i> Projekt
                    </th>
                    <th class='vertical-middle'>
                        <i class="fa fa-comments"></i> Komentarz
                    </th>
                    <th class='vertical-middle'>
                        <i class="fa fa-star"></i> Ocena
                    </th>
                    <th class='vertical-middle'>
                        <i class="fa fa-star"></i> Kategorie budżetowe
                    </th>
                    <th class='vertical-middle'>
                        <i class="fa fa-cog"></i> Opcje
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class='vertical-middle text-center hidden-md hidden-sm hidden-xs'>
                        1
                    </td>
                    <td  class='vertical-middle'>
                        Jan Kowalski
                    </td>
                    <td  class='vertical-middle'>
                        RobimyOkna
                    </td>
                    <td  class='vertical-middle'>
                        Komnentarz
                    </td>
                    <td  class='vertical-middle'>
                        <div class="starOpinion">
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-grey font-large"></i>
                        </div>
                    </td>
                    <td>
                        Kategoria budżetowa 1
                        <div class="starOpinion">
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-grey font-large"></i>
                        </div>
                        Kategoria budżetowa 2
                        <div class="starOpinion">
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-grey font-large"></i>
                        </div>
                        Kategoria budżetowa 3
                        <div class="starOpinion">
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-grey font-large"></i>
                        </div>
                    </td>

                    <td  class='vertical-middle'>
                        <a class="" href="#">
                            <i tooltip="Podgląd" class="fa fa-link large-icon pull-right"></i> 
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class='vertical-middle text-center hidden-md hidden-sm hidden-xs'>
                        2
                    </td>
                    <td  class='vertical-middle'>
                        Adam Kowalski
                    </td>
                    <td  class='vertical-middle'>
                        RobimyOkna
                    </td>
                    <td  class='vertical-middle'>
                        Komnentarz
                    </td>
                    <td  class='vertical-middle'>
                        <div class="starOpinion">
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-grey font-large"></i>
                        </div>
                    </td>
                    <td>
                        Kategoria budżetowa 1
                        <div class="starOpinion">
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-grey font-large"></i>
                        </div>
                        Kategoria budżetowa 2
                        <div class="starOpinion">
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-yellow font-large"></i>
                            <i class="fa fa-star font-grey font-large"></i>
                        </div>
                    </td>

                    <td  class='vertical-middle'>
                        <a class="" href="#">
                            <i tooltip="Podgląd" class="fa fa-link large-icon pull-right"></i> 
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="profiles | candidates:search_user_id | filter:search | length" boundary-links="true"></pagination>
</div>
<?php echo $this->Metronic->portletEnd(); ?>

<?php echo $this->Metronic->portlet('Raport ankiet'); ?>
<div class="clearfix">
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <?php echo $this->Metronic->portlet('Ocena ogólna', 0, 'fa  fa-pie-chart', 'blue', 0); ?>
            <div class="portlet-body">
                <div id="chart_2_1" class="chart">
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                            <tr>
                                <th class='vertical-middle'>

                                </th>
                                <th class='vertical-middle'>
                                    <i class="fa fa-suitcase"></i> Liczba gwiazdek
                                </th>
                                <th>
                                    <i class="fa fa-pie-chart"></i> Wszystkich
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-yellow"></i>
                                </td>
                                <td>5 gwiazdek</td>
                                <td>
                                    5%
                                </td>
                            </tr>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-blue"></i>
                                </td>
                                <td>4 gwiazdki</td>
                                <td>
                                    20%
                                </td>
                            </tr>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-red"></i>
                                </td>
                                <td>3 gwiazdki</td>
                                <td>
                                    10%
                                </td>
                            </tr>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-green"></i>
                                </td>
                                <td>2 gwiazdki</td>
                                <td>
                                    45%
                                </td>
                            </tr>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-purple"></i>
                                </td>
                                <td>1 gwiazdka</td>
                                <td>
                                    20%
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <script type="text/javascript">
                var data = [];
                var series = 5;
                data[0] = {
                    label: " 5 gwiazdek",
                    data: 5,
                }
                data[1] = {
                    label: " 4 gwiazdki",
                    data: 20,
                }
                data[2] = {
                    label: " 3 gwiazdki",
                    data: 10,
                }
                data[3] = {
                    label: " 2 gwiazdki",
                    data: 45,
                }
                data[4] = {
                    label: " 1 gwiazdka",
                    data: 20,
                }
                $.plot($("#chart_2_1"), data, {
                    series: {
                        pie: {
                            innerRadius: 0.5,
                            show: true
                        }
                    }
                });</script>
            <?php echo $this->Metronic->portletEnd(); ?>
            <?php echo $this->Metronic->portlet('Kategoria budżetowa 2', 0, 'fa  fa-pie-chart', 'green', 0); ?>
            <div class="portlet-body">
                <div id="chart_2_2" class="chart">
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                            <tr>
                                <th class='vertical-middle'>

                                </th>
                                <th class='vertical-middle'>
                                    <i class="fa fa-suitcase"></i> Liczba gwiazdek
                                </th>
                                <th>
                                    <i class="fa fa-pie-chart"></i> Wszystkich
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-yellow"></i>
                                </td>
                                <td>5 gwiazdek</td>
                                <td>
                                    5%
                                </td>
                            </tr>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-blue"></i>
                                </td>
                                <td>4 gwiazdki</td>
                                <td>
                                    20%
                                </td>
                            </tr>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-red"></i>
                                </td>
                                <td>3 gwiazdki</td>
                                <td>
                                    10%
                                </td>
                            </tr>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-green"></i>
                                </td>
                                <td>2 gwiazdki</td>
                                <td>
                                    45%
                                </td>
                            </tr>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-purple"></i>
                                </td>
                                <td>1 gwiazdka</td>
                                <td>
                                    20%
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <script type="text/javascript">
                var data = [];
                var series = 5;
                data[0] = {
                    label: " 5 gwiazdek",
                    data: 5,
                }
                data[1] = {
                    label: " 4 gwiazdki",
                    data: 20,
                }
                data[2] = {
                    label: " 3 gwiazdki",
                    data: 10,
                }
                data[3] = {
                    label: " 2 gwiazdki",
                    data: 45,
                }
                data[4] = {
                    label: " 1 gwiazdka",
                    data: 20,
                }
                $.plot($("#chart_2_2"), data, {
                    series: {
                        pie: {
                            innerRadius: 0.5,
                            show: true
                        }
                    }
                });</script>
            <?php echo $this->Metronic->portletEnd(); ?>
        </div>
        <div class="col-md-6 col-xs-12">
            <?php echo $this->Metronic->portlet('Kategoria budżetowa 1', 0, 'fa  fa-pie-chart', 'yellow', 0); ?>
            <div class="portlet-body">
                <div id="chart_2_3" class="chart">
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                            <tr>
                                <th class='vertical-middle'>

                                </th>
                                <th class='vertical-middle'>
                                    <i class="fa fa-suitcase"></i> Liczba gwiazdek
                                </th>
                                <th>
                                    <i class="fa fa-pie-chart"></i> Wszystkich
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-yellow"></i>
                                </td>
                                <td>5 gwiazdek</td>
                                <td>
                                    5%
                                </td>
                            </tr>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-blue"></i>
                                </td>
                                <td>4 gwiazdki</td>
                                <td>
                                    20%
                                </td>
                            </tr>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-red"></i>
                                </td>
                                <td>3 gwiazdki</td>
                                <td>
                                    10%
                                </td>
                            </tr>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-green"></i>
                                </td>
                                <td>2 gwiazdki</td>
                                <td>
                                    45%
                                </td>
                            </tr>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-purple"></i>
                                </td>
                                <td>1 gwiazdka</td>
                                <td>
                                    20%
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <script type="text/javascript">
                var data = [];
                var series = 5;
                data[0] = {
                    label: " 5 gwiazdek",
                    data: 5,
                }
                data[1] = {
                    label: " 4 gwiazdki",
                    data: 20,
                }
                data[2] = {
                    label: " 3 gwiazdki",
                    data: 10,
                }
                data[3] = {
                    label: " 2 gwiazdki",
                    data: 45,
                }
                data[4] = {
                    label: " 1 gwiazdka",
                    data: 20,
                }
                $.plot($("#chart_2_3"), data, {
                    series: {
                        pie: {
                            innerRadius: 0.5,
                            show: true
                        }
                    }
                });</script>
            <?php echo $this->Metronic->portletEnd(); ?>
            <?php echo $this->Metronic->portlet('Kategoria budżetowa 3', 0, 'fa  fa-pie-chart', 'red', 0); ?>
            <div class="portlet-body">
                <div id="chart_2_4" class="chart">
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                            <tr>
                                <th class='vertical-middle'>

                                </th>
                                <th class='vertical-middle'>
                                    <i class="fa fa-suitcase"></i> Liczba gwiazdek
                                </th>
                                <th>
                                    <i class="fa fa-pie-chart"></i> Wszystkich
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-yellow"></i>
                                </td>
                                <td>5 gwiazdek</td>
                                <td>
                                    5%
                                </td>
                            </tr>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-blue"></i>
                                </td>
                                <td>4 gwiazdki</td>
                                <td>
                                    20%
                                </td>
                            </tr>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-red"></i>
                                </td>
                                <td>3 gwiazdki</td>
                                <td>
                                    10%
                                </td>
                            </tr>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-green"></i>
                                </td>
                                <td>2 gwiazdki</td>
                                <td>
                                    45%
                                </td>
                            </tr>
                            <tr>
                                <td class='vertical-middle'>
                                    <i class="fa fa-square font-purple"></i>
                                </td>
                                <td>1 gwiazdka</td>
                                <td>
                                    20%
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <script type="text/javascript">
                var data = [];
                var series = 5;
                data[0] = {
                    label: " 5 gwiazdek",
                    data: 5,
                }
                data[1] = {
                    label: " 4 gwiazdki",
                    data: 20,
                }
                data[2] = {
                    label: " 3 gwiazdki",
                    data: 10,
                }
                data[3] = {
                    label: " 2 gwiazdki",
                    data: 45,
                }
                data[4] = {
                    label: " 1 gwiazdka",
                    data: 20,
                }
                $.plot($("#chart_2_4"), data, {
                    series: {
                        pie: {
                            innerRadius: 0.5,
                            show: true
                        }
                    }
                });</script>
            <?php echo $this->Metronic->portletEnd(); ?>
        </div>
    </div>
</div>
<?php echo $this->Metronic->portletEnd(); ?>