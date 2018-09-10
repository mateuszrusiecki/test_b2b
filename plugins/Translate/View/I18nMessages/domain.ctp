<div ng-app="">
    <?php $this->set('title_for_layout', __d('cms', 'Domena')); ?>
    <?php $this->Html->addCrumb('Lista domen', array('action' => 'domains')); ?>

    <div class="clearfix mb5">
        <div ng-click="messages.unshift({msgid: ''});
            currentPage = 1" class="btn btn-sm green-haze btn-sm margin-bottom pull-right">Dodaj nowe</div>
    </div>
    <?php echo $this->Form->create(); ?>
    <div class="i18nMessages index" ng-init="messages = <?php echo  empty($messages)?'[]':h(json_encode($messages)); ?>">
        <div class="translate-box" ng-repeat="(index,data) in messages" ng-cloak>
            <h4 class="block">
                <div class="pull-right">
                    <i ng-click="msgctxt = !msgctxt" class="fa fa-language" tooltip="Edytuj kategorie"></i>
                    <i ng-click="msgid = !msgid" class="fa fa-edit poitnier" tooltip="Edytuj klucz"></i>
                    <?php /* / ?>
                    <i class="fa fa-list-ol" ng-click="msgstr_plural = !msgstr_plural" ng-init="msgstr_plural = !!data.msgstr_plural" tooltip="liczebniki"></i> 
                    <i class="fa fa-database font-red" ng-show="data.base" toolti="Dane z bazy : {{data.base}}" ng-click="base = !base"></i>
                    <i class="fa fa-trash-o" tooltip="Usuń" ng-click="data.deleted = !data.deleted"></i> 
                    <?php /**/ ?>

                </div>
                {{data.msgid}} <span ng-show="data.msgctxt">({{data.msgctxt}})</span>&nbsp;
                <div class="clearfix">
                    <div class="pull-right poitnier">
                        <div ng-show="data.deleted" class="font-red" ng-click="messages.splice(index, 1)"> Kliknij tutaj aby potwierdzić usunięcie</div>
                        <div ng-show="base">{{data.base}}</div>
                    </div>
                </div>
            </h4>
            <label ng-show="msgctxt">Kategoria</label>
            <input ng-show="msgctxt" name="data[{{$index}}][msgctxt]" value="{{data.msgctxt}}" type="text" class="form-control mb5">

            <label ng-show="msgid || !data.msgid">Klucz</label>
            <input ng-show="msgid || !data.msgid" name="data[{{$index}}][msgid]" ng-model="data.msgid" type="text" class="form-control mb5">

            <textarea ng-if="!msgstr_plural" name="data[{{$index}}][msgstr]" class="form-control" ng-model="data.msgstr">
            
            </textarea>
            <input ng-if="msgstr_plural" name="data[{{index}}][msgstr_plural][0]" class="form-control" ng-model="data.msgstr_plural['0']">
            <input ng-if="msgstr_plural" name="data[{{index}}][msgstr_plural][1]" class="form-control" ng-model="data.msgstr_plural['1']">
            <input ng-if="msgstr_plural" name="data[{{index}}][msgstr_plural][2]" class="form-control" ng-model="data.msgstr_plural['2']">
        </div>
        <div class="pull-right">
            <?php
            echo $this->Form->submit('Zapisz', array('class' => 'btn blue-madison pull-right'));
            ?>
        </div>

    </div>
    <?php
    echo $this->Form->end();
    ?>
    <?php echo $this->Html->script('/libs/angular/angular.js'); ?>
    <?php echo $this->Html->css('/libs/font-awesome/css/font-awesome'); ?>
</div>