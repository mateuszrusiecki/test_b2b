<!-- BEGIN USER LOGIN DROPDOWN -->
<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
<li class="dropdown dropdown-user dropdown-dark">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
        <span class="username username-hide-on-mobile"> <?php echo __d('public', 'Niezalogowany') ?> </span>
        <img src="/assets/admin/pages/media/profile/avatar.png" class="img-circle" width="45" height="45" alt="<?php echo __d('public', 'Niezalogowany') ?>">

    </a>
    <ul class="dropdown-menu dropdown-menu-default">
        
        <li>
            <?php
            echo $this->Html->link('<i class="icon-key"></i> '.__d('public', 'Zaloguj'), '/user/users/login', array('escape' => false));
            ?>
        </li>
    </ul>
</li>
<!-- END USER LOGIN DROPDOWN -->
