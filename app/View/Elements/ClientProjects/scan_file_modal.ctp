<div ng-cloak class="modal-backdrop fade in ng-cloak" ng-show="scanProjectFiles"></div>
<div ng-cloak aria-hidden="true" tabindex="-1" ng-show="scanProjectFiles" class="add_project_file_ajax angular-modal ng-cloak">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" ng-click="scanProjectFiles = false;
                    $parent.$parent.bodyHidden = false;
                    bodyHidden = false;" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo __d('public', 'Skanuj plik'); ?></h4>
            </div>
            <div class="modal-body">

                                <!--<textarea class="ng-hide" name="data[parent]">{{ projectFileObject.file_update_id }}</textarea>-->

                <div class="scroller" style="height:270px" data-always-visible="1" data-rail-visible="0">
                    <div class="clearfix row">

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
                        }
                        ?>


                        <div  class="col-md-12">
                            <div class="input checkbox">
                                <checkbox ng-model="input.desc_check" ng-init="input.desc_check = <?php echo (int) !empty($clientProject['ClientProject']['desc']); ?>" ></checkbox>
                                <label ng-click="input.desc_check = !input.desc_check">dodaj opis</label>
                            </div> 
                            <textarea 
                                ng-model="input.desc"
                                class="col-md-12 mb5 form-control margin-bottom-10"
                                ng-if="input.desc_check"
                                >
                            </textarea>
                            <i title="jak zainstalować skanner" ng-click="scanerInfo = !scanerInfo" class="fa fa-info-circle font-red font-large pointer"></i><br>
                        </div>

                        <div class="col-md-12" ng-show="scanerInfo">
                            1. <?php echo __d('public', 'Instalacja Java') ?> <a target="_blank" href="https://java.com/pl/download/">(<?php echo __d('public', 'link') ?>)</a><br>
                            2. <?php echo __d('public', 'Odblokowanie Java w przeglądarce "Pozwól teraz i zapamiętaj"') ?><br>
                            3. <?php echo __d('public', 'Pobierz sterownik zainstaluj sterownik') ?> <a target="_blank" href="http://wsparcie.feb.net.pl:8888/!drukarki/b4/UniversalScanDriver_V1.02.19.exe">(<?php echo __d('public', 'link') ?>)</a><br>
                            4. <?php echo __d('public', 'Uruchom program skanera i wybierz urządzenie a następnie zapisz ustawienia') ?><br>
                            5. <?php echo __d('public', 'Skanuj w aplikacji') ?> feb.b2b<br>
                            <?php echo __d('public', 'Usługa skanowania działa z przeglądarka firefox oraz Internet Explorer') ?><br>
                        </div>

                        <div class="col-md-12">
                            <div class="panel panel-default margin-top-15 pointer" ng-click="skanuj()"  ng-show="input.section_id && input.project_file_category_id && !input.id">
                                <div class="panel-heading  bg-green">
                                    <h3><?php echo __d('public', 'Kliknij tutaj aby zeskanować') ?></h3>
                                    <span class="hidden-xs">(<?php echo __d('public', 'plik zostane przesłany automatycznie') ?>)</span><i ng-show="scannLoader" class="fa fa-spinner fa-spin"></i>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <div ng-if="!input.project_file_category_id || !input.section_id" class="panel panel-default margin-top-15">
                                <div class="panel-heading  bg-red">
                                    <h3 class="panel-title font-white"><?php echo __d('public', 'Kategoria oraz wybór sekcji jest wymagane aby skanować pliki') ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button ng-click="scanProjectFiles = false;
                    $parent.$parent.bodyHidden = false;
                    bodyHidden = false;" class="btn default " type="button"><?php echo __d('public', 'Zamknij'); ?></button>
                <button ng-show="input.id && !input.file_check" ng-click="save()" class="btn btn-danger " type="button"><?php echo __d('public', 'Zapisz'); ?></button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
