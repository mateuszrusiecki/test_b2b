
<!-- Modale do potwierdzenia usuwania plików z leadu -->
<?php if (!empty($leadfiles)):
    foreach ($leadfiles as $leadfile):
        ?>
        <div aria-hidden="true" role="lead_file_<?php echo $leadfile['LeadFile']['id']; ?>" tabindex="-1" id="lead_file_<?php echo $leadfile['LeadFile']['id']; ?>" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                        <h4 class="modal-title"><?php echo __d('public', 'Potwierdź usunięcie'); ?></h4>
                    </div>
                    <div class="modal-body">
                        <?php echo __d('public', 'Czy na pewno chcesz usunąć plik'); ?> : <?php echo $leadfile['LeadFile']['file']; ?>?
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij'); ?></button>
                        <?php
                        echo $this->Html->link('Potwierdź', array('action' => 'file_delete',$leadfile['LeadFile']['id']), array('class' => 'btn blue', 'escape' => false));
                        ?>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <?php
    endforeach;
endif;
?>