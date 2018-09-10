<!-- MODAL -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="photo" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo __d('public', 'Dodawanie zdjęcia do celu osobistego') ?></h4>
            </div>

            <div class="modal-body" ng-init="tab = 'file'">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tabbable-custom nav-justified">
                            <ul class="nav nav-tabs nav-justified">
                                <li ng-class="{active: tab == 'file'}">
                                    <a ng-click="tab = 'file'">
                                       <?php echo __d('public', 'Wgraj zdjęcie z dysku') ?>  </a>
                                </li>
                                <li  ng-class="{active: tab == 'url'}"> 
                                    <a ng-click="tab = 'url'">
                                        <?php echo __d('public', 'Wklej link') ?> </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <?php
                                echo $this->Form->input('photo_type', array(
                                    'type' => 'text',
                                    'div' =>false,
                                    'label' =>false,
                                    'ng-model' => 'tab',
                                    'class' => 'hidden'
                                ));
                                ?>

                                <div class="" ng-show="tab == 'file'">
                                    <h4><?php echo __d('public', 'Dodaj zdjęcie z dysku') ?></h4>
                                    <?php
                                    echo $this->Form->input('photo', array(
                                        'type' => 'file',
                                        'label' => false
                                    ));

                                    echo $this->Form->input('id', array(
                                        'type' => 'hidden',
                                        'value' => $aim['PersonalAim']['id'] ? $aim['PersonalAim']['id'] : null
                                    ));
                                    echo $this->Form->input('user_id', array(
                                        'type' => 'hidden',
                                        'value' => $this->Session->read('Auth.User.id')
                                    ));
                                    ?>
                                    <button type="submit" class="btn blue-madison pull-right"><?php echo __d('public', 'Dodaj') ?></button>
                                    <div class="clearfix"></div>

                                </div>
                                <div class="" ng-show="tab == 'url'">
                                    <h4><?php echo __d('public', 'Wklej link') ?></h4>
                                    <?php
                                    echo $this->Metronic->input('photo_url', array(
                                            ), array(
                                        'label' => false
                                    ));

                                    echo $this->Form->input('id', array(
                                        'type' => 'hidden',
                                        'value' => $aim['PersonalAim']['id'] ? $aim['PersonalAim']['id'] : null
                                    ));
                                    echo $this->Form->input('user_id', array(
                                        'type' => 'hidden',
                                        'value' => $this->Session->read('Auth.User.id')
                                    ));
                                    ?>
                                    <button type="submit" class="btn blue-madison pull-right"><?php echo __d('public', 'Dodaj') ?></button>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default"><?php echo __d('public', 'Zamknij') ?></button>
                <!--<button type="submit" class="btn blue-madison">Dodaj</button>-->
            </div>
        </div>
    </div>
</div>
