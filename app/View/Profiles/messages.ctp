<?php echo $this->Metronic->portlet(__d('public','Lista powiadomień')); ?>
<div ng-controller="MessagesCtrl">
    <div class="table-scrollable table-scrollable-borderless">
        <div class="clearfix filter">
            <div class="col-lg-2 col-md-3 col-xs-12 col-sm-6 margin-bottom-10">
                <div class="input-icon right">
                    <i class="icon-magnifier"></i>
                    <input type="text" side="right" ng-model="search" class="pull-left form-control form-control-inline" name="" placeholder="<?php echo __d('public', 'Szukaj') ?>">
                </div>
            </div>
        </div>
        <div  class="portlet-body">            
            <div class="table-scrollable">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>

                    <th sort by="order" reverse="reverse" order="'Message.body'" class='vertical-middle center-lg'>
                        <i class="fa fa-briefcase"></i> 
                        <?php echo __d('public', 'Komunikat'); ?>
                    </th>
                    <th sort by="order" reverse="reverse" order="'Message.received'" class='vertical-middle center-lg'>
                        <i class="fa fa-calendar"></i> 
                        <?php echo __d('public', 'Otrzymano'); ?>
                    </th>
                    </thead>
                    <tbody>
                        <tr ng-class="{'list-group-item-success' : message.Message.message_type_id == 1, 'list-group-item-warning' : message.Message.message_type_id == 2, 'list-group-item-danger' : message.Message.message_type_id == 3}" ng-cloak ng-repeat="message in messages| filter:search | orderBy:order:reverse | pag: currentPage : 10">
                            <td >
                                <a ng-if="message.Message.link" href="{{message.Message.link}}">
                                    <i class="fa font-large fa-chain"></i>
                                </a>
                                <span ng-bind-html="parse(message.Message.body)"></span>
                            </td>
                            <td>
                                {{message.Message.received}}
                            </td>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="messages | filter:search | length" boundary-links="true"></pagination>
</div>
<?php echo $this->Metronic->portletEnd(); ?>