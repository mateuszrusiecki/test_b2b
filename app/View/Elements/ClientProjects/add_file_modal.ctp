<div ng-cloak class="modal-backdrop fade in ng-cloak" ng-show="addProjectFiles"></div>
<div ng-cloak aria-hidden="true" tabindex="-1" ng-show="addProjectFiles" class="add_project_file_ajax angular-modal ng-cloak">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" ng-click="addProjectFiles = false;
                    $parent.$parent.bodyHidden = false;
                    modalUploadFiles = [];
                    bodyHidden = false;" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo __d('public', 'Wybierz plik'); ?></h4>
            </div>
            <div class="modal-body">

                                <!--<textarea class="ng-hide" name="data[parent]">{{ projectFileObject.file_update_id }}</textarea>-->

                <div class="scroller" style="height:270px" data-always-visible="1" data-rail-visible="0">
                    <div class="clearfix row">
                        <div class="col-xs-12">
                            <div ng-if="modalUploadFiles.length" class="panel panel-success">
                                <!-- Default panel contents -->
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo __d('public', 'Przesłane pliki') ?></h3> 

                                </div>
                                <table class="table">
                                    <tbody>
                                        <tr ng-cloak ng-repeat="file in modalUploadFiles">
                                            <td class="hidden-xs">
                                                {{$index + 1}}.
                                            </td>
                                            <td>
                                                {{file.name}}
                                            </td>
                                            <td>
                                                <i ng-class="{'fa':true,
                                                    'fa-spin':!file.progress,
                                                    'fa-spinner':!file.progress,
                                                    'fa-close':file.progress == 'error',
                                                    'font-red':file.progress == 'error',
                                                    'fa-check':file.progress == 'success',
                                                    'font-green':file.progress == 'success'
                                        }"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <?php
                            echo $this->Metronic->input('project_file_category_id', array(
                                'label' => false,
                                'class' => 'form-control clear',
                                'options' => $fileCategory,
                                'type' => 'select',
                                'ng-model' => 'input.project_file_category_id',
                                'empty' => __d('public', 'wybierz kategorię')
                            ));
                            ?>
                        </div>
                        <div class="col-md-4">
                            <?php
                            echo $this->Metronic->input('section_id', array(
                                'label' => false,
                                'class' => 'form-control clear',
                                'options' => $sections,
                                'type' => 'select',
                                'ng-model' => 'input.section_id',
                                'empty' => __d('public', 'wybierz dział')
                            ));
                            ?>
                            <i class="fa fa-info-circle font-green cursor-help" tooltip-placement="bottom" tooltip="<?php echo __d('public', 'Wybierz odpowiedni dział do którego zostanie przypisany plik') ?>"></i>
                        </div>

                        <?php
                        if (empty($clientProject['ClientProject']['id']) && empty($lead['ClientLead']['id']))
                        {
                            ?>
                            <div class="col-md-4">
                                <?php
                                echo $this->Metronic->input('client_project_id', array(
                                    'label' => false,
                                    'class' => 'form-control clear',
                                    'options' => $listProjects,
                                    'type' => 'select',
                                    'ng-model' => 'input.client_project_id',
                                    'empty' => __d('public', 'wybierz projekt')
                                ));
                                ?>
                            </div>
                            <?php
                        }
                        ?>


                        <div  class="col-md-12">
                            <div class="input checkbox">
                                <checkbox ng-model="input.desc_check" ng-init="input.desc_check = <?php echo (int) !empty($clientProject['ClientProject']['desc']); ?>" ></checkbox>
                                <label ng-click="input.desc_check = !input.desc_check">Dodaj opis</label>
                            </div>
                            <textarea 
                                ng-model="input.desc"
                                class="col-md-12 mb5 form-control margin-bottom-10"
                                ng-if="input.desc_check"
                                >
                            </textarea>
                        </div>
                        <div class="col-md-12" ng-show="input.project_file_category_id && !input.id && input.section_id">
                            <div ng-file-select ng-file-drop ng-model="modalUploadFiles" class="drop-box" drag-over-class="dragover" ng-multiple="true" allow-dir="true" accept=".jpg,.png,.pdf,.doc,.docx,.xls,.xlsx,.txt,.csv">
                                <?php echo __d('public', 'Aby dodać dokumenty przeciągnij tutaj pliki lub kliknij tutaj') ?><br /><br />
                                <span class="hidden-xs">(<?php echo __d('public', 'pliki zostaną przesłane automatycznie') ?>)</span>
                            </div>
                            <div ng-no-file-drop><?php echo __d('public', 'File Drag/Drop is not supported for this browser') ?></div>
                        </div>
                        <div  class="col-md-12" ng-show="input.id">
                            <div class="input checkbox">
                                <checkbox ng-model="input.file_check"></checkbox>
                                <label ng-click="input.file_check = !input.file_check"><?php echo __d('public', 'zmień plik') ?></label>
                            </div>
                        </div>
                        <div class="col-md-12" ng-show="input.project_file_category_id && input.id && input.file_check && input.section_id">
                            <div ng-file-select ng-file-drop ng-model="modalUploadFiles" class="drop-box" drag-over-class="dragover" ng-multiple="false" allow-dir="true" accept=".jpg,.png,.pdf,.doc,.docx,.xls,.xlsx,.txt,.csv">
                                <?php echo __d('public', 'Aby edytować dokument przeciągnij tutaj plik lub kliknij tutaj') ?><br /><br />
                                <span class="hidden-xs">(<?php echo __d('public', 'plik zostanie automatycznie zwersjonowany') ?>)</span>
                            </div>
                            <div ng-no-file-drop><?php echo __d('public', 'File Drag/Drop is not supported for this browser') ?></div>
                        </div>
                        <div class="col-md-12">
                            <div ng-if="!input.project_file_category_id|| !input.section_id" class="panel panel-default margin-top-15">
                                <div class="panel-heading  bg-red">
                                    <h3 class="panel-title font-white"><?php echo __d('public', 'Kategoria i dział jest wymagany aby wysłać pliki') ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button ng-click="addProjectFiles = false;
                    $parent.$parent.bodyHidden = false;
                    modalUploadFiles = [];
                    bodyHidden = false;" class="btn default " type="button"><?php echo __d('public', 'Zamknij'); ?></button>
                <button ng-show="input.id && !input.file_check" ng-click="save()" class="btn btn-danger " type="button"><?php echo __d('public', 'Zapisz'); ?></button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php $this->Html->script('angular/controllers/ProjectFilesCtrl', array('block' => 'angular')); ?>