<div aria-hidden="true" role="upload_project_file_version" tabindex="-1" id="upload_project_file_version" class="modal fade add_project_file_ajax ng-cloak" my-modal   ng-controller="ProjectFilesCtrl">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo __d('public', 'Wybierz plik'); ?></h4>
				<pre>{{ $scope.input.tmp_id }}</pre>
            </div>
            <div class="modal-body row">

                                <!--<textarea class="ng-hide" name="data[parent]">{{ projectFileObject.file_update_id }}</textarea>-->



                <div class="col-md-4">
                    <?php
                    echo $this->Metronic->input('project_project_file_category_id', array(
                        'label' => false,
                        'class' => 'form-control clear',
                        'options' => $fileCategory,
                        'type' => 'select',
                        'ng-model' => 'input.project_project_file_category_id',
                        'empty' => __d('public', 'wybierz kategorię')
                    ));
                    ?>
                </div>
                <div class="col-md-4">
                    <?php
                    echo $this->Metronic->input('section_id', array(
                        'label' => false,
                        'class' => 'form-control clear',
                        'type' => 'select',
                        'ng-model' => 'input.section_id',
                        'empty' => __d('public', 'wybierz Sekcje')
                    ));
                    ?>
                </div>

                <?php
                if (empty($clientProject['ClientProject']['id']))
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
                } else
                {
                    echo $this->Form->input('client_project_id', array(
                        'ng-init' => 'input.client_project_id = ' . $clientProject['ClientProject']['id'],
                        'ng-model' => 'input.client_project_id',
                        'type' => 'hidden',
                        'label' => false
                    ));
                }
                /*
                  watching model:
                  <div class="button" ng-file-select ng-model="files">Upload using model $watch</div>
                  <div class="button" ng-file-select ng-file-change="upload($files)">Upload on file change</div>
                  Drop File:
                 */
                ?>
                <div class="col-md-12" ng-show="input.project_file_category_id">
                    <div ng-file-select ng-file-drop ng-model="files" class="drop-box" drag-over-class="dragover" ng-multiple="true" allow-dir="true" accept=".jpg,.png,.pdf,.doc,.docx,.xls,.xlsx,.txt,.csv">
                        <?php echo __d('public', 'Aby dodać dokumenty przeciągnij tutaj pliki lub kliknij tutaj') ?><br /><br />
                        <span class="hidden-xs">(<?php echo __d('public', 'pliki zostaną przesłane automatycznie') ?>)</span>
                    </div>
                    <div ng-no-file-drop><?php echo __d('public', 'File Drag/Drop is not supported for this browser') ?></div>
                </div>
                <div class="col-md-12">
                    <div ng-if="!input.project_file_category_id" class="panel panel-default margin-top-15">
                        <div class="panel-heading  bg-red">
                            <h3 class="panel-title font-white"><?php echo __d('public', 'Kategoria jest wymagana aby wysłać pliki') ?></h3>
                        </div>
                    </div>
                    <div ng-if="files.length" class="panel panel-success margin-top-15">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo __d('public', 'Przesłane pliki') ?></h3> 

                        </div>
                        <table class="table">
                            <tbody>
                                <tr ng-cloak ng-repeat="file in files">
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
            </div>
            <div class="modal-footer">

                <button  data-dismiss="modal" class="btn default " type="button"><?php echo __d('public', 'Zamknij'); ?></button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php $this->Html->script('angular/controllers/ProjectFilesCtrl', array('block' => 'angular')); ?>