<div class="child clearfix">
    <div class="action">
        <?php
            $optionsFull = array('update' => '#tree', 'class' => 'button', 'before' => 'blockAll();', 'complete' => 'unblockAll();');
            echo '<div class="actions">';
            echo $this->Html->link('Zdjęcia', array('plugin' => 'photo','controller' => 'photos', 'action' => 'index', 'PhotoCategories.PhotoCategory', $value['PhotoCategory']['id']));
            echo $this->Html->link('Edytuj', array('action' => 'edit', $value['PhotoCategory']['id']));
            echo $this->Form->postLink('Usuń', array('action' => 'delete', $value['PhotoCategory']['id']));
            echo '</div>';
        ?>
    </div>
    <span>
        <?php echo $value['PhotoCategory']['name']; ?>
    </span>
</div>