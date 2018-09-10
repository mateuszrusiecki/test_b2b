<fieldset>
    <legend><?php echo $desc; ?></legend>
    <?php
    echo $this->Form->input('name', array('label' => __d('cms', 'Name')));
    ?>
</fieldset>
<fieldset>
    <legend><?php echo __d('cms', 'Desc'); ?></legend>
    <?php
    echo $this->FebTinyMce4->input('desc', array('label' => false), 'full');
    ?>
</fieldset>
