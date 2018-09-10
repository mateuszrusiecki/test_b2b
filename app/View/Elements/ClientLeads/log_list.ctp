
<?php echo $this->Metronic->portlet(__d('public', 'Log'), 1); ?>
<?php // debug($emails_list)   ?>
<div  class="emails_list">

    <div class="log_type" ng-init="log_type = <?php echo htmlspecialchars(json_encode($log_type)); ?>"></div>

    <div class="col-md-6 col-xs-12 col-sm-6 margin-bottom-15">
        <div class="input-icon right">
            <i class="icon-magnifier"></i>
            <input type="text" placeholder="<?php echo __d('public', 'Wpisz tytuł maila') ?>" class="form-control" ng-model="search2">
        </div>
    </div>
	
    <table class="col-md-12" ng-init="log_list = <?php echo htmlspecialchars(json_encode($leadlogs)); ?>">

        <tr ng-cloak ng-repeat="log in log_list| filter:search2">
            <td>
                <table class="mail-content">
                    <tr ng-if="log.LeadLog.type_log_id != 'Email'">
                        <td class="mail-col">
                            <i class="fa fa-file feb-icon fleft"></i> 
                            <span class="mail-from"> {{ log.LeadLog.type_log_id}} </span>
                        </td>

                        <td>
                            <span class=" mail-subject">{{log.LeadLog.name}}</span>	
                            <span ng-if="log.Profile.firstname"><?php echo __d('public', ' przez:') ?>{{log.Profile.firstname + ' ' + log.Profile.surname}}</span>
                        </td>

                        <td class="mail-col">
                            {{log.LeadLog.created}}
                        </td>
                        <!--<a href="/clients/view/{{email.subject}}">{{email.subject}}</a>-->
                    </tr>

                    <tr ng-if="log.LeadLog.type_log_id == 'Email'" class="tr_mail">
                        <td class="mail-col">
                            <i class="fa fa-envelope feb-icon fleft"></i>
                            <span class="mail-from"> {{ log.LeadLog.type_log_id}} <?php echo __d('public', 'od'); ?>: {{log.LeadLog.from}} </span>
                        </td>
                        <td>
                            <span class=" mail-subject">{{log.LeadLog.subject}}</span>	
                        </td>
                        <td class="mail-col">{{log.LeadLog.created}}</td>
                    </tr>
                    <tr ng-if="log.LeadLog.type_log_id == 'Email'">
                        <td colspan="3">
                            <a class="show_mail_pre">
                                <span ng-click="showMailPre = !showMailPre" ng-show="!showMailPre">(<?php echo __d('public', 'Pokaż treść') ?>)</span>
                                <span ng-click="showMailPre = !showMailPre" ng-show="showMailPre" >(<?php echo __d('public', 'Ukryj') ?>)</span>
                            </a>

                            <div class="email_message" ng-if="showMailPre">
                                <pre class="mail-pre" ng-bind-html="log.LeadLog.message | mailhtmldecode"> </pre>
                            </div>
                        </td>
                    </tr>

<!--						<tr>
        <td colspan="3" ><pre class="mail-pre" ng-bind="log.LeadLog.message|htmldecode" ng-show="showMailPre"> </pre></td>
</tr>-->
                </table>
            </td>
        </tr>
    </table>
</div>

<?php echo $this->Metronic->portletEnd(); ?>
