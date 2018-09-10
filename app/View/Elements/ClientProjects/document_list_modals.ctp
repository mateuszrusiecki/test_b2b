<?php echo $this->element('ClientProjects/add_file_modal', array('sections'=>$sectionList)) ?>
<?php //echo $this->element('ClientProjects/add_file_modal_version') ?>



<div aria-hidden="false" role="delete_project_file" tabindex="-1" id="delete_project_file" class="modal fade ng-cloak" my-modal ng-class="modal_toggle ? 'in' : ''">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo __d('public', 'Potwierdź usunięcie'); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo __d('public', 'Czy na pewno chcesz usunąć zaznaczone pliki'); ?>?
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij'); ?></button>
                <a class="btn blue" ng-click="onDeleteFiles()" data-dismiss="modal" href="javascript:;"><?php echo __d('public', 'Potwierdź'); ?> </a>

            </div>
        </div>
    </div>
</div>


<div aria-hidden="true" role="tc" tabindex="-1" id="tc" class="modal fade ng-cloak" my-modal>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo __d('public', 'Text Cooperation'); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo __d('public', 'Przejdź do listy dokumentów aby utworzyć nowy'); ?>.
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij'); ?></button>
                <a class="btn blue" href="/text_documents/index/<?php echo $clientProject['ClientProject']['client_lead_id'] ?>"><?php echo __d('public', 'Potwierdź'); ?> </a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


