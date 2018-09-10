<?php
if ($user_permission == 'all' || $user_permission == 'manager' || $user_permission == 'trader') {
    ?>

    <a href="" ng-click="shareModal = true">
        <i class="fa fa-key font-white font-large" tooltip="<?php echo $clientProject['ClientProject']['share'] ? __d('public', 'Udostępnione') : __d('public', 'Zarządzanie dostępem klienta do projektu') ?>"></i>
    </a>
    <div ng-cloak class="modal-backdrop fade in ng-cloak" ng-show="shareModal"></div>
    <div ng-cloak aria-hidden="true" tabindex="-1" ng-show="shareModal" class="angular-modal ng-cloak">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" ng-click="shareModal = false" class="close" type="button"></button>
                    <h4 class="modal-title"><?php echo __d('public', 'Zarządzanie dostępem klienta do projektu'); ?></h4>
                </div>
                <div class="modal-body">
                    Klient
                    <?php echo $clientProject['Client']['name']; ?>,
                    <?php echo $clientProject['Client']['email']; ?> 
                    <?php echo $clientProject['ClientProject']['share'] ? __d('public', 'już widzi projekt') : __d('public', 'nie posiada dostępu do projektu'); ?> 

                    <?php
                    echo $this->Metronic->input('shar_url', array(
                        'label' => __d('public', 'Link do projektu'),
                        'readonly' => 'readonly',
                        'value' => $this->Html->url(array('action' => 'view_client', $clientProject['ClientProject']['id']), true),
                            )
                    );
                    ?>
                </div>
                <div class="modal-footer">
                    <button ng-click="shareModal = false" class="btn default" type="button"><?php echo __d('public', 'Zamknij'); ?></button>
                    <?php
                    if ($clientProject['ClientProject']['share']) {
                        ?>
                        <a class="btn red" href="<?php echo Router::url(array('action' => 'share', $clientProject['ClientProject']['id'])); ?>" data-dismiss="modal"><?php echo __d('public', 'Zablokuj'); ?> </a>
                        <?php
                    } else {
                        ?>
                        <a class="btn blue" href="<?php echo Router::url(array('action' => 'share', $clientProject['ClientProject']['id'])); ?>" data-dismiss="modal"><?php echo __d('public', 'Udostępnij'); ?> </a>
                    <?php } ?>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>