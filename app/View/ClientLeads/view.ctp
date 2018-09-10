<div class="row">
    <?php echo $this->element('Clients/client_list'); ?>
    <div class="col-md-9 col-xs-12">
        <div class="portlet light">

            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-share font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase pull-left"><?php echo __d('public', 'Szczegóły leadu'); ?></span>

                    
                    <div class="actions pull-right">
                        <a class="btn btn-sm btn-circle red-sunglo " href="/clients/view/<?php echo $lead['Client']['id'] ?>" data-toggle="modal">
                            <i class="fa fa-arrow-circle-left"></i> <?php echo __d('public', 'Powrót'); ?> </a>
                    </div>
                    
                </div>

            </div>
            <div class="portlet-body">

                <?php
                echo $this->Session->flash('note'); // Flash związany z notatkami
                echo $this->Session->flash('contact'); // Flash związany z osobami kontaktowymi
                echo $this->Session->flash('email_info');
                ?>

                <div class="tabbable-custom nav-justified">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="<?php echo!empty($session_note) || (empty($session_note) && empty($session_contact)) ? 'active' : ''; ?>">
                            
                            <a data-toggle="tab" href="#lead_informacje">
                                <?php echo __d('public', 'Informacje'); ?>
                            </a>
                            
                        </li>
                        <li>
                            <a data-toggle="tab" href="#lead_log"><?php echo __d('public', 'Log i pliki'); ?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="lead_informacje" class="tab-pane <?php echo!empty($session_note) || (empty($session_note) && empty($session_contact)) ? 'active' : ''; ?>">

                            <?php echo $this->element('ClientLeads/contact_list'); ?>

                            <div class="clearfix"></div>

                            <p><?php echo __d('public', 'Prawdopodobieństwo'); ?>:</p>
                            <div class="progress">
                                <div style="width:<?php echo $lead['ClientLead']['probability']; ?>%;" 
                                     aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-info">
                                </div>
                                <span class="probability_info"><?php echo $lead['ClientLead']['probability']; ?>%</span>
                            </div>
                            <div class="margin-bottom-10 clearfix">
    
<!--                                <i class="fa fa-info-circle font-red-sunglo font-large-style info-circle" 
                                   tooltip="Mail do leadu: aby wysłac mail do leadu należy w tytule dodać oznaczenie poniższe oznaczenie np. #5">
                                </i>-->
                                <?php
                                if ($client_project)
                                {
                                    echo $this->Html->link('<i class="fa fa-list-ul"></i> '.__d('public', 'Projekt'), array('controller' => 'client_projects', 'action' => 'view', $client_project['ClientProject']['id']), array('class' => 'btn btn-sm  red-sunglo pull-right margin-left-5', 'escape' => false));
                                } else
                                {
                                    echo $this->Html->link('<i class="icon-note"></i> '.__d('public', 'Utwórz projekt'), array('controller' => 'client_projects', 'action' => 'add', $lead['ClientLead']['id']), array('class' => 'btn btn-sm  red-sunglo pull-right margin-left-5', 'escape' => false));
                                }
                                    echo $this->Html->link('<i class="fa fa-edit"></i> '.__d('public', 'Edytuj lead'), '#edit_lead', array('data-toggle'=>'modal', 'class' => 'btn btn-sm  grey pull-right margin-left-5', 'escape' => false));
                                    echo $this->Html->link('<i class="fa fa-user"></i> Dodaj nową osobę', '#new_contact', array('data-toggle'=>'modal', 'class' => 'btn btn-sm  green pull-right margin-left-5', 'escape' => false));
                                ?>
                                <?php
                                if (!empty($brief))
                                {
                                    echo $this->Html->link('<i class="fa fa-lightbulb-o"></i> '.__d('public', 'Briefing'), array('controller' => 'briefs', 'action' => 'view', $brief['Brief']['id']), array('class' => 'btn btn-sm purple-medium pull-right margin-left-5', 'escape' => false));
                                } else
                                {
                                    echo $this->Html->link('<i class="fa fa-lightbulb-o"></i> '.__d('public', 'Briefing'), array('controller' => 'briefs', 'action' => 'add', $lead['ClientLead']['id']), array('class' => 'btn btn-sm purple-medium pull-right margin-left-5', 'escape' => false));
                                }
                                ?>
                                <?php
                                echo $this->Html->link('<i class="fa fa-file-text"></i> TC', '/text_documents/index/' . $lead['ClientLead']['id'], array('class' => 'btn btn-sm yellow-gold pull-right margin-left-5', 'escape' => false));
                                ?>
                                <?php
                                echo $this->Html->link('<i class="fa fa-file-picture-o"></i> GC', '/new_clients/main#/projects/lead_id/'.$lead['ClientLead']['id'], array('class' => 'btn btn-sm purple-plum pull-right margin-left-5', 'escape' => false));
                                ?>
                            </div>
                            <?php // debug($lead);  ?>
                        </div>

                        <div id="lead_log" class="tab-pane row">
                       
                            <div class="col-xs-12">
                                <?php echo $this->element('ClientLeads/log_list'); ?>
                            </div>

                            <div class="col-xs-12">
                                <?php echo $this->element('ClientLeads/file_list'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php echo $this->element('Clients/add_client_contact_extend'); ?>


<?php echo $this->element('Clients/edit_client_lead'); ?>


<?php echo $this->element('ClientLeads/client_lead_confirm_delete_contact_modals'); ?>


<?php echo $this->element('ClientLeads/client_lead_confirm_delete_file_modals'); ?>
