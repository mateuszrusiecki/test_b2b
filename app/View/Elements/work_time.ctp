<?php if ($user_work_time): ?>
    <div class="table-scrollable table-scrollable-borderless">

        <div class="jcarousel margin-bottom-10">
            <ul>
                <?php
                foreach ($user_work_time as $uwt)
                {
                    ?>
                    <li>
                        <div class="todo-tasklist-item todo-tasklist-item-border-green">
                            <span class="todo-tasklist-date">
                                <i class="fa fa-calendar"></i>
                                <span class="todo-tasklist-item-title">
                                    <?php echo $months_names[$uwt['UserWorkTime']['month']] . ' ' . $uwt['UserWorkTime']['year']; ?>
                                </span>
                            </span>
                            <div class="todo-tasklist-item-text margin-top-10">
                                <table class="table">
                                    <tr>
                                        <td><?php echo __d('public', 'Etat') ?>:</td>
                                        <td><?php echo $uwt['UserWorkTime']['contract_summary']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo __d('public', 'Godziny pracujące') ?>:</td>
                                        <td><?php echo $uwt['UserWorkTime']['hours_to_work']; ?>h</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo __d('public', 'Przepracowane godziny') ?>:</td>
                                        <td><?php echo $uwt['UserWorkTime']['hours_worked']; ?>h</td>
                                    </tr>
                                    <?php if (!isset($this->params['named']['user'])): ?>
                                        <tr>
                                            <td class="col-md-6"><?php echo __d('public', 'Wynagrodzenie podstawowe'); ?> : </td>
                                            <td>
                                                <span show-salary data-netto="0"  data-id="<?php echo $uwt['UserWorkTime']['user_contract_history_id']; ?>"></span>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <td><?php echo __d('public', 'Nadgodziny') ?>:</td>
                                        <td><?php echo $uwt['UserWorkTime']['overtime']; ?>h</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo __d('public', 'Nadgodziny łącznie') ?>:</td>
                                        <td><?php echo $uwt['UserWorkTime']['total_overtime']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo __d('public', 'Urlop') ?>:</td>
                                        <td><?php echo $uwt['UserWorkTime']['vacations']; ?>d</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo __d('public', 'Zwolnienie lekarskie') ?>:</td>
                                        <td><?php echo $uwt['UserWorkTime']['sick_leave']; ?>d</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <?php // echo $year . "-" . $month . ": " . $work_hours . "<br />";    ?>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>

        <a class="jcarousel-next btn btn-icon-only default pull-right" href="#"><i class="fa fa-angle-right"></i></i></a>
        <a class="jcarousel-prev btn btn-icon-only default pull-right" href="#"><i class="fa fa-angle-left"></i></a>

    </div>
<?php else: ?>
    <div class="note note-info">
        <h4 class="block"><?php echo __d('public', 'Brak danych') ?></h4>
        
    </div>
<?php endif; ?>