<div id="sessionTimeout-dialog" style="display:{{infoPhoto?'block':'none'}}" class="modal fade in" aria-hidden="false">
    <div class="modal-dialog modal-small">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" ng-click="infoPhoto = false;" class="close" type="button">×</button>
                <h4 class="modal-title"><?php echo __d('public', 'Sprawdziłeś pliki') ?>?</h4>
            </div>
            <div class="modal-body">
                <ol>
                    <li>
                        <?php echo __d('public', 'Upewnij się, czy wszystkie są potrzebne w projekcie') ?>,<br>
                        <?php echo __d('public', 'jeżeli nie - usuń je naciskając ') ?> ✔. <?php echo __d('public', 'Pliki nie będą uzunięte z leadu, jedynie z projektu') ?>.
                    </li>
                    <li>
                        <?php echo __d('public', 'Czy uprawnienia są odpowiednie? Pliki widoczne dla wszystkich znajdują się') ?><br>
                        <?php echo __d('public', 'w kategorii Inne, pozostałe będą widoczne tylko dla kierowników i handlowców') ?>.
                    </li>
                    <li>
                        <?php echo __d('public', 'Aby przenieść plik między kategoriami, po prostu przeciągnij go i upuść') ?>.
                    </li>
                </ol>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-primary" type="button" ng-click="infoPhoto = false;"><?php echo __d('public', 'Zamknij') ?></button>
            </div>
        </div>
    </div>
</div>

