<div class="row" ng-controller="BriefsCtrl">
    <div class="col-xs-12">
        <?php echo $this->Metronic->portlet(__d('public', 'Brief - dodaj pytanie domyslne')); ?>
			<?php echo $this->Form->create('BriefDefaultQuestion'); ?>
            <div class="row">
                <div class="col-md-6 col-xs-12">
      
                        <div class="col-xs-12">
                            <div class="padding-top-15 padding-bottom-15">
								<?php
								echo $this->Form->input('group_category_name', array(
									'label' => false,
									'class' => 'form-control clear',
									'options' => $group_category_name,
									'type' => 'select',
									'required' => 'required',
									'empty' => __d('public', 'Wybierz kategorię pytania')
								));
								?>
                            </div>
                        </div>
					
                        <div class="col-xs-12">
                            <div class="padding-top-15 padding-bottom-15">
								<?php echo $this->Form->label(__d('public', 'Treść pytania')); ?>
								<?php echo $this->Form->textarea('content', array('class' => 'form-control input-sm')); ?>
                            </div>
                        </div>
                </div>
				
                <div class="col-xs-12">
					<?php
						echo $this->Form->button( __d('public', 'Zapisz'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-left poitnier', 'escape' => false, 'type' => 'submit'));
					?>
                </div>
            </div>
			<?php echo $this->Form->end(); ?>
        <?php echo $this->Metronic->portletEnd(); ?>
    

    </div>
</div>

<?php echo $this->Html->script('angular/controllers/BriefsCtrl',  array('block' => 'angular')); ?>