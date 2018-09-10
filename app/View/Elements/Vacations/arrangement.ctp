
<?php if (empty($first_user_contract_history['UserContractHistory'])): ?>
    <div class="note note-info">
        <p>
            <?php echo __d('public', 'Brak umowy'); ?>!
        </p>

    </div>
<?php else: ?>
    <table class="table table-hover table-light">
        <tbody>
            <tr>
                <td class="col-md-6"> <?php echo __d('public', 'Rodzaj umowy'); ?>: </td>
                <td> 
                    <?php
                    echo __d('public', 'Etat') . ': ';
                    echo $first_user_contract_history['UserContractHistory']['state'] . ' ' . $first_user_contract_history['UserContractHistory']['working_time'];
                    ?>
                    <br/>
                    <?php
                    //echo __d('public','Okres zatrudnienia').': ';
                    //echo $first_user_contract_history['UserContractHistory']['period_of_employment']; 
                    ?> 
                </td>
            </tr>
            <tr>
                <td class="col-md-6"> <?php echo __d('public', 'Data rozpoczęcia'); ?>: </td>
                <td> 
                    <?php
                    if ($first_user_contract_history['UserContractHistory']['employment_start'])
                    {
                        echo date('Y-m-d', strtotime($first_user_contract_history['UserContractHistory']['employment_start']));
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="col-md-6"> <?php echo __d('public', 'Data zakończenia'); ?>: </td>
                <td>
                    <?php
                    if ($first_user_contract_history['UserContractHistory']['employment_end'])
                    {
                        echo date('Y-m-d', strtotime($first_user_contract_history['UserContractHistory']['employment_end']));
                    }
                    ?>
                </td>
            </tr>
    <?php if (!isset($this->params['named']['user'])): ?>
                <tr>
                    <td class="col-md-6"><?php echo __d('public', 'Wynagrodzenie brutto'); ?> : </td>
                    <td>
                        <?php if (isset($first_user_contract_history['UserContractHistory']['id'])): ?>
                            <span show-salary data-netto="0"  data-id="<?php echo $first_user_contract_history['UserContractHistory']['id']; ?>"></span>
        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td class="col-md-6"><?php echo __d('public', 'Wynagrodzenie netto'); ?> : </td>
                    <td>
                        <?php if (isset($first_user_contract_history['UserContractHistory']['id'])): ?>
                            <span show-salary data-netto="1"  data-id="<?php echo $first_user_contract_history['UserContractHistory']['id']; ?>"></span>
                <?php endif; ?>
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
                        echo $first_user_contract_history['UserContractHistory']['vacation_days'];
                        echo __d('public', ' dni');
                        ?> 
                    </span> 
                </td>
            </tr>

            <tr>
                <td class="col-md-6 ilosc_urlopu"> 
                    <span class="col-xs-12"><?php echo __d('public', 'Wykorzystany'); ?>:</span>
                </td>
                <td class="ilosc_urlopu"> 
                    <span class="col-xs-12 font-yellow-lemon">
                        <?php
                        echo $days = $first_user_contract_history['UserContractHistory']['vacation_days'] - $first_user_contract_history['UserContractHistory']['vacation_available'];
                        echo __d('public', ' dni');
                        ?> 
                    </span>
                </td>
            </tr>
            <tr>
                <td class="col-md-6 ilosc_urlopu"> 
                    <span class="col-xs-12"><?php echo __d('public', 'Pozostały'); ?>:</span>
                </td>
                <td class="ilosc_urlopu"> 
                    <span class="col-xs-12  <?php if ($first_user_contract_history['UserContractHistory']['vacation_days'] - $days < 0): ?> font-red-intense bold <?php else: ?> font-green-sharp <?php endif; ?>">
                        <?php
                        echo $first_user_contract_history['UserContractHistory']['vacation_days'] - $days;
                        echo __d('public', ' dni');
                        if ($first_user_contract_history['UserContractHistory']['vacation_days'] - $days < 0)
                        {
                            echo ' Przekroczono dostępną ilość dni urlopowych.';
                        }
                        ?>	
                    </span>
                </td>
            </tr>
            <tr>
                <td class="col-md-6 ilosc_urlopu"> 
                    <span class="col-xs-12"><?php echo __d('public', 'Nadgodziny łącznie'); ?>:</span>
                </td>
                <td class="ilosc_urlopu"> 
                    <span class="col-xs-12 font-yellow-gold">
                        <?php
                        if (!empty($lastUserWorkTime['UserWorkTime']['total_overtime']) && $lastUserWorkTime['UserWorkTime']['total_overtime'] > 0)
                        {
                            echo $lastUserWorkTime['UserWorkTime']['total_overtime'];
                        } else
                        {
                            echo 0;
                        }
                        echo __d('public', ' h');
                        ?> 
                    </span>

                </td>
            </tr>
            <tr>
                <td class="col-md-6 ilosc_urlopu"> 
                    <span class="col-xs-12"><?php echo __d('public', 'Odebrane nadgodziny'); ?>:</span>
                </td>
                <td class="ilosc_urlopu"> 
                    <span class="col-xs-12 font-yellow-gold">
                        <?php
                        if ($userVacations)
                        {
                            echo $userVacations['overtime_settlement'];
                        } else
                        {
                            echo '0';
                        }
                        //echo $hours;
                        echo __d('public', ' h');
                        ?> 
                    </span>

                    <?php
                    if ($year && $year != date('Y'))
                    {
                        echo ' (';
                        echo $year;
                        echo ')';
                    }
                    ?>
                </td>
            </tr>

        </tbody>
    </table>

<?php endif; ?>

