<div class="photoCategories index">
    <h2><?php echo __d('cms', 'Photo Categories'); ?></h2>
    <?php echo $this->Element('PhotoCategories/table_index'); ?> 
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <?php echo $this->Permissions->link(__d('cms', 'New Photo Category'), array('action' => 'add', $this->request['pass'][0]), array('outter' => '<li>%s</li>')); ?>
    </ul>
</div>