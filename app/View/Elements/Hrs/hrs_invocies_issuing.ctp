<div class="clearfix">
    <a href="#"  class="btn btn-sm yellow margin-bottom pull-right ml"><?php echo __d('public', 'Skanuj dokumenty'); ?></a>
    <a  ng-click="addProjectFiles = true;
        bodyHidden = true;
        input = {};"  class="btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier"><?php echo __d('public', 'Dodaj plik'); ?></a>
</div>
<div class="table-scrollable table-scrollable-borderless" ng-init="invoices = <?php echo a($invoices) ?>" ng-controller="InvoicesCtrl
        as iCtrl">
        <!--<pre>{{ invoices|json }}</pre>-->
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
                        <th sort by="order" reverse="reverse" class='vertical-middle center-lg' order="'ClientProject.id'"><i class="fa fa-briefcase"></i> <?php echo __d('public', 'Projekt') ?></th>
                        <th sort by="order" reverse="reverse" class='vertical-middle center-lg' order="'Client.name'"><i class="fa fa-user"></i> <?php echo __d('public', 'Kontrachent') ?></th>
                        <th sort by="order" reverse="reverse" class='vertical-middle center-lg' order="'Payment.name'"><i class="fa fa-user"></i> <?php echo __d('public', 'Płatność') ?></th>


                        <th class="vertical-middle hidden-xs">
                            <span class="display-cell vertical-middle" >
                                <i class="fa fa-calendar margin-right-5"></i> 
                            </span> 
                            <span class="display-cell vertical-middle"> 
                                <span sort by="order" reverse="reverse" order="'Invoice.created'"><?php echo __d('public', 'Data wystawienia') ?></span>
                                <span sort by="order" reverse="reverse" order="'Invoice.payment_date'"><?php echo __d('public', 'Data płatności') ?></span>
                            </span>
                        </th>

                        <th class="vertical-middle"><i class="fa fa-cog"></i> <?php echo __d('public', 'Opcje') ?></th>
                    </tr>
                </thead>
                <tbody ng-init="search.Invoice.type = 3">
                    <tr ng-cloak ng-repeat="invoice in invoices| filterHrFiles: invoicesFilter | orderBy:order:reverse | filter: search | pag:currentPageFiles ">
                        <td>
                            <i class="fa fa-file feb-icon fleft"></i> 
                            <span class="ml" > {{invoice.ClientProject.name}} </span>
                        </td>
                        <td><a href="/clients/view/{{invoice.Client.id}}" tooltip="<?php echo __d('public', 'Szczegóły klienta') ?>" target="_blank">{{invoice.Client.name}}</a></td>
                        <td>{{invoice.Payment.name}}</td>

                        <td class="hidden-xs">{{invoice.Invoice.created}} <br />{{invoice.Invoice.payment_date}}</td>


                        <td class="action"   >

<!--                            <a href="/hrs/make_invoice/{{invoice.Invoice.id}}" class="" data-toggle="modal" on-click="confirm()">
                                <i class="fa  fa-external-link large-icon pull-right" tooltip="<?php echo __d('public', 'Wystaw fakturę (zostanie wysłane powiadomenie do klienta - mail i sms)') ?>"></i> 
                            </a> -->

                            <a ng-if="invoice.Invoice.client_project_id" href="/client_projects/view/{{invoice.Invoice.client_project_id}}" class="" target="_blank">
                                <i class="fa fa-link large-icon pull-right" tooltip="<?php echo __d('public', 'Link do projektu') ?>"></i> 
                            </a> 
                            <a href="{{'/hrs/invoice_pdf/' + invoice.Invoice.id + '.pdf'}}" class="" target="_blank">
                                <i class="fa fa-file-pdf-o large-icon pull-right" tooltip="<?php echo __d('public', 'Podgląd pdf') ?>"></i> 
                            </a>  
                            <a ng-if="user_permission != 'client'" href="{{'/hrs/invoice/' + invoice.Invoice.id}}" class="" target="_blank">
                                <i class="fa fa-eye large-icon pull-right" tooltip="<?php echo __d('public', 'Szczególy faktury') ?>"></i> 
                            </a>  
                            <i class="fa fa-money large-icon relative pull-right font-red-flamingo" tooltip="<?php echo __d('public', 'Do windykacji') ?>" ng-if="invoice.Invoice.paid == 0 && (invoice.Invoice.payment_date < (date | date:'yyyy - MM - dd'))">  </i>

                        </td>
                    </tr>  

                </tbody>
            </table>
        </div>

    </div>
    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPageFiles" items-per-page="10" total-items="invoices| filterHrFiles: invoicesFilter | filter: search | length" boundary-links="true"></pagination>
</div>



<?php echo $this->Html->script('angular/controllers/InvoicesCtrl.js', array('block' => 'angular')); ?>