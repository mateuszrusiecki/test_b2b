<?php
switch ($this->Form->value('RequestersPermission.model')) {
    case 'Group':
        $titlePortlet =  __d('cms', 'Nowe uprawnienie dla grupy: %s', $record['Group']['name']);
        break;
    case 'User':
        $titlePortlet = __d('cms', 'Nowe uprawnienie dla użytkownika: %s', $record['User']['email']);
        break;
    default:
        $titlePortlet = __d('cms', 'Uprawnienie definiowane na poziomie modelu: %s, dla rekordu: %s', $this->Form->value('RequestersPermission.model'), $record[$this->Form->value('RequestersPermission.model')]['name']);
        break;
}
?>
<?php echo $this->Metronic->portlet($titlePortlet); ?>

<div class="portlet-body">
    <?php echo $this->Form->create('User'); ?>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <?php echo $this->Form->create('Permission'); ?>
            <h2><?php echo __d('cms', 'Dodaj %s', 'uprawnienie'); ?></h2>
            <?php
            echo $this->Form->hidden('RequestersPermission.model');
            echo $this->Form->hidden('RequestersPermission.row_id');
            echo $this->Metronic->input('RequestersPermission.permission_id', array('label' => 'Wybierz zasób', 'empty' => 'Wybierz zasób z listy, lub wpisz w poniższe pole'));
            echo $this->Metronic->input('Permission.name', array('label' => 'Wprowadź zasób'));
            ?>
            <div>
                <pre>
Możliwe zasoby (podlegające kontroli uprawnień)
 * - pełne uprawnienia dla administratora
 nazwa_kontrolera:* - pełny dostęp w obrębie kontrolera
 nazwa_kontrolera:nazwa_akcji - dostęp do wybranej akcji
 nazwa_kontrolera:nazwa_akcji:id_rekordu - dostęp do konkrenego rekordu z tabeli na poziomie wybranej akcji
 nazwa_modelu:id_rekordu - pełny dostęp do wybranego rekordu (użytkownik ma dostęp do edycji, usuwania itd.)
 nazwa_kontrolera:nazwa_akcji:own - dostęp do wybranej akcji, tylko do własnych rekordów (np. users:edit:own - użytkownik może edytować własny profil)
                </pre>
            </div>
            <div class="pull-right">
                <?php
                echo $this->Form->submit('Zapisz', array('class' => 'btn blue-madison pull-right'));
                echo $this->Form->end();
                ?>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Metronic->portletEnd(); ?>
