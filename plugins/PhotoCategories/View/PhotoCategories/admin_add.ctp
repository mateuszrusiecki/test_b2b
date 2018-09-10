<div class="photoCategories form">
    <?php echo $this->Form->create('PhotoCategory'); ?>
    <?php echo $this->Element('PhotoCategories/fields', array('desc' => __d('cms', 'Admin Add Photo Category'))); ?>
    <?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->link(__d('cms', 'List Photo Categories'), array('action' => 'index', $this->request['pass'][0]), array('outter' => '<li>%s</li>')); ?>
    </ul>
</div>
