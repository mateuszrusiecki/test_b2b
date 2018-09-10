<div class="portlet light" ng-controller="TextDocumentCtrl">
    <div class="portlet-title tabbable-line">
        <div class="caption caption-md">
            <i class="icon-globe theme-font hide"></i>
            <span class="caption-subject font-blue-madison bold uppercase"><?php echo $title; ?></span>
        </div>
    </div>

    <div class="clearfix">
        <span class="font-red" ng-if="safariUser" ng-bind="safariUser" class="pull-left"></span>
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
    <div class="portlet-body">       
        <?php echo $this->Form->create('TextDocument', array('controller' => 'text_documents', 'action' => 'create', 'url' => array($lead_id))); ?>
        <div id="etherpad_div">
            <?php
                echo $this->Metronic->input('name', array(
                    'label' => __d('public','Nazwa dokumentu'),
                    'value' => isset($textdocument['TextDocument']['name']) ? $textdocument['TextDocument']['name'] : '',
                    'required'
                ));
                
                echo $this->Metronic->input('share_link', array(
                    'type' => 'hidden',
                    'value' => '{{full_share_link}}',
                ));
                
                echo $this->Metronic->input('share_block', array(
                    'label' => __d('public','Blokada współdzielenia'),
                    'value' => isset($textdocument['TextDocument']['share_block']) ? $textdocument['TextDocument']['share_block'] : 0,
                    'type' => 'checkbox'
                ));       
            ?>
            <iframe id="etherpad" name='embed_readwrite' style="width: 100%; height: 600px;"></iframe>
        
        </div>
        
        <button class="btn blue-madison" id="save_text_document" type="submit"><?php echo __d('public', 'Zapisz') ?></button>

        <a class="btn green-haze" ng-click="exportPdf()"><?php echo __d('public', 'Eksportuj do PDF') ?></a>     
        <a class="btn blue" ng-click="exportDoc()"><?php echo __d('public', 'Eksportuj do DOC') ?></a>     
        
        <?php echo $this->Form->end(); ?>
    </div>
</div>
