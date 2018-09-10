<?php echo $this->Metronic->portlet(__d('public','NOWY PRACOWNIK').': '.$profile['Profile']['firstname'].' '.$profile['Profile']['surname']); ?>

<?php if (isset($error)) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
		<?php foreach ($error as $er) {
			echo $er[0];
		} ?>
    </div>
<?php } ?>
		
<div>
	<?php echo $this->Form->create('Profile',array()); ?>
    <div class="row">
        <div class="col-xs-12 margin-bottom-10">

        </div>
        <div class="col-md-6 col-xs-12">
            <?php
//            echo $this->Metronic->input('firstname', array(
//                'label' => 'Imię',
//				'placeholder' => $profile['Profile']['firstname'],
//                'value' => $profile['Profile']['firstname'],
//				'required' => 'required',
//            ));
//            echo $this->Metronic->input('surname', array(
//                'label' => 'Nazwisko',
//				'placeholder' => $profile['Profile']['surname'],
//                'value' => $profile['Profile']['surname'],
//				'required' => 'required',
//            ));
            echo $this->Form->input('group', array(
                'label' => __d('public','Grupa uprawnień'),
                'type' => 'select',
                'default' => 'wybierz',
                'options' => $perm_groups,
                'div' => 'form-group',
                'class' => 'form-control'
            ));
			
			
            echo $this->Form->input('department', array(
                'label' => __d('public','Dział'),
                'type' => 'select',
                'default' => 'wybierz',
                'options' => $sections,
                'div' => 'form-group',
                'class' => 'form-control'
            ));
            ?>
        </div>
        <div class="col-md-6 col-xs-12">
            <?php
            
			echo $this->Metronic->input('email', array(
                'label' => __d('public','E-mail(służbowy)'),
				'email' => 'email',
				'required' => 'required'
            ));
            echo $this->Metronic->input('place_of_work', array(
                'label' => __d('public','Miejsce pracy'),
				'placeholder' => __d('public','Rzeszów'),
                'value' => $profile['Profile']['place_of_work'],
				'required' => 'required'
            ));
            ?>
        </div>
    </div>
	
<!--    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
        Pracownik został dodany pomyślnie.
    </div>-->
    
    <?php
	
	echo $this->Form->hidden('id', array(
		'label' => false,
		'value' => $profile['Profile']['id'],
	));
			
    $options = array(
        'label' => __d('public', 'Dodaj'),
        'class' => 'btn blue-madison pull-right'
    );
    ?>
    <?php echo $this->Form->end($options); ?>
	
</div>
<?php echo $this->Metronic->portletEnd(); ?>

