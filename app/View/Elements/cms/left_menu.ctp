<div id="leftMenu" class="clearfix">
    <button id="clipButton"></button>
    <div id="leftMenuContent">
        <h2><span><?php echo __d('public', 'MENU GŁÓWNE') ?></span></h2>
        <ul>
        	<li><?php echo $this->Html->link('STRONA GŁÓWNA', '/admin') ?></li>
        	<li><?php echo $this->Html->link(__('WYLOGUJ'), array('admin' => false, 'controller' => 'users', 'action'=>'logout')); ?></li>
        </ul>
    </div>
</div>

<script type="text/javascript">
//<![CDATA[
	jQuery('#leftMenu button').click(function(){
	   var content = jQuery('#content');
	   var isClass = content.hasClass('clip')
	   if(isClass){
	       content.removeClass('clip');
	       jQuery(this).addClass('active');
	       jQuery.post('<?php echo $this->Html->url(array('plugin' => 'user','controller'=>'users','action'=>'menu','admin'=>true, 1)); ?>');
	   }else{
	       content.addClass('clip');
	       jQuery(this).removeClass('active');
	       jQuery.post('<?php echo $this->Html->url(array('plugin' => 'user', 'controller'=>'users','action'=>'menu','admin'=>true, 0)); ?>');
	   }
	   
	});
	jQuery('div.actions ul').each(function(){
	   jQuery('<h2><span>Opcje</span></h2>').appendTo(jQuery('#leftMenuContent'));
	   jQuery(this).appendTo(jQuery('#leftMenuContent'));
	})
	
//]]>	
</script>