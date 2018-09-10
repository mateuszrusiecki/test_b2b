
        <a href="#departmentsInvolvedDialog" data-toggle="modal" class="col-md-3 col-sm-6 col-xs-12 mb5" ng-click="getBudgetPopupData(<?php echo $clientProject['ClientProject']['id'] ?>)">
            <div class="dashboard-stat blue-madison"><div class="visual">
                    <i class="fa fa-users"></i>
                </div>

                <div class="details">
                    <div class="desc"><?php echo __d('public', 'DZIAŁY ZAANGAŻOWANE'); ?></div>
                </div><i class="fa fa-chevron-circle-right"></i>
            </div>
        </a>
        
            <div aria-hidden="false" role="departmentsInvolvedDialog" tabindex="-1" id="departmentsInvolvedDialog" class="modal fade ng-cloak" my-modal>
                <div class="modal-dialog modal-small">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h4 class="modal-title"><?php echo __d('public', 'Działy zaangażowane') ?></h4>
                        </div>

                        <div class="modal-body">
                            <div class="tile-body">
                                
                                <div class="portlet box green" ng-cloak ng-repeat="team in budget_popup_data" ng-hide="team.delete">

                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-users"></i>
                                            {{team.section.activity_name}}
                                        </div>

                                        <div class="tools">
                                            <a class="collapse" href="javascript:;"> </a> </i>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form">
                                            <div class="form-horizontal">
                                                <div class="form-row-seperated">
                                                    <div class="form-group" ng-cloak ng-repeat="payment in team.payments"  ng-hide="payment.delete">
                                                            <div class="col-md-6 mobile-mb5">
                                                                <textarea rows="1" class="form-control" ng-bind="payment.name" disabled="disabled"></textarea>
                                                            </div>
                                                            <div class="col-md-3 mobile-mb5">
                                                                <div class="input-group input-icon right">
                                                                    <label class="form-control" ng-bind="payment.time"></label><span class="input-group-addon">h</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-group input-icon right">
                                                                    <label class="form-control" ng-bind="payment.price"></label><span class="input-group-addon">zł</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <h4 class="pull-right">= {{payment.time * payment.price| formatPrice}} zł</h4>
                                                            </div>
                                                    </div>
                                                    <div class="form-group bufor_pozycji_budzetowej">
                                                            <div class="col-md-4">
                                                                <h4><?php echo __d('public', 'Bufor'); ?></h4>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-group input-icon right">
                                                                    <label class="form-control" ng-bind="team.section.buffer_percentage"></label><span class="input-group-addon">%</span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <h4>= {{((team.section.buffer_percentage || 0) / 100) * (team.payments | sumPaymentInTeam) | formatPrice}} zł</h4>
                                                            </div>
                                                    </div>
                                                    <div class="form-group marza_pozycji_budzetowej">
                                                            <div class="col-md-4">
                                                                <h4><?php echo __d('public', 'Marża') ?></h4>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="input-group input-icon right">
                                                                    <label class="form-control" ng-bind="team.section.margin_percentage = 1 * team.section.margin_percentage < 35?35:team.section.margin_percentage"></label>
                                                                    <span class="input-group-addon">%</span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <h4>= {{(((team.payments | sumPaymentInTeam) / ((100 - (team.section.margin_percentage || 0)))) * 100) - (team.payments | sumPaymentInTeam) | formatPrice}} zł</h4>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions bottom fluid">
                                                        <div class="row">
                                                            <div class="col-md-7">
                                                                <?php echo __d('public', 'Koszty pozycji budżetowej') ?>
                                                            </div>
                                                            <div class="col-md-5">
                                                                = {{ team.section.position_cost = (team.payments | sumPaymentInTeam) | formatPrice}} zł
                                                            </div>
                                                            <div class="col-md-7">
                                                                <?php echo __d('public', 'Wartość pozycji budżetowej') ?>
                                                            </div>
                                                            <div class="col-md-5">
                                                                = {{ team.section.position_value = (((team.payments | sumPaymentInTeam) / ((100 - (team.section.margin_percentage || 0)))) * 100) + (((team.section.buffer_percentage || 0) / 100) * (team.payments | sumPaymentInTeam)) | formatPrice }} zł
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn default" type="button" data-dismiss="modal"><?php echo __d('public', 'Zamknij') ?></button>
                        </div>
                    </div>
                </div>
            </div>