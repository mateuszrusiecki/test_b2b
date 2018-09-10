<div class="photoCategories form">
    <?php echo $this->Form->create('PhotoCategory'); ?>
    <?php echo $this->Form->input('id'); ?>
    <?php echo $this->Element('PhotoCategories/fields', array('desc' => __d('cms', 'Admin Edit Photo Category'))); ?>
    <?php echo $this->Form->end(__d('cms', 'Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->postLink(__d('cms', 'Delete'), array('plugin' => false, 'action' => 'delete', $this->Form->value('PhotoCategory.id')), array('outter' => '<li>%s</li>'), __('Are you sure you want to delete # %s?', $this->Form->value('PhotoCategory.name'))); ?> 
        <?php echo $this->Permissions->link(__d('cms', 'List Photo Categories'), array('action' => 'index', $this->Form->value('PhotoCategory.page_id')), array('outter' => '<li>%s</li>')); ?>
    </ul>
</div>
