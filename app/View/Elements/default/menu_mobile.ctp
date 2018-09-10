<div class="page-sidebar-wrapper hidden-md hidden-lg" ng-controller="MenuCtrl">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li ng-class="{start: $index = 0}"  ng-cloak ng-repeat="menu in <?php echo a($rootMenus); ?>">
                <a href="{{menu.Menu.url}}">
                    <i class="{{menu.Menu.icon}}"></i> 
                    <span class="title">{{menu.Menu.name}}</span>
                    <span class="arrow" ng-show="menu.children"></span>
                </a>
                <ul class="sub-menu" ng-if="menu.children.length">
                    <li  ng-cloak ng-repeat="children in  menu.children">
                        <a href="{{children.Menu.url}}">{{children.Menu.name}}</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>