<div class="portlet light">
    <div class="portlet-title tabbable-line">
        <div class="caption caption-md">
            <i class="icon-globe theme-font hide"></i>
            <span class="caption-subject font-blue-madison bold uppercase"><?php echo $subtitle; ?></span>
        </div>
    </div>
    
    <div class="portlet-body" ng-controller="BaseProjectCtrl">       
        <?php echo $this->Form->create('BaseProject', array('controller' => 'base_projects', 'action' => 'create', 'url' => array($client_project_id))); ?>
        <div id="etherpad_div">
                <span class="textarea-label">Opis</span>
                
                <?php
                    echo $this->FebTinyMce4->input('description', array('label' => 'Specyfikacja'), 'full');
                ?> 
                    <br>
                <?php
                
                echo $this->Metronic->input('tags', array(
                    'label' => 'Słowa kluczowe',
                    'value' => isset($baseproject['BaseProject']['tags']) ? $baseproject['BaseProject']['tags'] : '',
                ));
                
                echo $this->Metronic->input('coordinator_contact', array(
                    'label' => 'Kierownik kontaktowy',
                    'type' => 'select',
                    //'default' => 'PL',
                    'options' => $coordinators,
                    'div' => 'form-group',
                    'class' => 'form-control'
                ));
                   
                echo $this->Metronic->input('programmer_contact', array(
                    'label' => 'Programista kontaktowy',
                    'type' => 'select',
                    //'default' => 'PL',
                    'options' => $programmers,
                    'div' => 'form-group',
                    'class' => 'form-control'
                ));
                
                echo $this->Metronic->input('languages', array(
                    'label' => 'Językowość',
                    'value' => isset($baseproject['BaseProject']['languages']) ? $baseproject['BaseProject']['languages'] : 0,
                    'type' => 'checkbox'
                ));      
                
                echo $this->Metronic->input('client_project_id', array(
                    'type' => 'hidden', 
                    'value' => $client_project_id,
                ));
            ?>
               
        </div>
        
        <button class="btn blue-madison" id="save_text_document" type="submit">Zapisz</button>
        
        <?php echo $this->Form->end(); ?>
     
    </div>
    </div>
</div>