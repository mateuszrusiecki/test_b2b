
<a href="#budgetDialog" data-toggle="modal" class="col-md-3 col-sm-6 col-xs-12 mb5" ng-click="getBudgetPopupData(<?php echo $clientProject['ClientProject']['id'] ?>)">
    <div class="dashboard-stat purple-plum">
        <div class="visual">
            <i class="fa fa-dollar"></i>
        </div>
        <div class="details">
            <div class="desc"><?php echo __d('public', 'BUDŻET'); ?></div>
        </div>
        <i class="fa fa-chevron-circle-right"></i>
    </div>
</a>



<div aria-hidden="false" role="budgetDialog" tabindex="-1" id="budgetDialog" class="modal fade ng-cloak" my-modal>
    <div class="modal-dialog modal-small">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title"><?php echo __d('public', 'Budżet projektu') ?></h4>
            </div>

            <div class="modal-body">
                <div class="tile-body">

                    <div class="row" ng-cloak>
                        <div class=" col-md-6 col-xs-12 mb5">
                            <div class="dashboard-stat blue-madison">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number" style="font-size:{{sumPrice| fontSize}}px">
                                        {{budget_popup_data| sumPaymentInAll | formatPrice}} zł
                                    </div>
                                    <div class="desc">
                                        <?php echo __d('public', 'Koszty projektowe'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-6 col-xs-12 mb5">
                            <div class="dashboard-stat purple-plum">
                                <div class="visual">
                                    <i class="fa fa-history"></i>
                                </div>
                                <div class="details">
                                    <div class="number"  style="font-size:{{sumPrice| fontSize}}px">
                                        {{budget_popup_data| sumBufferInAll | formatPrice}} zł
                                    </div>
                                    <div class="desc">
                                        <?php echo __d('public', 'Bufor'); ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="  col-md-6 col-xs-12 mb5">
                            <div class="dashboard-stat green-haze">
                                <div class="visual">
                                    <i class="fa fa-usd"></i>
                                </div>
                                <div class="details">
                                    <div class="number"  style="font-size:{{sumPrice| fontSize}}px">
                                        {{budget_popup_data| sumMarginInAll | formatPrice}} zł
                                    </div>
                                    <div class="desc">
                                        <?php echo __d('public', 'Marża'); ?>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="  col-md-6 col-xs-12 mb5">
                            <div class="dashboard-stat red-intense">
                                <div class="visual">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <div class="details">
                                    <div class="number"  style="font-size:{{sumPrice| fontSize}}px">
                                        {{
                                                    sumPrice = (budget_popup_data | sumPaymentInAll) + (budget_popup_data | sumMarginInAll) + (budget_popup_data | sumBufferInAll) | formatPrice
                                        }} zł
                                    </div>
                                    <div class="desc">
                                        <?php echo __d('public', 'Do zapłaty'); ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>     
                  
                    <p>Uwagi</p>
                    <p><?php echo $clientProject['ClientProject']['notes'] ?></p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn default" type="button" data-dismiss="modal"><?php echo __d('public', 'Zamknij') ?></button>
            </div>
        </div>
    </div>
</div>