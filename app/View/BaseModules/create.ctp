<div class="portlet light">
    <div class="portlet-title tabbable-line">
        <div class="caption caption-md">
            <i class="icon-globe theme-font hide"></i>
            <span class="caption-subject font-blue-madison bold uppercase"><?php echo $subtitle; ?></span>
        </div>
    </div>
    
    <div class="portlet-body" ng-controller="BaseModuleCtrl">       
        <?php echo $this->Form->create('BaseModule', array('controller' => 'base_projects', 'action' => 'create', 'url' => array($client_project_id))); ?>
        <div id="etherpad_div">
            <?php
                echo $this->Metronic->input('foundations', array(
                    'label' => 'Założenia',
                    'value' => isset($basemodule['BaseModule']['foundations']) ? $basemodule['BaseModule']['foundations'] : '',
                    'required'
                ));
                
                echo $this->Metronic->input('repository_type', array(
                    'label' => 'Typ repozytorium',
                    'type' => 'select',
                    //'default' => 'PL',
                    'options' => array('SVN' => 'SVN', 'Git' => 'Git'),
                    'div' => 'form-group',
                    'class' => 'form-control',
                ));
                
                echo $this->Metronic->input('repository_path', array(
                    'label' => 'Ścieżka do repozytorium',
                    'value' => isset($basemodule['BaseModule']['repository_path']) ? $basemodule['BaseModule']['repository_path'] : '',
                ));
                
                echo $this->Metronic->input('coordinator_contact', array(
                    'label' => 'Kierownik kontaktowy',
                    'type' => 'select',
                    //'default' => 'PL',
                    'options' => $coordinators,
                    'div' => 'form-group',
                    'class' => 'form-control'
                ));
                   
                echo $this->Metronic->input('category', array(
                    'label' => 'Kategoria',
                    'value' => isset($basemodule['BaseModule']['category']) ? $basemodule['BaseModule']['category'] : '',
                    'required'
                ));
                
                echo $this->Metronic->input('name', array(
                    'label' => 'Nazwa',
                    'value' => isset($basemodule['BaseModule']['name']) ? $basemodule['BaseModule']['name'] : '',
                    'required'
                ));
                
//                echo $this->Metronic->input('specification', array(
//                    'label' => 'Specyfikacja',
//                    'value' => isset($basemodule['BaseModule']['specification']) ? $basemodule['BaseModule']['specification'] : '',
//                    'required'
//                ));
                
            ?>
                <span class="textarea-label">Specyfikacja</span>
            <?php
                echo $this->FebTinyMce4->input('specification', array('label' => 'Specyfikacja'), 'full');
            ?> 
                <br>
            <?php
                echo $this->Metronic->input('languages', array(
                    'label' => 'Językowość',
                    'value' => isset($basemodule['BaseModule']['languages']) ? $basemodule['BaseModule']['languages'] : 0,
                    'type' => 'checkbox'
                )); 
                
                echo $this->Metronic->input('programmer_contact', array(
                    'label' => 'Programista kontaktowy',
                    'type' => 'select',
                    //'default' => 'PL',
                    'options' => $programmers,
                    'div' => 'form-group',
                    'class' => 'form-control'
                ));
                     
                echo $this->Metronic->input('comments', array(
                    'label' => 'Uwagi',
                    'value' => isset($basemodule['BaseModule']['comments']) ? $basemodule['BaseModule']['comments'] : '',
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