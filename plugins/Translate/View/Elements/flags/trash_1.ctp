<div class="button dodelete">
    Usuń<br />
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
                'confirm' => __('Czy napewno chcesz usunąć tą wersje jezykową strony %s?', $data[$model]['id']),
            )
                )
        );
    }
    echo $this->Html->link(
            $this->Html->image('flag/trash.png', array(
                'alt' => __('Usuń Wszystkie'),
                'title' => __('Usuń Wszystkie')
                    )
            ), array('action' => 'delete', $data[$model]['id'], 1), array(
        'confirm' => __('Usunąć wszystkie wersje językowe?'),
        'escape' => false
            )
    );
    ?>
</div>