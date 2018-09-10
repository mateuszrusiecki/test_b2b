<?php echo $this->Metronic->portlet( __d('public', 'Premie')); ?>
<div>

    <div class="table-scrollable">
        <table class="table table-striped table-bordered table-advance table-hover">
            <thead>
                <tr>
                    <th>
                        <i class="fa fa-briefcase"></i> <?php echo __d('public', 'Nazwa') ?>
                    </th>
                    <th >
                        <i class="fa fa-calendar"></i> <?php echo __d('public', 'Data') ?>
                    </th>
                    <th>
                        <i class="fa fa-money ng-scope"></i>
                        <?php echo __d('public', 'Kwota') ?>
                    </th>
                    <th>
                        <i class="fa fa-question"></i> <?php echo __d('public', 'Status') ?> 
                    </th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Budvar - strona www
                    </td>
                    <td>
                        2015.05.05
                    </td>
                    <td>
                        50zł
                    </td>
                    <td>
                        <i tooltip="Wypłacona" class="fa fa-check-circle font-green"></i>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
<pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="projects | filter:search | projectListFilter:f:1| projectListFilter:f0:0 | length" boundary-links="true"></pagination>

<?php echo $this->Metronic->portletEnd(); ?>