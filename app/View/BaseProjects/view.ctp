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
                __d('public', 'Powrót do listy'), array('controller' => 'base_projects', 'action' => 'index'), array('class' => 'btn btn-sm yellow margin-bottom pull-right ml')
            );
        ?>
    </div>
    <div class="portlet-body" ng-controller="BaseProjectCtrl">       
        
        <strong><?php echo __d('public', 'Słowa kluczowe') ?></strong>
        <p><?php echo $baseProject['BaseProject']['tags']; ?></p>
        
        <strong><?php echo __d('public', 'Kierownik kontaktowy') ?></strong>
        <p><?php echo $baseProject['Coordinator']['Profile']['name']; ?></p>
        
        <strong><?php echo __d('public', 'Programista kontaktowy') ?></strong>
        <p><?php echo $baseProject['Programmer']['Profile']['name']; ?></p>
        
        <strong><?php echo __d('public', 'Językowość') ?></strong>
        <p><?php echo $baseProject['BaseProject']['languages'] == 1 ? 'Tak' : 'Nie'; ?></p>
        
        <strong><?php echo __d('public', 'Opis') ?></strong>    
        <div class="specification-container">
            <p><?php echo $baseProject['BaseProject']['description']; ?></p>
        </div>
    </div>
</div>