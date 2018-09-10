<div class="portlet light" ng-controller="BaseModuleCtrl">
    <div class="portlet-title tabbable-line">
        <div class="caption caption-md">
            <i class="icon-globe theme-font hide"></i>
            <span class="caption-subject font-blue-madison bold uppercase"><?php echo $subtitle; ?></span>
        </div>
    </div>
    <div class="clearfix">
        <span ng-if="!client_project_id">
            <a class="btn btn-sm yellow margin-bottom pull-right ml" ng-href="/base_modules/index">Powrót do listy</a>
        </span>
        <span ng-if="client_project_id">
            <a class="btn btn-sm yellow margin-bottom pull-right ml" ng-href="/base_modules/index/{{client_project_id}}">Powrót do listy</a>
        </span>
    </div>
    <div class="portlet-body"> 
        <?php if(isset($client_project_id)): ?>
            <?php $url = array($baseModule['BaseModule']['id'], $client_project_id);?>
        <?php else: ?>
            <?php $url = array($baseModule['BaseModule']['id']);?>
        <?php endif; ?>
        <?php echo $this->Form->create('BaseModule', array('controller' => 'base_projects', 'action' => 'update', 'url' => $url)); ?>
        <div id="etherpad_div">
            <?php
                echo $this->Metronic->input('foundations', array(
                    'label' => 'Założenia',
                    'value' => isset($baseModule['BaseModule']['foundations']) ? $baseModule['BaseModule']['foundations'] : '',
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
                    'value' => isset($baseModule['BaseModule']['repository_path']) ? $baseModule['BaseModule']['repository_path'] : '',
                ));
                
                echo $this->Metronic->input('coordinator_contact', array(
                    'label' => 'Kierownik kontaktowy',
                    'type' => 'select',
                    //'default' => 'PL',
                    'options' => $coordinators,
                    'default' => isset($baseModule['BaseModule']['coordinator_contact']) ? $baseModule['BaseModule']['coordinator_contact'] : '',
                    'div' => 'form-group',
                    'class' => 'form-control'
                ));
                   
                echo $this->Metronic->input('category', array(
                    'label' => 'Kategoria',
                    'value' => isset($baseModule['BaseModule']['category']) ? $baseModule['BaseModule']['category'] : '',
                    'required'
                ));
                
                echo $this->Metronic->input('name', array(
                    'label' => 'Nazwa',
                    'value' => isset($baseModule['BaseModule']['name']) ? $baseModule['BaseModule']['name'] : '',
                    'required'
                ));
 
                ?>
                    <span class="textarea-label">Specyfikacja</span>
                <?php
                    echo $this->FebTinyMce4->input('specification', array(
                        'value' => $baseModule['BaseModule']['specification'],
                    ), 'full');
                ?> 
                    <br>
                <?php
                
                echo $this->Metronic->input('languages', array(
                    'label' => 'Językowość',
                    'value' => isset($baseModule['BaseModule']['languages']) ? $baseModule['BaseModule']['languages'] : 0,
                    'checked' => isset($baseModule['BaseModule']['languages']) && $baseModule['BaseModule']['languages'] == 1 ? 'checked' : '',
                    'type' => 'checkbox'
                )); 
                
                echo $this->Metronic->input('programmer_contact', array(
                    'label' => 'Programista kontaktowy',
                    'type' => 'select',
                    //'default' => 'PL',
                    'options' => $programmers,
                    'default' => isset($baseModule['BaseModule']['programmer_contact']) ? $baseModule['BaseModule']['programmer_contact'] : '',
                    'div' => 'form-group',
                    'class' => 'form-control'
                ));
                     
                echo $this->Metronic->input('comments', array(
                    'label' => 'Uwagi',
                    'value' => isset($baseModule['BaseModule']['comments']) ? $baseModule['BaseModule']['comments'] : '',
                ));               
                
                echo $this->Metronic->input('client_project_id', array(
                    'type' => 'hidden', 
                    'value' => isset($baseModule['BaseModule']['client_project_id']) ? $baseModule['BaseModule']['client_project_id'] : 0,
                ));
                
                echo $this->Metronic->input('id', array(
                    'type' => 'hidden', 
                    'value' => isset($baseModule['BaseModule']['id']) ? $baseModule['BaseModule']['id'] : 0,
                ));
            ?>
               
        </div>
        
        <button class="btn blue-madison" id="save_text_document" type="submit">Zapisz</button>
        
        <?php echo $this->Form->end(); ?>
     
    </div>
    </div>
</div>