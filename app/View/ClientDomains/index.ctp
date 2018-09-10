<?php $this->Html->addCrumb(__d('public', 'Projekt'), array('controller'=>'client_projects','action'=>'view',$project_id)); ?>
<?php echo $this->Metronic->portlet($title); ?>
<div class="clearfix margin-bottom-20">
   
    <a href="#info" data-toggle="modal"><i class="fa fa-info-circle font-blue-hoki font-large info-circle" tooltip-placement="right"> </i> </a>
    <?php //echo $this->Html->link(__('Nowa domena klienta'), array('action' => 'add', $project_id), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier margin-left-5')); ?>
    <?php //echo $this->Html->link('Pokaż projekt', array('controller' => 'client_projects', 'action' => 'view', $project_id), array('escape' => false, 'class' => 'btn btn-sm blue btn-sm margin-bottom pull-right poitnier')) ?>

</div>
<div class="clientDomains index">
    <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-advance table-hover projectTable">
        <tr>
            <th><?php echo __d('public', 'id'); ?></th>
            <th><i class="fa fa-suitcase"></i> <?php echo __d('public', 'Domena'); ?></th>
            <th class="actions"><i class="fa fa-cogs"></i> <?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($clientDomains as $clientDomain): ?>
            <tr>
                <td>
                    <?php
                    echo h($clientDomain['ClientDomain']['id']);
                    if (!empty($clientDomain['ProjectFile']))
                    {
                        ?>
                        <i class="fa fa-plus pointer" tooltip="<?php echo __d('public', 'pokaż raporty') ?>" ng-click="hide_<?php echo $clientDomain['ClientDomain']['id']; ?> = !hide_<?php echo $clientDomain['ClientDomain']['id']; ?>"></i>
                        <?php
                    }
                    ?>
                </td>
                <td><?php echo h($clientDomain['ClientDomain']['domain']); ?>&nbsp;</td>
                <td class="actions">
                    <?php //echo $this->Html->link(__('View'), array('action' => 'view', $clientDomain['ClientDomain']['id']));  ?>
                    <?php echo $this->Form->postLink('<i class="fa fa-close font-large font-blue-ebonyclay margin-left-5" tooltip="'.__d('public', 'Usuń').'"></i>', 
                            array('action' => 'delete', $clientDomain['ClientDomain']['id']), array('escape' => false, 'class' => 'pull-right'), 
                            __('public','Are you sure you want to delete # %s?', $clientDomain['ClientDomain']['id'])); ?>

                    <?php echo $this->Html->link('<i class="fa fa-edit font-large font-blue-ebonyclay margin-left-5" tooltip="'.__d('public', 'Edytuj').'"></i>', array('action' => 'edit', $clientDomain['ClientDomain']['id'], $project_id), array('escape' => false, 'class' => 'pull-right')); ?>
                    <?php
                    echo $this->Html->link('<i class="fa fa-download font-large font-blue-ebonyclay margin-left-5" tooltip="'.__d('public', 'Generuj raport').'"></i>', array('action' => 'raport', $clientDomain['ClientDomain']['id'], $clientDomain['ClientProject']['id']), array('escape' => false, 'class' => 'pull-right'));
                    ?>
                </td>
            </tr>
            <?php
            if (!empty($clientDomain['ProjectFile']))
            {
                foreach ($clientDomain['ProjectFile'] as $projectFile)
                {
                    ?>
                    <tr ng-cloak ng-show="hide_<?php echo $clientDomain['ClientDomain']['id']; ?>">
                        <td colspan="3">
                            <?php
                            echo $this->Html->link($projectFile['file'], '/files/projectfile/' . $projectFile['file'], array('target' => '_blank'));
                            echo ' (' . $projectFile['created'] . ')';
                            echo '<br>';
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
<?php endforeach; ?>
    </table>
</div>

<div aria-hidden="true" role="info" tabindex="-1" id="info" class="modal fade" style="display: none;"><div class="modal-backdrop fade in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="form-horizontal ng-pristine ng-valid" >
                <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>            
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    <h4 class="modal-title"> <?php echo __d('public', 'Integracja z systemem monitorującym pozycje stron') ?></h4>
                </div>
                <div class="modal-body">
                    <p><?php echo __d('public', 'Pozycjonowanie strony jest typowym działaniem projektowym, tak więc
                        użytkownicy działu SEM także widzą listę projektów, z tą różnicą, że w
                        każdym projekcie zdefiniowana jest lista wybranych domen Klienta') ?>
                        .<?php echo __d('public', 'Domeny wprowadza się podczas konfigurowania projektu, są
                        przechowywane w CRM jako własność Klienta') ?>
                        .<?php echo __d('public', 'Integracja z systemem monitoringu pozycji w wyszukiwarkach') ?>
                        . <?php echo __d('public', 'Co miesiąc, za pomocą linku do systemu monitoringu, pobierane są nowe
                        raporty, jeden dla każdej domeny') ?>. <br/><?php echo __d('public', 'Każdy raport ma w nazwie') ?>:
                        <br/>● <?php echo __d('public', 'nazwę domeny') ?>
                        <br/>● <?php echo __d('public', 'okres raportu od-do') ?>
                        <br/>● <?php echo __d('public', 'monitoring (np. google.de)') ?>
                        <br/><?php echo __d('public', 'Raport trafia na listę dokumentów projektowych w postaci PDF') ?>. 
                            <?php echo __d('public', 'Każdy kolejny raport dotyczący tej samej domeny jest zapisywany jako
                        najnowsza wersja, a stare raporty są przechowywane jako stare wersje') ?>.
                        <?php echo __d('public', 'Miesięczne raporty SEO są automatycznie udostępniane dla Klienta w
                        jego panelu') ?>.
                    </p>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij') ?></button>
                </div>        
            </div>
            <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
</div>

<?php echo $this->Metronic->portletEnd(); ?>