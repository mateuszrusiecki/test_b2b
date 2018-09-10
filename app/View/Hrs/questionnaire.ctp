
<?php echo $this->Metronic->portlet(__d('public','Kwestionariusz')); ?>


	<?php if($show_alert): ?>
	<div class="alert alert-success alert-dismissable" id="documents_alert">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
		<strong>Lista dokumentów dla kandydata została poprawnie wygenerowana.</strong> <br>Możesz je pobrać tutaj:
		<a href="/files/hr/<?php echo $archive_file_name?>" class="alert-link"><?php echo $archive_file_name?></a>
	</div>
	<div class="alert alert-success alert-dismissable" id="documents_alert">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
		Możesz rozpocząć proces zatrudniania pracownika: <a id="hire_employee" href="/hrs/hire_employee/<?php echo $profile_id ?>" title="Rozpocznij proces zatrudniania">Rozpocznij</a>
	</div>
	<?php else: ?>


		<?php echo $this->Form->create('Candidate', array()); ?>

		<!--TABS HEADERS-->
		<div class="clearfix">
			<!--BEGIN TABS-->
			<?php echo $this->Form->create('Profile'); ?>

			<div class="row">
				<div class="col-md-6 col-xs-12">
					<?php
					echo $this->Metronic->input('firstname', array(
						'placeholder' => __d('public','Imię'),
						'label' => __d('public','Imię'),
						'required' => 'required'
					));

					echo $this->Metronic->input('surname', array(
						'placeholder' => __d('public','Nazwisko'),
						'label' => __d('public','Nazwisko'),
						'required' => 'required'
					));

					echo $this->Metronic->input('date_of_birth', array(
						'placeholder' => '01.01.1950',
						'type' => 'text',
						'required' => 'required',
						//'ng-model' => '_date_of_birth',
						'class' => 'form-control form-control-inline date-picker',
						'label' => 'Data urodzenia'
					));

					echo $this->Metronic->input('place_of_birth', array(
						'placeholder' => __d('public','Miejscowośc'),
						'label' => __d('public','Miejsce urodzenia')
					));

					echo $this->Metronic->input('father_name', array(
						'placeholder' => __d('public','Imię'),
						'label' => __d('public','Imię ojca'),
						'required' => 'required'
					));
					echo $this->Metronic->input('mother_name', array(
						'placeholder' => __d('public','Imię'),
						'label' => __d('public','Imię matki'),
						'required' => 'required'
					));

					echo $this->Metronic->input('nationality', array(
						'placeholder' => __d('public','Obywatelstwo'),
						'value' => __d('public','Polska'),
						'label' => 'Obywatelstwo'
					));
					?>
				</div>
				<div class="col-md-6 col-xs-12">
					<?php
					echo $this->Metronic->input('city', array(
						'placeholder' => '',
						'label' => __d('public','Miejscowość'),
						'required' => 'required'
					));

					echo $this->Metronic->input('postcode', array(
						'placeholder' => '00-000',
						'label' => __d('public','Kod pocztowy'),
						'required' => 'required'
					));

					echo $this->Metronic->input('street', array(
						'placeholder' => '',
						'type' => 'text',
						'label' => __d('public','Ulica'),
						'required' => 'required'
					));

					echo $this->Metronic->input('house_number', array(
						'placeholder' => '00/00',
						'label' => __d('public','Numer domu/mieszkania'),
						'required' => 'required'
					));

					echo $this->Metronic->input('private_email', array(
						'placeholder' => 'example@example.com',
						'label' => __d('public','E-mail(prywatny)'),
						'required' => 'required'
					));

					echo $this->Metronic->input('private_phone', array(
						'placeholder' => '48 000 000 000',
						'label' => __d('public','Telefon')
					));
					?>
				</div>
			</div>


			<?php
			$options = array(
				'label' => __d('public', 'Generuj dokumenty'),
				'class' => 'btn btn-sm green-haze margin-bottom pull-right',
				'type'=>'image',
				'src' => '/img/loader_orange_blue.gif'
			);
			?>

				<button type="submit" class=" btn btn-sm green-haze margin-bottom pull-right" ng-submit="loading=1">
					<img ng-if="loading" src="/img/loader_green_white.gif" alt="loading" /> <?php echo __d('public', 'Generuj dokumenty') ?>
				</button>

			</form>
			<?php //echo $this->Form->end($options); ?>
		</div>
		<br/>


		<div class="clearfix">
		</div>

	<?php endif; ?>
<?php echo $this->Metronic->portletEnd(); ?>   
