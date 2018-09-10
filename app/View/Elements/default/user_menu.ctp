<!-- BEGIN USER LOGIN DROPDOWN -->
<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
<?php
$sessionAuthGroups = $this->Session->read('Auth.Groups');
$sessionAuthGroups = empty($sessionAuthGroups) ? array() : $sessionAuthGroups;
?> 
<li class="dropdown dropdown-user dropdown-dark" data-intro="<?php echo __d('public', 'Menu profilu. Umożliwia dostęp do metryki, zatrudnienia, celu osobistego, pm i febbooka') ?>" data-step="40">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
        <span class="username username-hide-on-mobile">
        <?php echo $this->Session->read('Auth.User.name'); ?> </span>
        <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
        <?php
        $userProfile = $this->Session->read('Auth.User');
        $avatarOptions = array('width' => '45', 'height' => '45', 'class' => 'img-circle', 'crop' => true);
        echo $this->element('default/avatar', compact('userProfile', 'avatarOptions'));
        ?>

    </a>
    <ul class="dropdown-menu dropdown-menu-default">
            <?php if ($this->Session->read('Auth.User._referer_id')): ?>
                <li>
                    <?php
                    echo $this->Html->link(
                            '<i class="icon-user"></i> '.__d('public', 'Powrót do konta ').$this->Session->read('Auth.User._referer_name'), 
                            array('plugin' => 'user', 'admin' => 'admin', 'controller' => 'users', 'action' => 'back_login'), array('escape' => false)
                    );
                    ?>
                </li>
            <?php endif; ?>
            <?php if (key($sessionAuthGroups) !== 'client'): ?>
            <li>
                <?php
                echo $this->Html->link(
                        '<i class="fa fa-folder-o"></i> '.__d('public', 'Metryka'), array(
                    'controller' => 'profiles',
                    'action' => 'metrics'
                        ), array('escape' => false)
                );
                ?>
            </li>
            <li>
                <?php
                echo $this->Html->link(
                        '<i class="fa fa-briefcase"></i> '.__d('public', 'Zatrudnienie'), array(
                    'controller' => 'vacations',
                    'action' => 'index'
                        ), array('escape' => false)
                );
                ?>
            </li>
            <li>
                <?php
                echo $this->Html->link(
                        '<i class="fa fa-crosshairs"></i> '.__d('public', 'Cel osobisty'), array(
                    'controller' => 'profiles',
                    'action' => 'personal_aim'
                        ), array('escape' => false)
                );
                ?>
            </li>
            <li>
                <?php
                echo $this->Html->link(
                        '<i class="fa fa-list-alt"></i> '.__d('public', 'PM'), array(
                    'controller' => 'pm',
                    'action' => 'index'
                        ), array('escape' => false)
                );
                ?>
            </li>
            <li>
                <?php
                echo $this->Html->link(
                        '<i class="icon-user"></i> '.__d('public', 'FEB Book'), array(
                    'controller' => 'social_books',
                    'action' => 'view'
                        ), array('escape' => false)
                );
                ?>
            </li>
        <?php endif; ?>
            <?php if (key($sessionAuthGroups) == 'client'): ?>
            <li>
                <?php
                echo $this->Html->link('<i class="fa fa-edit"></i> '.__d('public', 'Edytuj profil'), '/clients/profile', array('escape' => false));
                ?>
            </li>
<?php endif; ?>
        <li class="divider"></li>
        <li>
            <?php
            echo $this->Html->link('<i class="icon-key"></i> '.__d('public', 'Wyloguj'), '/user/users/logout', array('escape' => false));
            ?>
        </li>
    </ul>
</li>
<!-- END USER LOGIN DROPDOWN -->
