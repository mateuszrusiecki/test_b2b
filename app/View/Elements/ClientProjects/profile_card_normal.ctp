<div   ng-controller="ProfileCartCtrl" 
       class="tile double bg-blue-steel widgetPeople" 
       ng-class="{'bg-blue-steel':active ,
                   'default': <?php echo (int) !empty($profile['default']) ?>,
                   'bg-grey': !active}"
       >
    <div class="tile-body">
        <?php
        if (!empty($profile['User'])) {
            $userProfile = $profile['User'];
            $avatarOptions = array('width' => '65', 'height' => '65', 'class' => 'pull-right');
            echo $this->element('default/avatar', compact('userProfile', 'avatarOptions'));
        }
        ?>
        <h3><?php echo $profile['Profile']['name']; ?></h3>
        <p>
            <?php echo $profile['Profile']['position']; ?>
            <br>
            <br>
        </p>
    </div>
    <div class="tile-object">
        <div class="name">
            <?php if (isset($profile['active'])) { ?>
                <i  
                   ng-init="active = <?php echo $profile['active']; ?>" 
                   ng-click="addUser2Project('<?php echo $profile['User']['id']; ?>',<?php echo $project_id; ?>, active)"  title="<?php echo __d('public', 'Dodaj do projektu') ?>" class="fa fa-power-off font-yellow poitnier pull-left"></i>
            <?php } else { ?>
                <span ng-init="active = 1"></span>
             <?php } ?>
            <a href="#">
                <i  tooltip="FEBbook" title="FEBbook" class="fa fa-plug font-yellow default poitnier pull-left"></i>
            </a>
        </div>
    </div>
</div>