<div id="profile_feb_cart"  ng-controller="ProfileCartCtrl" 
       class="tile double userTile " 
       ng-class="{'bg-blue-steel':active ,
                   'default': <?php echo (int) !empty($profile['default']) ?>,
                   'bg-grey-silver': !active
       }"
       <!--                   ng-cloak
       ng-class="{
           'hoverLink':  hoverLink,
           'hover': hover,
           'bg-purple':user.UserSection.section_id%5 == 0,
           'bg-red-sunglo':user.UserSection.section_id%5 == 1,
           'bg-blue-madison':user.UserSection.section_id%5 == 2,
           'bg-yellow':user.UserSection.section_id%5 == 3,
           'bg-green':user.UserSection.section_id%5 == 4,
           'bg-grey-silver':!user.UserSection.section_id
       }" -->
       <div>
        <div class="tile-left">
            <h3 id="profile_name_<?php if(isset($profile['Profile']['id']))echo $profile['Profile']['id']; ?>"><?php echo $profile['Profile']['name']; ?></h3>
            <p><?php echo $profile['Profile']['position']; ?></p>
            <div class="tile-icons">
                <a 
                    ng-if="user.SocialBook.facebook" 
                    href="http://facebook.com/{{user.SocialBook.facebook}}" 
                    target="_blank"
                    tooltip="{{user.SocialBook.facebook}}"
                    >
                    <i class="fa fa-facebook">
                    </i>
                </a>

                <i
                    ng-if="user.Profile.work_phone"
                    class="fa fa-phone" 
                    tooltip="{{user.Profile.work_phone}}">
                </i>
                <a href="mailto:{{user.User.email}}">
                    <i class="fa fa-at" 
                       tooltip="{{user.User.email}}">
                    </i>
                </a>
                <?php if (isset($profile['active']) && isset($clientProject['ClientProject']['user_id']) && ($clientProject['ClientProject']['user_id'] == $user_id)) { ?>
                    <i ng-init="active = <?php echo (int)$profile['active']; ?>" 
                        ng-click="addUser2Project('<?php echo $profile['User']['id']; ?>',<?php echo $project_id; ?>, active)"  
                        tooltip-placement="right"
                        tooltip="<?php echo __d('public', 'Kliknij aby dodać/usunąć użytkownika') ?>"  class="fa fa-power-off font-yellow poitnier"></i>
                <?php } elseif(isset($profile['active'])) { ?>
                    <span ng-init="active = <?php echo $profile['active']; ?>" tooltip="<?php echo __d('public', 'Tylko koordynator może dodawać lub usuwać osob z projektu') ?>"></span>
                <?php } else { ?>
                    <span ng-init="active = 1" tooltip="<?php echo __d('public', 'Tylko koordynator może dodawać lub usuwać osob z projektu') ?>"></span>
                <?php } ?>
            </div>
            <a ng-mouseover="hoverLink = true" 
               ng-mouseleave="hoverLink = false" 
               href="/social_books/view/<?php echo $profile['User']['email']; ?>" 
               class="poitnier btn btn-sm margin-bottom pull-left default">
                <?php echo __d('public', 'Zobacz') ?>
            </a>
        </div>
        <div class="tile-right" 
             ng-mouseover="hover = true" 
             ng-mouseleave="hover = false" 
             >
            <a href="/social_books/view/{{user.User.email}}">
<!--                <img ng-init="src = user.User.avatar_url || '/files/user/' + user.User.avatar" ng-if="user.User.avatar || user.User.avatar_url" ng-src="{{src}}" width="135" height="135" class="center" />
                <img ng-if="!user.User.avatar && !user.User.avatar_url" src="/assets/admin/pages/media/profile/avatar.png" width="135" height="135" class="center" />-->
                <?php
                if (!empty($profile['User'])) {
                    $userProfile = $profile['User'];
                    $avatarOptions = array('width' => '135', 'height' => '135', 'class' => 'pull-right');
                    echo $this->element('default/avatar', compact('userProfile', 'avatarOptions'));
                }
                ?>
            </a>
        </div>
    </div>

</div>
