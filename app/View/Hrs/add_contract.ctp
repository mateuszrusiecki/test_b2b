<?php echo $this->Metronic->portlet($profile['Profile']['firstname'].' '.$profile['Profile']['surname'].' - '.__d('public', 'dodawanie nowej umowy')); ?>

<div class="portlet-body">       

<!--		<div class="alert alert-success alert-dismissable">
			<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
			Nowa umowa została zapisana<br />
		</div>-->
    <?php echo $this->Form->create('UserContractHistory', array()); ?>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <?php
            echo $this->Metronic->input('position', array(
                'label' => __d('public','Stanowisko'),
				'required' => 'required',
            ));

            echo $this->Form->input('state', array(
                'div' => array('class' => 'form-group select input')
                , 'options' => ''
                , 'class' => 'form-control'
                , 'side' => "right",
				'options' => array(
					'Etat'=>__d('public','Etat'),
                    'Kontrakt(b2b)'=>__d('public','Kontrakt(b2b)'),
                    'Zlecenie'=>__d('public','Zlecenie')
				)
                , 'label' => __d('public','Rodzaj umowy')
            ));
			
			echo $this->Metronic->input('employment_start', array(
				'label' => __d('public','Data rozpoczęcia umowy'),
				//'placeholder'=> __d('public','Data od'),
				'type' => 'text',
				'class' => 'form-control form-control-inline date-picker',
				'required' => 'required',
				'between' => '<i class="icon-calendar"></i>'
			));

			echo $this->Metronic->input('employment_end', array(
				'label' => __d('public','Data zakończenia umowy'),
				//'placeholder'=> __d('public','Data od'),
				'type' => 'text',
				'class' => 'form-control form-control-inline date-picker',
				'between' => '<i class="icon-calendar"></i>'
			));
			
            echo $this->Form->input('working_time', array(
                'div' => array('class' => 'form-group select input')
                , 'options' => ''
                , 'class' => 'form-control'
                , 'side' => "right",
				'options' => array(
					'1.0'=>'Pełny','0.75'=>'3/4','0.5'=>'1/2','0.25'=>'1/4','0.125'=>'1/8'
				)
                , 'label' => __d('public','Wymiar czasu pracy')
            ));
            
            ?>
        </div>
        <div class="col-md-6 col-xs-12">
            <?php
            echo $this->Metronic->input('salary', array(
                'label' => __d('public','Wynagrodzenie brutto'),
				'required' => 'required',
                'type' => 'text'
            ));
            echo $this->Metronic->input('salary_net', array(
                'label' => __d('public','Wynagrodzenie netto'),
				'required' => 'required',
                'type' => 'text'
            ));

            echo $this->Metronic->input('hourly_rate', array(
                'label' => __d('public','Stawka za godzinę'),
				'required' => 'required',
                'type' => 'text'
            ));

            echo $this->Metronic->input('vacation_days', array(
                'label' => __d('public','Ilość urlopu rocznie'),
                'placeholder' => '24'
            ));
            echo $this->Metronic->input('vacation_available', array(
                'label' => __d('public','Dostępny urlop'),
                'placeholder' => '24'
            ));
//            echo $this->Metronic->input('salary_adjustment', array(
//                'label' => 'Korekta wynagrodzenia'
//            ));
//		
//			echo $this->Metronic->input('salary_date_from', array(
//				'label' => 'Korekta wynagrodzenia od',
//				//'placeholder'=> __d('public','Data od'),
//				'type' => 'text',
//				'class' => 'form-control form-control-inline date-picker',
//				'between' => '<i class="icon-calendar"></i>'
//			));
//			echo $this->Metronic->input('salary_date_to', array(
//				'label' => 'Korekta wynagrodzenia do',
//				//'placeholder'=> __d('public','Data od'),
//				'type' => 'text',
//				'class' => 'form-control form-control-inline date-picker',
//				'between' => '<i class="icon-calendar"></i>'
//			));
			
            ?>
        </div>
    </div>
    <?php
    echo $this->Form->submit(__d('public','Dodaj'), array('class' => 'btn blue-madison pull-right'));
    echo $this->Form->end();
    ?>
</div>

<?php echo $this->Metronic->portletEnd(); ?>