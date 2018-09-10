<div id="profile_cart"  ng-controller="ProfileCartCtrl" class="tile double widgetPeople default" 
       ng-class="{'bg-blue-steel':active ,
                   'default': <?php echo (int) !empty($profile['default']) ?>,
                   'bg-grey': !active}"
       >
    <div class="tile-body">
        <?php
        if (!empty($profile['User']))
        {
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
            <?php
            if (isset($profile['active']) && $user_permission)
            {
                ?>
                <i 
                    ng-init="active = <?php echo $profile['active']; ?>" 
                    ng-click="addUser2Project('<?php echo $profile['User']['id']; ?>',<?php echo $project_id; ?>, active)"  
                    tooltip-placement="right"
                    tooltip="<?php echo __d('public', 'Kliknij aby dodać/usunąć użytkownika') ?>"  class="fa fa-power-off font-yellow poitnier pull-left"></i>
                    <?php
                } else
                {
                    ?>
                <span ng-init="active = 1"></span>
            <?php } ?>
            <!--            
<i  title="Urlop" class="fa fa-ban default pull-left"></i>-->
            <?php
            if (empty($profile['default']))
            {
                ?>
                <a target="_blank" href="/social_books/view/<?php echo $profile['User']['email']; ?>">
                    <i tooltip-placement="right" tooltip="FEBbook" title="FEBbook" class="fa fa-plug font-yellow default pull-left"></i>
                </a>
                <?php
            }
            ?>
        </div>
        <!--        <div class="number" title="Ostanie logowanie">
                    2014.12.14 21:39
                </div>-->
    </div>
</div>