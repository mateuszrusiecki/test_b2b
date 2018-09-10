

<div ng-init="payments = <?php echo empty($payments)?'[]':a($payments); ?>"></div>

<table class="table table-striped table-bordered table-advance table-hover">
    <thead>
        <tr>
            <th  sort by="order" reverse="reverse" order="'name'">
                <i class="fa fa-briefcase"></i> <?php echo __d('public', 'Nazwa') ?>
            </th>
            <th  sort by="order" reverse="reverse" order="'start_project'">
                <i class="fa fa-arrow-right"></i> <?php echo __d('public', 'Data płatności') ?>
            </th>
            <th sort by="order" reverse="reverse" order="'end_project'">
                <i class="fa fa-arrow-left "></i> <?php echo __d('public', 'Data do - gdy cykliczna') ?>
            </th>
            <th sort by="order" reverse="reverse" order="'budg'">
                <i class="fa fa-money"></i> <?php echo __d('public', 'Kwota') ?>
            </th>
            <th>
                <i class="fa fa-question"></i> <?php echo __d('public', 'Status') ?> 
            </th>

        </tr>
    </thead>
    <tbody>
        <tr ng-cloak ng-repeat="payment in payments| pag: currentPage : 10 |  orderBy:order:reverse">
            <td ng-bind="payment.Payment.name"></td>
            <td ng-bind="payment.Payment.date"></td>
            <td ng-bind="payment.Payment.date_to"></td>
            <td>
                {{payment.Payment.price}}
                {{payment.Payment.currency}}
            </td>
            <td>
                <i class="fa fa-check-circle font-red" ng-hide="payment.Payment.payment_done" tooltip="<?php echo __d('public', 'Nieopłacona') ?>"></i>
                <i class="fa fa-check-circle font-green" ng-show="payment.Payment.payment_done" tooltip="<?php echo __d('public', 'Opłacone') ?>"></i>
            </td>
        </tr>

    </tbody>
</table>

<pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="payments | length" boundary-links="true"></pagination>




