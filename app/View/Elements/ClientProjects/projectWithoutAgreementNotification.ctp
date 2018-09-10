<?php if(isset($supervisor['Section']['profile_name'])): ?>
	<div class="col-md-12 " ng-hide="projectWithoutAgreement">
		<br />
		<div class="note note-danger">
			<i class="fa  fa-exclamation-triangle "></i>
			<b><?php echo __d('public', 'Uwaga') ?>!</b><br/>
			<?php echo __d('public', 'Rozpoczynasz projekt bez umowy') ?>. <b><?php echo $supervisor['Section']['profile_name'] ?> </b> 
			<?php echo __d('public', 'otrzyma prośbę o autoryzację') ?>.
		</div>
	</div>
<?php endif; ?>