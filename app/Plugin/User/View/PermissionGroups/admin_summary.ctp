<?php
$this->set('title_for_layout', __d('cms', 'Uprawnienia') . ' &bull; ' . __d('cms', 'Konfigurator grup uprawnień'));
?>
<?php echo $this->Html->script('jquery-ui.min', array('inline' => false)); ?> 
<?php echo $this->Html->css('/user/css/permission', null, array('inline' => false)); ?>
<?php //echo $this->Html->script('/user/js/jquery.cookie', array('inline' => false)); ?>
<?php echo $this->Html->css('/user/css/skin/ui.dynatree', null, array('inline' => false)); ?>
<?php echo $this->Html->css('/user/css/contentMenu/jquery.contextMenu', null, array('inline' => false)); ?>
<?php echo $this->Html->script('/user/js/jquery.dynatree', array('inline' => false)); ?>
<?php echo $this->Html->script('/user/js/jquery.contextMenu', array('inline' => false)); ?>

<?php echo $this->Metronic->portlet('Konfigurator grup uprawnień'); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'New Permission Category'), array('controller' => 'permission_categories', 'action' => 'add'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
    <?php echo $this->Permissions->link(__d('cms', 'List Permission Categories'), array('controller' => 'permission_categories', 'action' => 'index'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
    <?php echo $this->Permissions->link(__d('cms', 'Przeładowanie tabeli uprawnień'), array('action' => 'fix'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
    <?php echo $this->Permissions->link(__d('cms', 'Export uprawnień'), array('action' => 'export'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
    <?php echo $this->Permissions->link(__d('cms', 'Import uprawnień'), array('action' => 'import'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
<div id="PermissionGroup" class="permissionGroup summary">    

    <div class="clearfix">

        <div class="fl categoryGroupTree">
            <form>               
                <fieldset>
                    <legend><?php echo __d('cms', 'Drzewo kategorii uprawnień'); ?></legend>

                    <ul class="categoryTree">
                    </ul>

                </fieldset> 
            </form>
            <div id="PermissionActionInfo">
                <?php echo $this->Html->image('cms/ajax-loader.gif', array('class' => 'loader')); ?>
                <div class="contentMessage">
                    Brak komunikatów.
                </div>
            </div>
            <div id="PermissionGroupBox" class="permissionGroupBox edit">

            </div>
        </div>

        <div class="fl permissionTree">
            <ul class="permissionTree">
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">

    var updatePermissionGroupContent = function (href, callback) {
        $('#PermissionActionInfo .loader').show();
        $.ajax({
            url: href,
            dataType: 'html',
            success: function (html) {
                $('#PermissionActionInfo .loader').hide();
                $('#PermissionGroupBox').html(html);
                callback();
            }
        });
    }

    var getPermissions = function () {

        var permissionGroupId = $('#PermissionGroupId').attr('value');
        if (typeof (permissionGroupId) == 'undefined') {
            alert('Zaznacz wpierw grupę uprawnienia koleszko ;-)');
            return false
        }
        ;
        $.ajax({
            url: '<?php echo $this->Html->url(array('controller' => 'permission_groups', 'action' => 'get_permissions')); ?>',
            dataType: 'html',
            type: 'POST',
            data: {
                data: {
                    PermissionGroup: {
                        id: permissionGroupId
                    }
                }
            },
            success: function (html) {
                $('#permissionsWithGroup').html(html);
            }
        });
    }
    var getActionDetalis = function (node) {
        $('#PermissionActionInfo').css('min-height', $('.PermissionActionInfo').height());
        $('#PermissionActionInfo .loader').show();
        $.ajax({
            url: '<?php echo $this->Html->url(array('controller' => 'permissions', 'action' => 'view')); ?>',
            dataType: 'html',
            type: 'POST',
            data: {
                data: {
                    Permission: {
                        'name': node.data.key
                    }
                }
            },
            success: function (html) {
                $('#PermissionActionInfo .loader').hide();
                $('#PermissionActionInfo .contentMessage').html(html);
            }
        });
    }


    $(function () {
        $(".categoryTree").dynatree({
            debugLevel: 0,
            persist: true,
            initAjax: {
                url: "<?php echo $this->Html->url(array('controller' => 'permission_categories', 'action' => 'refresh_tree')); ?>"
            },
            autoCollapse: false,
            onActivate: function (node) {
                if (!node.data.isFolder) {
                    updatePermissionGroupContent(node.data.editHref, function () {
                        getPermissions();
                    });
                }
            },
            onCreate: function (node, span) {
                bindContextMenu(node, span, this);
            }
        });

        $(".permissionTree").dynatree({
            debugLevel: 0,
            persist: true,
            initAjax: {
                url: "<?php echo $this->Html->url(array('controller' => 'permissions', 'action' => 'generate_tree')); ?>"
            },
            autoCollapse: false,
            onDblClick: function (node, event) {

                var permissionGroupId = $('#PermissionGroupId').attr('value');
                if (typeof (permissionGroupId) == 'undefined') {
                    alert('Zaznacz wpierw grupę uprawnienia koleszko ;-)');
                    return false
                }
                ;
                if (node.data.isGrupped) {
                    if (!confirm('Uprawnienie jest obecnie przypisane do grupy, jesteś pewny przydzielenia go do innej?')) {
                        return false;
                    }
                }
                $('#PermissionActionInfo .loader').show();
                $.ajax({
                    url: '<?php echo $this->Html->url(array('controller' => 'permissions', 'action' => 'add')); ?>',
                    dataType: 'json',
                    type: 'POST',
                    data: {
                        'Permission': {
                            'name': node.data.key,
                            'permission_group_id': permissionGroupId
                        }
                    },
                    success: function (data) {
                        node.data.isGrupped = true;
                        getActionDetalis(node);
                        getPermissions();

                    },
                    error: function () {
                        alert('Niezidentyfikowany blad, popraw ;p')
                        $('#PermissionActionInfo .loader').hide();
                    }
                });
            },
            onActivate: function (node) {
                if (!node.data.isFolder) {
                    getActionDetalis(node);
                }
            }
        });

        function bindContextMenu(node, span, menu) {
            if (node.data.isFolder) {
                $(span).contextMenu({menu: "permissionCategoryMenu"}, function (action, el, pos) {
                    switch (action) {
                        case "add":
                            updatePermissionGroupContent(node.data.addHref, function () {
                                $('.categoryTree').css('min-height', $('.categoryTree').height());
                                menu.reload();
                            });
                        default:

                    }
                });
            } else {
                $(span).contextMenu({menu: "permissionGroupMenu"}, function (action, el, pos) {
                    switch (action) {
                        case "delete":
                            if (!confirm('Pamietaj, że zostaną rozgrupowane wszystkie powiązane uprawnienia!!!')) {
                                break;
                            }
                            $.ajax({
                                url: node.data.delHref,
                                dataType: 'html',
                                success: function () {
                                    $('.categoryTree').css('min-height', $('.categoryTree').height());
                                    menu.reload();
                                }
                            });
                            $('#PermissionGroupBox').html('');
                            break;
                        case "edit":
                            updatePermissionGroupContent(node.data.editHref, function () {
                                $('.categoryTree').css('min-height', $('.categoryTree').height());
                                menu.reload();
                            });
                            break;
                        default:
                    }
                });
            }

        }
        ;
    });
</script>

<?php $this->start('PermissionGroupContentMenu'); ?>
<ul id="permissionCategoryMenu" class="contextMenu">
    <li class="edit"><a href="#add"><?php echo __d('cms', 'Nowa grupa'); ?></a></li>
    <li class="quit separator"><a href="#quit"><?php echo __d('cms', 'Zamknij'); ?></a></li>
</ul>
<ul id="permissionGroupMenu" class="contextMenu">
    <li class="delete"><a href="#delete"><?php echo __d('cms', 'Usuń grupę'); ?></a></li>
    <li class="edit"><a href="#edit"><?php echo __d('cms', 'Edytuj grupę'); ?></a></li>
    <li class="quit separator"><a href="#quit"><?php echo __d('cms', 'Zamknij'); ?></a></li>
</ul>
<?php
$this->end();
echo $this->fetch('PermissionGroupContentMenu');
?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>


