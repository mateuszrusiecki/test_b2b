
<div  class="emails_list">

    <div class="log_type" ng-init="log_type = {} <?php //echo htmlspecialchars(json_encode($log_type));   ?>"></div>

    <form class="form col-md-6 col-xs-12">
        <div class="form-body">
            <div class="form-group">
                <div class="input-icon right">
                    <i class="icon-magnifier"></i>
                    <input type="text" placeholder="<?php echo __d('public', 'Szukaj') ?>" class="form-control " ng-model="search2">
                </div>
            </div>
        </div>
    </form>
    <div class="table-scrollable table-scrollable-borderless">
        <table class="table-striped table-hover col-xs-12 ng-cloak" ng-init="log_list = <?php echo htmlspecialchars(json_encode($projectlogs)); ?>" ng-cloak>

            <tr ng-cloak ng-repeat="log in log_list|  sectionFilter:section | filter:search2|orderBy:'ClientProjectLog.created':true | pag:currentLogPag:15">
                <td>
                    <table class="mail-content">
                        <tr ng-if="log.ClientProjectLog.type_log_id != 'Email'">
                            <td class="mail-col">
                                <i class="fa fa-file feb-icon fleft"></i> 
                                <span class="mail-from"> {{ log.ClientProjectLog.type_log_id}} </span>
                            </td>
						
                            <td>
                                <span class=" mail-subject">{{log.ClientProjectLog.name}}</span>	
                                <br/><span><?php echo __d('public', ' przez:') ?> {{log.Profile.firstname}} {{log.Profile.surname}}</span>

                            </td>

                            <td class="mail-col">
                                {{log.ClientProjectLog.created}}
                            </td>
                            <!--<a href="/clients/view/{{email.subject}}">{{email.subject}}</a>-->
                        </tr>

                        <tr ng-if="log.ClientProjectLog.type_log_id == 'Email'" class="tr_mail">
                            <td class="mail-col">
                                <i class="fa fa-envelope feb-icon fleft"></i>
                                <span class="mail-from"> {{ log.ClientProjectLog.type_log_id}} <?php echo __d('public', 'od'); ?>: {{log.ClientProjectLog.from}} </span>
                            </td>
                            <td>
                                <span class=" mail-subject">{{log.ClientProjectLog.subject}}</span>	
                            </td>
                            <td class="mail-col">{{log.ClientProjectLog.created}}</td>
                        </tr>
                        <tr ng-if="log.ClientProjectLog.type_log_id == 'Email'">
                            <td colspan="3">
                                <a class="show_mail_pre">
                                    <span ng-click="showMailPre = !showMailPre" ng-show="!showMailPre">(<?php echo __d('public', 'Pokaż treść') ?>)</span>
                                    <span ng-click="showMailPre = !showMailPre" ng-show="showMailPre" >(<?php echo __d('public', 'Ukryj') ?>)</span>
                                </a>

                                <div class="email_message" ng-show="showMailPre">
                                    <pre class="mail-pre" ng-bind-html="log.ClientProjectLog.message | mailhtmldecode"> </pre>
                                </div>
                            </td>
                        </tr>

<!--						<tr>
        <td colspan="3" ><pre class="mail-pre" ng-bind="log.ClientProjectLog.message|htmldecode" ng-show="showMailPre"> </pre></td>
</tr>-->
                    </table>
                </td>
            </tr>
        </table>
        <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentLogPag" items-per-page="15" total-items="log_list|  sectionFilter:section | filter:search2 | length" boundary-links="true"></pagination>

    </div>
</div>

