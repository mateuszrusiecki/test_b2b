<fieldset>
    <legend><?php echo __d('cms', 'News Data'); ?></legend>
    <?php
		echo $this->Form->input('title', array('label' => __d('cms', 'Title')));
		echo $this->Form->input('user_id', array('label' => __d('cms', 'User Id')));
		echo $this->Form->input('date', array('type' => 'text', 'label' => __d('cms', 'Data wydarzenia')));
		echo $this->Form->input('main', array('label' => __d('cms', 'Main')));
	?>
</fieldset>
<fieldset>
    <legend><?php echo __d('cms', 'Content'); ?></legend>
    <?php
		echo $this->FebTinyMce4->input('content', array('label' => false), 'full');
	?>
</fieldset>
<script type="text/javascript">
    $(function(){
        $('#NewsDate').datepicker({
            dateFormat: 'yy-mm-dd'//'dd.mm.yy',
        });
    });
</script>
