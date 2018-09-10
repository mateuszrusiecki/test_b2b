
<?php echo $this->Metronic->portlet(__d('public', 'Lista aktywności')); ?>
<div class="row">
     
    <?php if($show_all): ?>
        <div class="col-md-12">
        <a href="/client_leads/crm_activity" class="btn green-haze pull-left"><?php echo __d('public', 'Wszystkie aktywności'); ?></a>
        <div class="clear"></div>
    <?php endif; ?>
    
        <?php echo $this->element('default/paginator');   ?>
        <?php $i=0 //zmienna potrzeban do wyświetlania różnych kolorów(jest zdefiniowane 7) tła zdarzeń(aby się nie zlewały i było łatwiej je przeglądać). Nie?>
        <?php foreach ($lead_logs as $lead_log): ?>
            <?php $i++ ?>
            
                <?php // zdarzenia są grupowane po dacie - każdy dzień jest osobną grupą
                //wyciągam date utworzenia wpisu i sprawdzam czy istnieje ostatnia data utworzenia($last_created jest ustawiane w lini 28), 
                //jeśli nie -> dodaje nową grupę(potrzebne tylko na początku listy)
                //jeśli istnieje i jest różna od daty utworzenia to tworzę nową grupę
                //jeśli istnieje i jest RÓWNA dacie utworzenia to zdarzenie wpada do aktualnej grupy?>
                <?php $created = explode(' ', $lead_log['LeadLog']['created'])?>
                <?php if(empty($last_created[0])) { ?>
                    <h6 class="timelineDay"><?php echo __d('cms', date("l",strtotime($created[0]))); ?> <span><?php echo $created[0] ?> </span></span></h6>
                    <ul class="timeline">
                <?php } ?>
                <?php if(!empty($last_created[0]) && $last_created[0] != $created[0]){ ?>
                    </ul>
                    <h6 class="timelineDay"><?php echo __d('cms', date("l",strtotime($created[0]))); ?> <span><?php echo $created[0] ?> </span></span></h6>
                    <ul class="timeline">
                <?php } ?>
                <?php $last_created = $created //ustawiam date aktualnie wyświetlanego wpisu jako ostatnią?>
                        
                <!--<li class="timeline-<?php //echo $colors[$i] ?>">-->
                <li class="timeline-<?php echo $colors[$lead_log['LeadLog']['type_log_id']] ?>">
                    <div class="timeline-time">
                        <span class="date">
                            <?php echo $created[0] //data?> </span>
                        <span class="time">
                            <?php echo substr($created[1], 0,5) //godzina i minuta ?> </span>
                    </div>
                    <div class="timeline-icon">
                        <?php //ikona typu zdarzenia wraz z opisem ?>
                        <i class="cursor-pointer fa <?php if(isset($icons[$lead_log['LeadLog']['type_log_id']])) echo $icons[$lead_log['LeadLog']['type_log_id']]; else echo 'fa-cogs'; ?>"
                           tooltip="<?php echo $log_type[$lead_log['LeadLog']['type_log_id']] ?>"></i>
                    </div>
                    <div class="timeline-body activity-user_avatar">
                        <!--<img alt="" src="../../assets/admin/pages/media/blog/2.jpg" class="timeline-img pull-left">-->
                        <?php 
                        $avatarOptions = array('width'=>'55','height'=>'55','class' => 'timeline-img pull-left');
                        $userProfile['avatar'] = $lead_log['User']['avatar'];
                        $userProfile['activity_avatar_url'] = $lead_log['User']['avatar_url'];
                        echo $this->element('default/avatar', compact('userProfile','avatarOptions'));
                        ?>
                        <div>
                            <h2> <?php //Kliknięcie w użytkownika powoduje pokazanie listy przefiltrowanej do wszystkich czynności danego użytkownika we wszystkich leadach ?>
                                <?php if($lead_log['Profile']['firstname']){
                                        echo $this->Html->link($lead_log['Profile']['firstname'].' '.$lead_log['Profile']['surname'], 
                                        array('controller'=>'client_leads','action' => 'crm_activity', 'user', $lead_log['LeadLog']['user_id']),
                                        array('class'=>'lead_link font-grey-cararra','escape' => false,'tooltip'=>__d('public', 'Pokaż listę aktywności tego użytkownika we wszystkich leadach'))); 
                                } else {
                                    echo __d('public', 'No name');
                                }
?>
                            </h2>
                            <div class="timeline-content">
                                <?php //Kliknięcie w lead powoduje pokazanie listy przefiltrowanej do wszystkich czynności użytkowników w danym leadzie ?>
                                Zmodyfikował lead <?php echo $this->Html->link('<strong>'.$lead_log['ClientLead']['name'].'</strong>', 
                                        array('controller'=>'client_leads','action' => 'crm_activity', 'lead', $lead_log['ClientLead']['id']),
                                        array('class'=>'lead_link font-grey-cararra','escape' => false,'tooltip'=>__d('public', 'Pokaż listę aktywniści wsysktich użytkowników w tym leadzie'))); ?>
                                     <?php //echo $log_type[$lead_log['LeadLog']['type_log_id']] ?>
                                <?php //Link do leada ?>
                                <?php echo $this->Html->link(' <i class="fa fa-chevron-right"></i>', 
                                        array('controller'=>'client_leads','action' => 'view', $lead_log['ClientLead']['client_id'], $lead_log['ClientLead']['id']),
                                        array('class'=>'lead_link font-grey-cararra pull-right','escape' => false,'target'=>'_blank','tooltip'=>__d('public', 'Zobacz ten lead'))); ?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php if($i==7) $i=0; ?>
        <?php endforeach; ?>
        </ul>
        
            <?php echo $this->element('default/paginator');   ?>
                   
    </div>
</div>
<?php echo $this->Metronic->portletEnd(); ?>