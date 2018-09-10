<ul>
    <li><a href="#setting-basic"><span><?php echo __('Ogólne'); ?></span></a></li>
    <li><a href="#setting-misc"><span><?php echo __('Zaawansowane'); ?></span></a></li>
</ul>
<div id="setting-basic">
    <?php
    echo $this->Form->input('key', array('rel' => __("np. Tytuł strony")));
    echo $this->Form->input('value');
    ?>
</div>

<div id="setting-misc">
    <?php
    echo $this->Form->input('title');
    echo $this->Form->input('description');
    echo $this->Form->input('input_type', array('rel' => __("e.g., takie jak w inpucie + tinymce")));
    echo $this->Form->input('editable');
    echo $this->Form->input('params');
    ?>
</div>

<script type="text/javascript">
    $(function(){
        $('.tabs').tabs();
    });
</script>