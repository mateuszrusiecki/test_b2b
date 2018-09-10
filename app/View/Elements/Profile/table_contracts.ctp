<div ng-controller="ContractsCtrl">
    <div ng-bind="message"></div>
    <div class="clearfix row">
        <div class="col-md-3 col-sm-4 col-xs-12">
            <form class="form ng-pristine ng-valid">
                <div class="form-body">
                    <div class="form-group">
                        <div class="input-icon right">
                            <i class="icon-magnifier"></i>
                            <input type="text" ng-model="search" class="form-control ng-pristine ng-valid ng-touched" placeholder="<?php echo __d('public', 'Szukaj') ?>">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
        
    <div ng-hide="typeTable">
        <div class="table-scrollable">
            <table class="table table-striped table-bordered table-advance table-hover">
                <thead>
                    <tr>
                        <th sort by="order" reverse="reverse" order="'UserContractHistory.id'" class='vertical-middle text-center hidden-md hidden-sm hidden-xs'>
                            #
                        </th>
                        <th sort by="order" reverse="reverse" order="'UserContractHistory.contract_name'" class='vertical-middle'> 
                            <i class="fa fa-tag"></i> <?php echo __d('public', 'Nazwa umowy') ?>
                        </th>
                        <th sort by="order" reverse="reverse" order="'UserContractHistory.state'" class='vertical-middle'> 
                            <i class="fa fa-suitcase"></i><?php echo __d('public', 'Rodzaj umowy') ?> 
                        </th>
                        <th sort by="order" reverse="reverse" order="'UserContractHistory.created'" class='vertical-middle hidden-xs'> 
                            <i class="fa fa-calendar"></i> <?php echo __d('public', 'Data dodania') ?>
                        </th>
                        <th class='vertical-middle'>
                            <span class='display-cell vertical-middle'>
                                <i class="fa fa-calendar margin-right-5"></i> 
                            </span> 
                            <span class="display-cell vertical-middle"> 
                                <span sort by="order" reverse="reverse" order="'UserContractHistory.employment_start'"><?php echo __d('public', 'Data rozpoczęcia') ?></span>
                                <span sort by="order" reverse="reverse" order="'UserContractHistory.employment_end'"><?php echo __d('public', 'Data zakończenia') ?></span>
                            </span>                            
                        </th>
                        <th sort by="order" reverse="reverse" order="'UserContractHistory.contract_active'" class='vertical-middle'> 
                            <i class="fa fa-square"></i> <?php echo __d('public', 'Stan') ?>
                        </th>
                        <th class='vertical-middle'>
                            <i class="fa fa-cog"></i> <?php echo __d('public', 'Opcje') ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-cloak ng-repeat="contract in contracts| filter:search | orderBy:order:reverse | pag: currentPage : 10">
                        <td class='vertical-middle text-center hidden-md hidden-sm hidden-xs'>
                            {{contract.UserContractHistory.id}}  
                        </td>
                        <td class='vertical-middle' ng-class="!isContractActive(contract.UserContractHistory.employment_start, contract.UserContractHistory.employment_end) ? 'font-red' : ''">
                            {{contract.UserContractHistory.contract_name}}
                        </td>
                        <td class='vertical-middle'>
                            {{contract.UserContractHistory.state | ucfirst}}
                            {{contract.UserContractHistory.working_time}}
                        </td>
                        <td class='vertical-middle hidden-xs'>
                            {{getDateFromDateTime(contract.UserContractHistory.created)}}
                        </td>
                        <td class='vertical-middle'>
                            {{contract.UserContractHistory.employment_start}}<br />
                            {{contract.UserContractHistory.employment_end}}
                        </td>
                        <td class='vertical-middle text-center'>
                            <div ng-if="contract.UserContractHistory.contract_active">
                                <i class="fa fa-check-square font-green" tooltip="<?php echo __d('public', 'Zatrudniony') ?>"></i>
                            </div>
                            <div ng-if="!contract.UserContractHistory.contract_active">
                                <i class="fa fa-minus-square font-red" tooltip="<?php echo __d('public', 'Umowa nieaktualna') ?>"></i>
                            </div>
                        </td>
                        <td class='action vertical-middle text-right'>
                            <a href="#" class="">
                                <i class="fa fa-pencil-square  large-icon pull-right" tooltip="<?php echo __d('public', 'Edycja') ?>"></i> 
                            </a>  
                            <a href="#" class="">
                                <i class="fa fa-eye large-icon pull-right" tooltip="<?php echo __d('public', 'Podgląd') ?>"></i> 
                            </a>  
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="contracts | filter:search | length" boundary-links="true"></pagination>
</div>

<?php echo $this->Html->css('/fonts/chouette_alorsregular.css', null, array('inline' => 'false')); ?>