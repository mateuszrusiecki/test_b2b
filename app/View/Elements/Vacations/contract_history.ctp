<?php if (!empty($user_contract_history)): ?>
    <div id="contract_history" class="table-scrollable table-scrollable-borderless">
        <div class="jcarousel margin-bottom-10">
            <ul>
                <?php
                $total = 0;
                foreach ($user_contract_history as $uch):
                    ?>

                    <?php
                    $today = date("Y-m-d");
                    $contractActive = ($uch['UserContractHistory']['employment_start'] <= $today) && ($uch['UserContractHistory']['employment_end'] >= $today) ? ' active' : '';
                    ?>

                    <?php $uch['UserContractHistory']['employment_start']; ?>

                    <li>
                        <div class="todo-tasklist-item todo-tasklist-item-border-green<?php echo $contractActive; ?>">
                            <span class="todo-tasklist-date">
                                <i class="fa fa-calendar"></i>
                                <span class="todo-tasklist-item-title">
                                    <?php echo $uch['UserContractHistory']['employment_start'] . ' - ' . $uch['UserContractHistory']['employment_end']; ?>
                                </span>
                            </span>
                            <div class="todo-tasklist-item-text margin-top-10">
                                <table class="table">
                                    <tr>
                                        <td class="col-md-6"><?php echo __d('public', 'Rodzaj umowy'); ?>:</td>
                                        <td><?php echo $uch['UserContractHistory']['state']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-6"><?php echo __d('public', 'Wymiar czasu pracy'); ?>:</td>
                                        <td><?php echo $uch['UserContractHistory']['working_time']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-6"><?php echo __d('public', 'Pozycja'); ?>:</td>
                                        <td><?php echo $uch['UserContractHistory']['position']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-6"><?php echo __d('public', 'Data rozpoczęcia'); ?>:</td>
                                        <td>
                                            <?php
                                            if ($uch['UserContractHistory']['employment_start'])
                                            {
                                                echo date('Y-m-d', strtotime($uch['UserContractHistory']['employment_start']));
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-6"> <?php echo __d('public', 'Data zakończenia'); ?>: </td>
                                        <td>
                                            <?php
                                            if ($uch['UserContractHistory']['employment_end'])
                                            {
                                                echo date('Y-m-d', strtotime($uch['UserContractHistory']['employment_end']));
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                    <?php //pokazuje wynagrodzenie tylko jeśli jest to umowa zalogowanego użytkownika lub jest on adminem, zarządem, sekretariatem lub kierownikiem ?>
                                    <?php if ($uch['UserContractHistory']['user_id'] = $_SESSION['Auth']['User']['id'] || ($_SESSION['user_permission'] == 'all' || $_SESSION['user_permission'] = 'manager')): ?>
                                        <tr>
                                            <td class="col-md-6"><?php echo __d('public', 'Wynagrodzenie brutto'); ?> : </td>
                                            <td>
                                                <span show-salary data-netto="0"  data-id="<?php echo $uch['UserContractHistory']['id']; ?>"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-6"><?php echo __d('public', 'Wynagrodzenie netto'); ?> : </td>
                                            <td>
                                                <span show-salary data-netto="1"  data-id="<?php echo $uch['UserContractHistory']['id']; ?>"></span>
                                            </td>
                                        </tr>
                                    <?php endif; ?>

                                    <tr>
                                        <td class="col-md-6 ilosc_urlopu"> 
                                            <span class="col-xs-12"><?php echo __d('public', 'Ilość urlopu rocznie'); ?>:</span>
                                        </td>
                                        <td class="ilosc_urlopu"> 
                                            <span class="col-xs-12 font-blue-sharp">
                                                <?php
                                                echo $uch['UserContractHistory']['vacation_days'];
                                                echo __d('public', 'dni');
                                                ?> 
                                            </span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-6 ilosc_urlopu"> 
                                            <span class="col-xs-12"><?php echo __d('public', 'Dostępny urlop'); ?>:</span>
                                        </td>
                                        <td class="ilosc_urlopu"> 
                                            <span class="col-xs-12 font-blue-sharp">
                                                <?php
                                                echo $uch['UserContractHistory']['vacation_available'];
                                                echo __d('public', 'dni');
                                                ?> 
                                            </span> 
                                        </td>
                                    </tr>
                                    <?php if (isset($this->params['named']['user'])): ?>
                                        <tr>
                                            <td>
                                                <?php
                                                if ($uch['UserContractHistory']['parent_id'])
                                                {
                                                    echo __d('public', 'Umowa nie aktualna');
                                                }
                                                ?>
                                            </td><td>
                                                <?php
                                                if ($uch['UserContractHistory']['parent_id'])
                                                {
                                                    ?><br>

                                                    <a class="edit_contract" href="/hrs/edit_contract/<?php echo $uch['UserContractHistory']['parent_id'] ?>" title='Zobacz aktualną umowę'><?php echo __d('public', 'Edytuj aktualną'); ?></a> 
                                                    <?php
                                                } else
                                                {
                                                    ?>
                                                    <a class="edit_contract" href="/hrs/edit_contract/<?php echo $uch['UserContractHistory']['id'] ?>" title='Edytuj'><?php echo __d('public', 'Edytuj'); ?></a> 
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>

                    </li>
                <?php endforeach; ?>
            </ul>

        </div>

        <?php if (isset($this->params['named']['user'])): ?>
            <a class="btn btn-sm green-haze margin-bottom pull-left" href="/hrs/add_employee_contract/<?php echo $profile['Profile']['id'] ?>" title="<?php echo __d('public', 'Dodaj umowę'); ?>"><?php echo __d('public', 'Dodaj umowę'); ?></a>
        <?php endif; ?>

        <a class="jcarousel-next btn btn-icon-only default pull-right" href="#"><i class="fa fa-angle-right"></i></i></a>
        <a class="jcarousel-prev btn btn-icon-only default pull-right" href="#"><i class="fa fa-angle-left"></i></a>

    </div>
<?php else: ?>
    <div class="note note-info">
        <p>
            <?php echo __d('public', 'Brak historii zatrudnienia') ?>.
        </p>

    </div>
    <?php if (isset($this->params['named']['user'])): ?>
        <a class="btn btn-sm green-haze margin-bottom " href="/hrs/add_employee_contract/<?php echo $profile['Profile']['id'] ?>" title="<?php echo __d('public', 'Dodaj umowę'); ?>"><?php echo __d('public', 'Dodaj umowę'); ?></a>
    <?php endif; ?>
<?php endif; ?>