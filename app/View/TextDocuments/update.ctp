<div class="portlet light" ng-controller="TextDocumentCtrl">
    <div class="portlet-title tabbable-line">
        <div class="caption caption-md">
            <i class="icon-globe theme-font hide"></i>
            <span class="caption-subject font-blue-madison bold uppercase"><?php echo $title; ?></span>
        </div>
    </div>
    <div aria-hidden="true" role="dialog" tabindex="-1" id="send_share_links" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    <h4 class="modal-title"><?php echo __d('public', 'Wyślij powiadomienie') ?></h4>
                </div>
                <form name="sendShareLinksForm" method="post" action="/text_documents/send_share_links/" novalidate>
                    <div class="modal-body">
                        <!--//echo $this->Form->create('TextDocument', array('controller' => 'textdocuments', 'action' => 'send_share_links'));-->
                        <!--<input type="hidden" name="share_link" value="{{actionLink}}">-->
                        <input type="hidden" name="share_link" value="<?php echo $textdocument['TextDocument']['share_link'] ?>">
                        <input ng-if="text_document_id" type="hidden" name="text_document_id" value="{{text_document_id}}">
                        <input ng-if="lead_id" type="hidden" name="lead_id" value="{{lead_id}}">
                        <div class="dynamicFormRow">
                            <?php echo __d('public', 'Adresy na które zostanie wysłany link do współdzielenia dokumentu') ?>:
                        </div>                   
                        <div class="dynamicFormRow inputsContainer">
                            <span><?php echo __d('public', 'Email klienta') ?>: </span>
                            <input value="{{TextDocumentData.ClientLead.Client.email}}" type="email" ng-model="mailToClient" name="mailToClient" required>
                            <span style="color:#d84a38" ng-show="sendShareLinksForm.mailToClient.$error.required || (sendShareLinksForm.mailToClient.$dirty && sendShareLinksForm.mailToClient.$invalid)">
                                <span ng-show="sendShareLinksForm.mailToClient.$error.required || sendShareLinksForm.mailToClient.$error.email"><?php echo __d('public', 'Wymagany poprawny email') ?></span>
                            </span>
                        </div>
                        <a ng-click="addTextInput()" class="btn btn-sm yellow" id="add_new_calendar" data-toggle="modal" href="#add_calendar_modal"><?php echo __d('public', 'Dodaj adres') ?></a>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij') ?></button>
                        <button ng-disabled="sendShareLinksForm.mailToClient.$error.required || (sendShareLinksForm.mailToClient.$dirty && sendShareLinksForm.mailToClient.$invalid)" id="modalSubmit" class="btn blue-madison" type="submit"><?php echo __d('public', 'Wyślij') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!--
        <span ng-show="myForm.email.$error.required">Email is required.</span>
        <span ng-show="myForm.email.$error.email">Invalid email address.</span>
    -->
    
    <div class="clearfix">
        <?php
            if(isset($lead_id)){
                
                echo $this->Html->link(
                    __d('public','Lista dokumentów'), array('controller' => 'text_documents', 'action' => 'index', $lead_id), array('class' => 'btn btn-sm yellow margin-bottom pull-right ml')
                );
            } else {
                
                echo $this->Html->link(
                    __d('public','Lista dokumentów'), array('controller' => 'text_documents', 'action' => 'index'), array('class' => 'btn btn-sm yellow margin-bottom pull-right ml')
                );
            }
        ?>
    </div>
    <p style="margin-bottom: 35px; font-size: 16px;">Autor dokumentu: <b> <?php echo $documentAuthor['Profile']['firstname'].' '.$documentAuthor['Profile']['surname']; ?></b> </p>
    <div class="portlet-body">  
        <?php $actionUrl = 'update/' . $textdocument['TextDocument']['id']; ?>
        <?php echo $this->Form->create('TextDocument', array('controller' => 'textdocuments', 'action' => 'update', 'url' => $actionUrl)); ?>
        <div>
            <?php
                echo $this->Metronic->input('name', array(
                    'label' => __d('public','Nazwa dokumentu'),
                    'value' => isset($textdocument['TextDocument']['name']) ? $textdocument['TextDocument']['name'] : '',
                ));
                
                echo $this->Metronic->input('share_link', array(
                    'type' => 'hidden',
                    'value' => isset($textdocument['TextDocument']['share_link']) ? $textdocument['TextDocument']['share_link'] : '',
                ));
                
                echo $this->Metronic->input('lead_id', array(
                    'type' => 'hidden',
                    'value' => isset($textdocument['TextDocument']['lead_id']) ? $textdocument['TextDocument']['lead_id'] : '',
                ));
                
                if(isset($lead_id)){
                    echo $this->Metronic->input('current_lead_id', array(
                        'type' => 'hidden',
                        'value' => $lead_id,
                    ));
                }

//                if($textdocument['TextDocument']['user_id'] == $this->Session->read('Auth.User.id')){
//                    echo $this->Metronic->input('share_block', array(
//                        'label' => __d('public','Blokada współdzielenia'),
//                        'checked' => (isset($textdocument['TextDocument']['share_block']) && $textdocument['TextDocument']['share_block'] == true) ? 'checked' : '',
//                        'type' => 'checkbox'
//                    ));
//                }
            ?>

            <textarea  id="etherpad" name="data[TextDocument][content]" style="width: 100%; height: 600px;"><?php echo $textdocument['TextDocument']['content'];?></textarea>
<!--            <iframe id="etherpad" name='embed_readwrite' style="width: 100%; height: 600px;"></iframe>-->
      
        </div>        

        <button class="btn blue-madison" type="submit"><?php echo __d('public', 'Zapisz') ?></button>
        <a class="btn green-haze" ng-click="exportPdf()"><?php echo __d('public', 'Eksportuj do PDF') ?></a>     
        <a class="btn blue" ng-click="exportDoc()"><?php echo __d('public', 'Eksportuj do DOC') ?></a>     
        <?php if($user_permission == 'all' || $user_permission == 'manager') { ?>
            <a class="btn yellow" id="add_new_calendar" data-toggle="modal" href="#send_share_links"><?php echo __d('public', 'Wyślij powiadomienie') ?></a>
        <?php } ?> 
        
        <?php echo $this->Form->end(); ?>
        
    </div>
</div>