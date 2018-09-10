<div class="table-scrollable" id="issuesAssignedTo">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th><i class="fa fa-calendar"></i> <?php echo __d('public', 'rok'); ?></th>
                <th><i class="fa fa-calendar"></i> <?php echo __d('public', 'miesiąc'); ?></th>
                <th><i class="fa fa-calendar-o"></i> <?php echo __d('public', 'godziny pracujące'); ?></th>
                <th><i class="fa fa-calendar-o"></i> <?php echo __d('public', 'dni pracujące'); ?></th>
                <th><i class="fa fa-calendar-o"></i> <?php echo __d('public', 'dni wolne'); ?></th>
                <th class="actions"><i class="fa fa-cog"></i> <?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody ng-init="workTimes =<?php echo a($workTimes); ?>">
            <tr ng-cloak ng-repeat="workTime in workTimes| pag: currentPage : 10">
                <td>{{workTime.WorkTime.year}}&nbsp;</td>
                <td>{{workTime.WorkTime.month}}&nbsp;</td>
                <td>{{workTime.WorkTime.work_hours}}&nbsp;</td>
                <td>{{workTime.WorkTime.work_days}}&nbsp;</td>
                <td>{{workTime.WorkTime.days_off}}&nbsp;</td>
                <td class="actions">
                    <form class="pointer"
                        onclick="confirm('Czy napewno chcesz usunąć')?this.submit():false" 
                        action="{{'/work_times/delete/' + workTime.WorkTime.id}}" 
                        method="post">
                        <i tooltip="Usuń" class="fa fa-close large-icon pull-right"></i>
                    </form>

                    <a href="/work_times/view/{{workTime.WorkTime.id}}">
                        <i class="fa fa-eye large-icon pull-right" tooltip="<?php echo __d('public', 'Szybki podgląd'); ?>"></i>
                    </a>
                    <a href="/work_times/edit/{{workTime.WorkTime.id}}">
                        <i class="fa fa-pencil-square  large-icon pull-right" tooltip="<?php echo __d('public', 'Edytuj dokument'); ?>"></i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

</div>
<pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="workTimes.length" boundary-links="true"></pagination>