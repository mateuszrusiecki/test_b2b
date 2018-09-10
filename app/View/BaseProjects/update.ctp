<div class="portlet light">
    <div class="portlet-title tabbable-line">
        <div class="caption caption-md">
            <i class="icon-globe theme-font hide"></i>
            <span class="caption-subject font-blue-madison bold uppercase"><?php echo $subtitle; ?></span>
        </div>
    </div>
    <div class="clearfix">
        <?php
            echo $this->Html->link(
                'Powrót do listy', array('controller' => 'base_projects', 'action' => 'index'), array('class' => 'btn btn-sm yellow margin-bottom pull-right ml')
            );
        ?>
    </div>
    <div class="portlet-body" ng-controller="BaseProjectCtrl">       
        <?php echo $this->Form->create('BaseProject', array('controller' => 'base_projects', 'action' => 'create', 'url' => array($baseProject['BaseProject']['id']))); ?>
        <div id="etherpad_div">
            
                <span class="textarea-label">Opis</span>
                
                <?php
                    echo $this->FebTinyMce4->input('description', array(
                        'value' => $baseProject['BaseProject']['description'],
                    ), 'full');
                ?> 
                <br>
                <?php
                
                echo $this->Metronic->input('tags', array(
                    'label' => 'Słowa kluczowe',
                    'value' => isset($baseProject['BaseProject']['tags']) ? $baseProject['BaseProject']['tags'] : '',
                ));
                
                echo $this->Metronic->input('coordinator_contact', array(
                    'label' => 'Kierownik kontaktowy',
                    'type' => 'select',
                    'default' => isset($baseProject['BaseProject']['coordinator_contact']) ? $baseProject['BaseProject']['coordinator_contact'] : '',
                    'options' => $coordinators,
                    'div' => 'form-group',
                    'class' => 'form-control'
                ));
                   
                echo $this->Metronic->input('programmer_contact', array(
                    'label' => 'Programista kontaktowy',
                    'type' => 'select',
                    'default' => isset($baseProject['BaseProject']['programmer_contact']) ? $baseProject['BaseProject']['programmer_contact'] : '',
                    'options' => $programmers,
                    'div' => 'form-group',
                    'class' => 'form-control'
                ));
                
                echo $this->Metronic->input('languages', array(
                    'label' => 'Językowość',
                    'value' => isset($baseProject['BaseProject']['languages']) ? $baseProject['BaseProject']['languages'] : 0,
                    'checked' => isset($baseProject['BaseProject']['languages']) && $baseProject['BaseProject']['languages'] == 1 ? 'checked' : '',
                    'type' => 'checkbox'
                ));      
                
                echo $this->Metronic->input('client_project_id', array(
                    'type' => 'hidden', 
                    'value' => isset($baseProject['BaseProject']['client_project_id']) ? $baseProject['BaseProject']['client_project_id'] : 0,
                ));
                
                echo $this->Metronic->input('id', array(
                    'type' => 'hidden', 
                    'value' => isset($baseProject['BaseProject']['id']) ? $baseProject['BaseProject']['id'] : 0,
                ));
            ?>
               
        </div>
        
        <button class="btn blue-madison" id="save_text_document" type="submit">Zapisz</button>
        
        <?php echo $this->Form->end(); ?>
     
    </div>
    </div>
</div>