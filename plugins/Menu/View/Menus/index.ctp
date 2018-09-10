<?php echo $this->Metronic->portlet('Menu'); ?>
<div ng-controller="MenuCtrl" class="col-xs-12 menuEdit">
    <div class="row margin-bottom-15">
        <div class=" col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <select ng-change="change_groups(group)" ng-init="get_groups()" ng-model="group" ng-options="item.name for item in groups track by item.id " class="form-control"></select>
        </div>
        <div class=" col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <i class="fa fa-plus font-green font-large pull-right margin-top-5" ng-click="newItem()" tooltip="dodaj"></i>
            <i class="fa fa-openid font-red font-large pull-right margin-top-5"  ng-click="resetMenu()" tooltip="resetuj/napraw"></i>
            <a class="fa fa-download font-green font-large pull-right margin-top-5"  tooltip="exportuj" download href="/menu/menus/export.json"></a>
            <div class="pull-right">
                <i class="fa fa-upload font-red font-large pointer margin-top-5" ng-click="showImport = !showImport" tooltip="importuj"></i>
                <?php echo $this->Form->create('Menu', array('ng-show' => 'showImport','ng-cloak', 'action' => 'import', 'type' => 'file')); ?>
                <?php echo $this->Form->input('data', array('type' => 'file','label'=>false)); ?>
                <?php echo $this->Form->end('Zapisz'); ?>
            </div>
        </div>
    </div>
    <div class="row margin-bottom-15">
        <script type="text/ng-template" id="nodes_renderer.html">

            <div class="list-group-item" style="background: #f7f7f7;" ui-tree-handle>
            <div class="optionsDiv" ng-init='test = false'>
            <i ng-show="test" class="pointer fa fa-plus font-green" ng-click="newSubItem(this)" title="dodaj"></i>
            <i ng-show="test" class="pointer fa fa-trash font-red" ng-click="delete(this)" title="usuń"></i>
            <i ng-hide="test" class="pointer fa fa-edit font-green" ng-click="test = !test" title="Edytuj"></i>
            <i ng-show="test" class="pointer fa fa-eye-slash font-gray" ng-click="test = !test" title="Anuluj"></i>
            <i ng-show="test" class="pointer fa fa-save font-red" ng-click="editItem(this); test = !test" title="Zapisz"></i>
            </div>
            <div ng-hide="test">
            <i class="{{node.Menu.icon || 'fa fa-list'}}"></i> {{node.Menu.name}} <small>({{node.Menu.url}})</small>
            </div>
            <div ng-show="test">
            <input placeholder="pictogram" type="text" ng-model="node.Menu.icon"/>
            <label>Nazwa</label>
            <input type="text" ng-model="node.Menu.name" />
            <label>Link</label>
            <input type="text" ng-model="node.Menu.url" />
            </div>
            </div>
            <ol ui-tree-nodes="" ng-model="node.children">
            <li class="bg-white" ng-cloak ng-repeat="node in node.children" ui-tree-node ng-include="'nodes_renderer.html'">
            </li>
            </ol>
        </script>
        <div ui-tree="options" data-drag-enabled="true" data-max-depth="5" data-drag-delay="500">
            <ol ui-tree-nodes="" ng-model="data" id="tree-root">
                <li ng-cloak ng-repeat="node in data" ui-tree-node ng-include="'nodes_renderer.html'"></li>
            </ol>
        </div>
    </div>
    <?php echo $this->Metronic->portletEnd(); ?>