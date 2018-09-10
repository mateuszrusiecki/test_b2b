<div class="page-sidebar-wrapper hidden-xs hidden-sm">
    <div class="hor-menu hor-menu-light">
        <?php
        $rootMenus = (!empty($rootMenus) && is_array($rootMenus)) ? $rootMenus : array();
        foreach ($rootMenus as $menu)
        {
            ?>
            <ul class="nav navbar-nav" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                <li class="classic-menu-dropdown">

                    <?php
                    if (!empty($menu['children']))
                    {
                        ?>
                        <a href="<?php echo $menu['Menu']['url'] ?>" 
                           data-toggle="dropdown" 
                           data-close-others="true" 
                           data-hover="dropdown"
                           class="text_center">
                            <i class="<?php echo $menu['Menu']['icon'] ?>"></i>
                            <br class="hidden-sm" />
                            <span class="title hidden-sm"><?php echo $menu['Menu']['name'] ?></span>
                            <br>
                            <i class="fa fa-angle-down "></i>
                        </a>

                        <ul class="dropdown-menu pull-left"  >
                            <?php
                            foreach ($menu['children'] as $child)
                            {
                                ?>
                                <li>
                                    <a href="<?php echo $child['Menu']['url']; ?>"><?php echo $child['Menu']['name']; ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                        <?php
                    } else
                    {
                        ?>
                        <a href="<?php echo $menu['Menu']['url']; ?>" 
                           class="text_center">
                            <i class="<?php echo $menu['Menu']['icon']; ?>"></i>
                            <br class="hidden-sm" />
                            <span class="title hidden-sm"><?php echo $menu['Menu']['name']; ?></span>
                        </a>
                    <?php } ?>
                </li>

            </ul>
        <?php } ?>
    </div>
</div>