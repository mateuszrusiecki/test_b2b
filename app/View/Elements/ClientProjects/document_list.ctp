
<!--Pliki są zaciągane z /project_files/get_files-->

<?php echo $this->Metronic->portlet(__d('public', 'Dokumenty'), 0, 'fa fa-file-text', 'red'); ?>
<div class="project_documents">
    <div ng-controller="ProjectFilesCtrl" class="project_documents"  ng-init="user_authorized = '<?php echo $_SESSION['user_permission'] ?>'">

        <a id="project_documents" name="project_documents" class="anchor" ></a>

        <?php echo $this->element('ClientProjects/document_list_modals'); ?>

        <?php
        echo $this->Form->create('ProjectFiles', array(
            'url' => array(
                'controller' => 'client_projects',
                'action' => 'files_download'
            ), 'class' => 'form-horizontal'
        ));
        ?>

        <hr class="small_hr clearfix"/>
        <div class="clearfix">
            <div class="pull-left ng-cloak">
                <a ng-hide="user_permission == 'client'" ng-click="addProjectFiles = true;
                            $parent.$parent.bodyHidden = true;
                            input = {};
                            input.client_project_id = '<?php echo $clientProject['ClientProject']['id'] ?>';" class="pointer" tooltip="<?php echo __d('public', 'Dodaj plik'); ?>">
                    <span class="glyphicon glyphicon-open"> </span>
                </a>

                <span class="glyphicon-input glyphicon glyphicon-save">
                    <?php echo $this->Form->submit('', array('class' => '', 'tooltip' => 'Pobierz zaznaczone pliki', 'div' => false, ' ng-click' => 'onDownloadFiles($event)')); ?>
                    <textarea class="ng-hide" name="data[file_id]">{{ files}}</textarea>
                </span>

                <!-- @todo [TODO] do zrobienia dodawanie do TC-->
                <a ng-hide="user_permission == 'client'" href="#tc" tooltip="<?php echo __d('public', 'Utwórz nowy dokument TC'); ?>" data-toggle="modal">
                    <span class="glyphicon glyphicon-file"> <i class="fa fa-plus"></i> </span>
                </a>
                <!--/ todo [TODO] do zrobienia dodawanie do TC /-->

                <a ng-hide="user_permission == 'client'" ng-if="user_authorized" href="#delete_project_file" data-toggle="modal" tooltip="<?php echo __d('public', 'Usuń zaznaczone pliki'); ?>">
                    <span class="glyphicon glyphicon-trash"> </span>
                </a>
            </div>
            <div class="pull-right">
                <div class="btn red-sunglo dziwny_przycisk" ng-if="selectFile" ng-hide="hidde_after_time">
                    {{ selectFile}}
                </div>

                <i ng-init="checkAllButton = false"></i>
                <div ng-if="checkAllButton == false" class="btn default dziwny_przycisk" ng-click="checkAll()">
                    <?php echo __d('public', 'Zaznacz wszystkie'); ?>
                </div>

                <div ng-if="checkAllButton == true" class="btn default dziwny_przycisk" ng-click="uncheckAll()">
                    <?php echo __d('public', 'Odznacz wszystkie'); ?>
                </div>
            </div>
        </div>
        <hr class="small_hr clearfix"/>

        <?php
        echo $this->Form->input('client_project_id', array(
            'type' => 'hidden',
            'ng-init' => "project_id=" . $clientProject['ClientProject']['id'],
            'label' => false
        ));
        ?>

        <div class="getFiles" ng-init="getFiles(); deleteFileType = 'project';"></div>

        <div class="clearfix" >
            <form class="form clearfix">
                <div class="form-body  col-md-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-icon right">
                            <i class="icon-magnifier"></i>
                            <input type="text" placeholder="<?php echo __d('public', 'Szukaj') ?>..." class="form-control ng-pristine ng-valid ng-touched" ng-model="filesearch.$">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-scrollable">
            <?php echo $this->element('ProjectFiles/table'); ?>
        </div>
        <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentFilePag" items-per-page="10" total-items="files  | obj2arr | sectionFilter: section | filter:filesearch | length" boundary-links="true"></pagination>

        <?php echo $this->Form->end(); ?>
    </div>

</div>
<?php echo $this->Metronic->portletEnd(); ?>


<?php echo $this->Html->script('angular/controllers/ClientProjectViewDocumentCtrl.js', array('block' => 'angular')); ?>