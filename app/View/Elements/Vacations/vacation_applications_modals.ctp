<div aria-hidden="false" role="reject_vacation_application" tabindex="-1" id="reject_vacation_application" class="modal fade" my-modal ng-class="modal_toggle ? 'in' : ''">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo __d('public', 'Potwierdzenie zmian'); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo __d('public', 'Czy na pewno chcesz odrzucić wniosek urlopowy?'); ?>               
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij'); ?></button>
                <a class="btn blue" ng-click="changeVacationStatus(clickedVacation, 5)" data-dismiss="modal" href="javascript:;"><?php echo __d('public', 'Potwierdź'); ?> </a>
            </div>
        </div>
    </div>
</div>

<div aria-hidden="false" role="confirm_vacation_application" tabindex="-1" id="confirm_vacation_application" class="modal fade" my-modal ng-class="modal_toggle ? 'in' : ''">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo __d('public', 'Potwierdzenie zmian'); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo __d('public', 'Czy na pewno chcesz zatwierdzić wniosek urlopowy?'); ?> <br/>
                <?php echo __d('public', 'Upewnij się, że wniosek został złożony w formie papierowej'); ?>.              
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij'); ?></button>
                <a class="btn blue" ng-click="changeVacationStatus(clickedVacation, 4)" data-dismiss="modal" href="javascript:;"><?php echo __d('public', 'Potwierdź'); ?> </a>
            </div>
        </div>
    </div>
</div>

<div aria-hidden="false" role="apply_vacation_application" tabindex="-1" id="apply_vacation_application" class="modal fade" my-modal ng-class="modal_toggle ? 'in' : ''">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo __d('public', 'Potwierdzenie zmian'); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo __d('public', 'Czy na pewno chcesz przyjąć wniosek urlopowy?'); ?>               
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij'); ?></button>
                <a class="btn blue" ng-click="changeVacationStatus(clickedVacation, 3)" data-dismiss="modal" href="javascript:;"><?php echo __d('public', 'Potwierdź'); ?> </a>
            </div>
        </div>
    </div>
</div>