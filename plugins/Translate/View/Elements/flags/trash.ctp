<div class="actionButton dodelete">
    <span>Usuń</span>
    <?php
    if (count($data['translateDisplay']) > 1) {
        echo $this->element('Translate.flags/flags', array('url' => array(
                'action' => 'delete',
                $data[$model]['id'],
                0
            ),
            'active' => $data['translateDisplay'],
            'title' => __d('cms', 'Usuń'),
            'addit' => array(
                'confirm' => __('Czy napewno chcesz usunąć tą wersje jezykową strony %s?', @$data[$model]['name']),
            )
                )
        );
    }
    echo $this->Html->link(
            '<i class="fa fa-trash" tooltip="Usuń wszystkie wersje językowe"></i>', array('action' => 'delete', $data[$model]['id'], 1), array(
        'confirm' => __('Usunąć wszystkie wersje językowe?'),
        'escape' => false
            )
    );
    ?>
</div>