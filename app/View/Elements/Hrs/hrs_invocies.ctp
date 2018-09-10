<div class="table-scrollable table-scrollable-borderless" ng-init="invoices<?php echo $type ?> = <?php echo a($invoices) ?>" ng-controller="InvoicesCtrl as iCtrl">
    <div class="clearfix filter">

        <div class="col-lg-2 col-md-3 col-xs-12 col-sm-6 margin-bottom-10">
            <div class="input-icon right">
                <i class="icon-magnifier"></i>
                <input ng-model="invoicesFilter.search" type="text" side="right" class="pull-left form-control form-control-inline" name="" placeholder="<?php echo __d('public', 'Szukaj') ?>">
            </div>
        </div>


        <div class="col-lg-3 col-md-4 col-xs-12 margin-bottom-10">
            <div class="row">
                <div class="col-xs-6">
                    <div class="input-icon right">
                        <i class="icon-calendar"></i>
                        <input ng-disabled="invoicesFilter.data_last" ng-model="invoicesFilter.data_from" type="text" side="right" class="form-control form-control-inline" date-picker name=""  placeholder="<?php echo __d('public', 'Data od') ?>">
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="input-icon right">
                        <i class="icon-calendar"></i>
                        <input  ng-disabled="invoicesFilter.data_last" ng-model="invoicesFilter.data_to" type="text" side="right" class="form-control form-control-inline" date-picker name=""  placeholder="<?php echo __d('public', 'Data do') ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-xs-12 col-sm-6">
            <div class="row">
                <div class="col-xs-12">
                    <span ng-click="invoicesFilter.data_last = (invoicesFilter.data_last == 1) ? 0 : 1" ng-class="{'btn-primary':invoicesFilter.data_last == 1,'default':invoicesFilter.data_last !== 1}" class="poitnier btn btn-sm   margin-bottom pull-left"><?php echo __d('public', 'Dzisiaj'); ?></span>
                    <span ng-click="invoicesFilter.data_last = (invoicesFilter.data_last == 7) ? 0 : 7" ng-class="{'btn-primary':invoicesFilter.data_last == 7,'default':invoicesFilter.data_last !== 7}"  class="poitnier btn btn-sm margin-bottom pull-left ml"><?php echo __d('public', '7 dni'); ?></span>
                    <span ng-click="invoicesFilter.data_last = (invoicesFilter.data_last == 30) ? 0 : 30" ng-class="{'btn-primary':invoicesFilter.data_last == 30,'default':invoicesFilter.data_last !== 30}"  class="poitnier btn btn-sm margin-bottom pull-left ml"><?php echo __d('public', '30 dni'); ?></span>
                </div>
            </div>
        </div>
    </div>

    <div  class="portlet-body">            
        <div class="table-scrollable">
            <table class="table table-striped table-bordered table-advance table-hover">
                <thead>
                    <tr>
                        <th sort by="order" reverse="reverse" class='vertical-middle center-lg' order="'Invoice.invoice_nr'"><i class="fa fa-briefcase"></i> <?php echo __d('public', 'Numer dokumentu') ?></th>
                        <th ng-if="user_permission != 'client'" sort by="order" reverse="reverse" class='vertical-middle center-lg' order="'Client.name'"><i class="fa fa-user"></i> <?php echo __d('public', 'Kontrachent') ?></th>
                        <th class="vertical-middle"><i class="fa fa-navicon"></i>  <?php echo __d('public', 'Pozycje') ?></th>

                        <th class="vertical-middle hidden-xs">
                            <span class="display-cell vertical-middle" >
                                <i class="fa fa-calendar margin-right-5"></i> 
                            </span> 
                            <span class="display-cell vertical-middle"> 
                                <span sort by="order" reverse="reverse" order="'Invoice.created'"><?php echo __d('public', 'Data wystawienia') ?></span>
                                <span sort by="order" reverse="reverse" order="'Invoice.payment_date'"><?php echo __d('public', 'Data płatności') ?></span>
                            </span>
                        </th>
                        <th class="vertical-middle">
                            <span class="display-cell vertical-middle">
                                <i class="fa fa-dollar margin-right-5"></i> 
                            </span> 
                            <span class="display-cell vertical-middle"> 
                                <span sort by="order" reverse="reverse" order="'Invoice.net_price'"><?php echo __d('public', 'Netto') ?></span>
                                <span sort by="order" reverse="reverse" order="'Invoice.gross_price'"><?php echo __d('public', 'Brutto') ?></span>
                            </span>
                        </th>
                        <th class="vertical-middle hidden-xs">
                            <span class="display-cell vertical-middle">
                                <i class="fa fa-ticket margin-right-5"></i>
                            </span> 
                            <span class="display-cell vertical-middle"> 
                                <span sort by="order" reverse="reverse" order="'Invoice.vat_rate'"><?php echo __d('public', 'Stawka VAT') ?></span>
                                <span sort by="order" reverse="reverse" order="'Invoice.vat_amount'"><?php echo __d('public', 'Kwota VAT') ?></span>
                            </span>
                        </th>
                        <th class="vertical-middle" sort by="order" reverse="reverse" order="'Invoice.paid'">
                            <i class="fa fa-question"></i> <?php echo __d('public', 'Status') ?>
                        </th>
                        <th class="vertical-middle"><i class="fa fa-cog"></i> <?php echo __d('public', 'Opcje') ?></th>
                    </tr>
                </thead>
                <tbody ng-init="search<?php echo $type ?>.Invoice.type =<?php echo $type ?>">
                    <tr ng-cloak ng-repeat="invoice in invoices<?php echo $type ?>| filterHrFiles: invoicesFilter | filter: search<?php echo $type ?> | orderBy:order:reverse | pag:currentPageFiles<?php echo $type ?> ">
                        <td>
                            <i class="fa fa-file feb-icon fleft"></i> 
                            <span class="ml" > {{invoice.Invoice.invoice_nr}} </span>
                        </td>
                        <td ng-if="user_permission != 'client'"><a href="/clients/view/{{invoice.Client.id}}" tooltip="<?php echo __d('public', 'Szczegóły klienta') ?>" target="_blank">{{invoice.Client.name}}</a></td>
                        <td>
                            <a href="" class="" ng-click="showInvoice = true; $parent.bodyHidden = true;">
                                <i class="fa fa-list-ul large-icon" tooltip="<?php echo __d('public', 'Pozycje na fakturze') ?>"></i>
                            </a>

                            <div ng-cloak class="modal-backdrop fade in ng-cloak" ng-show="showInvoice"></div>
                            <div ng-cloak aria-hidden="true" tabindex="-1" ng-show="showInvoice" class="add_project_file_ajax angular-modal ng-cloak">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button aria-hidden="true" ng-click="showInvoice = false; bodyHidden = false;" class="close" type="button"><?php echo __d('public', 'Zamknij') ?></button>
                                            <h4 class="modal-title"><?php echo __d('public', 'Pozycje na fakturze'); ?>:</h4>
                                        </div>
                                        <div class="modal-body">

                                            <div class="table-scrollable">
                                                <table class="table table-striped table-bordered table-advance table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="vertical-middle"><i class="fa fa-suitcase"></i> <?php echo __d('public', 'Nazwa'); ?></th>
                                                            <th class="vertical-middle">
                                                                <span class="display-cell vertical-middle">
                                                                    <i class="fa fa-info margin-right-5"></i> 
                                                                </span> 
                                                                <span class="display-cell vertical-middle"> 
                                                                    <?php echo __d('public', 'PKWiU'); ?><br /><?php echo __d('public', 'Jm.'); ?>
                                                                </span>
                                                            </th>
                                                            <th class="vertical-middle">
                                                                <span class="display-cell vertical-middle">
                                                                    <i class="fa fa-cubes margin-right-5"></i> 
                                                                </span> 
                                                                <span class="display-cell vertical-middle"> 
                                                                    <?php echo __d('public', 'Ilość'); ?><br /><?php echo __d('public', 'Cena jed. netto'); ?>
                                                                </span>
                                                            </th>
                                                            <th class="vertical-middle">
                                                                <span class="display-cell vertical-middle">
                                                                    <i class="fa fa-ticket margin-right-5"></i> 
                                                                </span> 
                                                                <span class="display-cell vertical-middle"> 
                                                                    <?php echo __d('public', 'Stawka VAT'); ?><br /><?php echo __d('public', 'Kwota VAT'); ?>
                                                                </span>
                                                            </th>
                                                            <th class="vertical-middle">
                                                                <span class="display-cell vertical-middle">
                                                                    <i class="fa fa-dollar margin-right-5"></i> 
                                                                </span> 
                                                                <span class="display-cell vertical-middle"> 
                                                                    <?php echo __d('public', 'Netto'); ?><br /><?php echo __d('public', 'Brutto'); ?>
                                                                </span>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr ng-cloak ng-repeat="invoice_position in invoice.InvoicePosition">
                                                            <td>{{ invoice_position.name}}</td>
                                                            <td>{{ invoice_position.symbol}}<br />{{ invoice_position.jm}}</td>
                                                            <td>{{ invoice_position.quantity}}<br />{{ invoice_position.unit_price}}zł</td>
                                                            <td>{{ invoice_position.tax}}%<br />{{ invoice_position.tax_value}}zł</td>
                                                            <td>{{ invoice_position.net_value}}zł<br />{{ invoice_position.gross_value}}zł</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button ng-click="showInvoice = false; bodyHidden = false;" class="btn default" type="button"><?php echo __d('public', 'Zamknij') ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                        <td class="hidden-xs">{{invoice.Invoice.created}} <br />{{invoice.Invoice.payment_date}}</td>
                        <td>{{invoice.Invoice.net_price}} zł<br />{{invoice.Invoice.gross_price}} zł</td>
                        <td class="hidden-xs">{{invoice.Invoice.vat_rate}}% <br />{{invoice.Invoice.vat_amount}} zł</td>
                        <td>
                            <i class="fa fa-money relative font-red-haze" ng-if="invoice.Invoice.paid == 0" tooltip="<?php echo __d('public', 'Faktura nie opłacona') ?>"> <span class="through"></span> </i>
                            <i class="fa fa-money relative font-green-haze" ng-if="invoice.Invoice.paid == 1" tooltip="<?php echo __d('public', 'Faktura opłacona') ?>"></i>
                        </td>

                        <td class="action">

                            <a  ng-if="user_permission != 'client'"  ng-click="invoiceDescription(invoice.Invoice)" class="pointer" data-toggle="modal" href="#basic">
                                <i class="fa fa-pencil-square  large-icon pull-right" tooltip="<?php echo __d('public', 'Edytuj opis faktury') ?>"></i> 
                            </a>

                            <a ng-if="!invoice.Invoice.client_project_id" ng-click="invoiceDescription(invoice.Invoice.id)" data-toggle="modal" href="#link_invoice_to_project" class="">
                                <i class="fa fa-plus-square  large-icon pull-right" tooltip="<?php echo __d('public', 'Przypisz do projektu') ?>"></i> 
                            </a>  

<!--                            <a href="{{'/hrs/invoice/' + invoice.Invoice.id + '.pdf'}}" class="" target="_blank">
                                <i class="fa fa-print large-icon pull-right" tooltip="<?php //echo __d('public', 'Drukuj') ?>"></i> 
                            </a>  -->

                            <a href="{{'hrs/invoice/' + invoice.Invoice.id + '/1.pdf'}}" class="">
                                <i class="fa fa-download large-icon pull-right" tooltip="<?php echo __d('public', 'Pobierz') ?>"></i> 
                            </a>  

                            <a ng-if="user_permission != 'client'" href="{{'/hrs/invoice_pdf/' + invoice.Invoice.id + '.pdf'}}" class="" target="_blank">
                                <i class="fa fa-eye large-icon pull-right" tooltip="<?php echo __d('public', 'Podgląd pdf') ?>"></i> 
                            </a>  
                            <a ng-if="invoice.Invoice.client_project_id" href="/client_projects/view/{{invoice.Invoice.client_project_id}}" class="" target="_blank">
                                <i class="fa fa-link large-icon pull-right" tooltip="<?php echo __d('public', 'Link do projektu') ?>"></i> 
                            </a> 
                            <i class="fa fa-money large-icon relative pull-right font-red-flamingo" tooltip="<?php echo __d('public', 'Do windykacji') ?>" ng-if="invoice.Invoice.paid == 0 && (invoice.Invoice.payment_date < (date | date:'yyyy - MM - dd'))">  </i>

<!--                            <a ng-if="invoice.Invoice.paid == 0 && user_permission != 'client'" href="{{'/hrs/mark_invoice_as_paid/' + invoice.Invoice.id}}" class="">
                                <i class="fa fa-money large-icon pull-right" tooltip="<?php echo __d('public', 'Oznacz fakturę jako zapłaconą (klient otrzyma poiwadomienie email oraz sms)') ?>"></i> 
                            </a>  -->
                        </td>
                    </tr>  

                </tbody>
            </table>
        </div>

    </div>
    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPageFiles<?php echo $type ?>" items-per-page="10" total-items="invoices<?php echo $type ?> | filterHrFiles: invoicesFilter  | filter: search<?php echo $type ?> | length" boundary-links="true"></pagination>
</div>


                            <a href="{{'/fronts/synchronize_optima_invoices/'}}" class="btn blue-madison pull-right">
                                <?php echo __d('public', 'Synchronizuj faktury') ?>
                            </a>  


<?php echo $this->Html->script('angular/controllers/InvoicesCtrl.js', array('block' => 'angular')); ?>