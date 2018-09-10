<div class="portlet light col-xs-12 panel_pm" ng-controller="PmCtrl" data-intro="<?php echo __d('public', 'Panel zadań PM. Widoczne są tu zadania przypisane do ciebie i przez ciebie utworzone.') ?>" data-step="70">
	<div>

        <div class="note note-info" ng-if="login_to_pm">
            <?php echo __d('public', 'Aby w pełni korzystać z systemu zaloguj się do ') ?>
            <?php
            echo $this->Html->link(__d('public', 'PM'), array('controller' => 'pm','action' => 'index'), array('escape' => false));
            ?>.
        </div>

        <div class="" ng-if="!login_to_pm">
			<div class="portlet-title caption-subject list-group-item pm_title">
				<div class="caption caption-md">
					<i class="icon-globe theme-font hide"></i>
					<span class="caption-subject font-blue-madison bold uppercase"><?php echo __d('public', 'Podsumowanie zadań w systemie PM'); ?> </span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<form ng-submit="submit(name)">
							<div class="input-icon right">
								<i class="icon-magnifier"></i>
								<?php
								echo $this->Metronic->input('search_box', array(
									'placeholder' => __d('public', 'Szukaj'),
									'type' => 'text',
									'ng-model' => 'name',
									'class' => ' form-control form-control-inline',
								));
								?>
							</div>
						</form>
					</div>	

					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							<select ng-cloak ng-model="projects" class="form-control col-md-3 ng-pristine ng-valid ng-touched" ng-change="jump()">
                                                            <option  ng-repeat="(key,project) in projects_list" value="{{key}}">{{project}}</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12" id="assigned_to_me">
				<?php echo $this->Metronic->portlet(__d('public', 'Zadania przypisane do mnie'), 1); ?>        
			
				<div class="table-scrollable" id="issuesAssignedTo">
						<table class="table table-striped table-bordered table-advance table-hover" ng-if="issuesAssignedTo">
							<thead>  
								<tr>
									<th><?php echo __d('public', '#'); ?> </th>
									<th><i class="fa fa-briefcase"></i> <?php echo __d('public', 'Projekt'); ?></th>
									<th><i class="fa fa-signal"></i> <?php echo __d('public', 'Priorytet'); ?></th>
									<th><i class="fa fa-calendar"></i> <?php echo __d('public', 'Termin'); ?></th>
									<th><i class="fa fa-suitcase"></i> <?php echo __d('public', 'Temat'); ?></th>
									<th><i class="fa fa-user"></i> <?php echo __d('public', 'Osoba przypisująca'); ?></th>
								</tr>
							</thead>
							<tbody>
                                                            <tr ng-cloak ng-repeat="issue in issuesAssignedTo.issues" class="status_{{ issue.tracker.id }} priority_{{ issue.priority.id }}">
										<td>{{ issue.id }}</td>
										<td>{{ issue.project.name }}</td>
										<td>{{ issue.priority.name }}</td>
										<td ng-class="{exceeded: (issue.due_date < <?php echo date('Y-m-d') ?>)}"><span ng-if="issue.due_date">{{ issue.due_date }}</span>
											<span ng-if="!issue.due_date">-</span>
										</td>
										<td><a href="http://pm.feb.net.pl/issues/{{ issue.id }}" target="blank">{{ issue.subject }}</a></td>
										<td>{{ issue.author.name }}</td>
								</tr>
							</tbody>
						</table>
						<div class="note note-info"  ng-if="!issuesAssignedTo">
							<h4><?php echo __d('public', 'W tym momencie brak zadań przypisanych'); ?></h4>
						</div>
				</div>

				<?php echo $this->Metronic->portletEnd(); ?>
			</div>

			<div class="col-md-12" id="added_by_me">
				<?php echo $this->Metronic->portletHiden(__d('public', 'Zadania utworzone przeze mnie'), 1); ?>
				<div class="table-scrollable">
						<table class="table table-striped table-bordered table-advance table-hover" ng-if="issuesReported">
							<thead>
								<tr>
									<th><?php echo __d('public', '#'); ?> </th>
									<th><i class="fa fa-briefcase"></i> <?php echo __d('public', 'Projekt'); ?></th>
									<th><i class="fa fa-signal"></i> <?php echo __d('public', 'Priorytet'); ?></th>
									<th><i class="fa fa-calendar"></i> <?php echo __d('public', 'Termin'); ?></th>
									<th><i class="fa fa-suitcase"></i> <?php echo __d('public', 'Temat'); ?></th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="issue in issuesReported.issues" class="status_{{ issue.tracker.id }}  priority_{{ issue.priority.id }}">
										<td>{{ issue.id }}</td>
										<td>{{ issue.project.name }}</td>
										<td>{{ issue.priority.name }}</td>
										<td ng-class="{exceeded: (issue.due_date < <?php echo date('Y-m-d') ?>)}"><span ng-if="issue.due_date">{{ issue.due_date }}</span>
											<span ng-if="!issue.due_date">-</span>
										</td>
										<td><a href="http://pm.feb.net.pl/issues/{{ issue.id }}" target="blank">{{ issue.subject }}</a></td>
								</tr>
							</tbody>
						</table>
						<div class="note note-info" ng-if="!issuesReported">
							<h4><?php echo __d('public', 'W tym momencie brak zadań utworzonych'); ?></h4>
						</div>
				</div>
				<?php echo $this->Metronic->portletEnd(); ?>
			</div>
	
			<div class="clear clearfix"></div>

        </div>
    
	</div>
</div>
<?php echo $this->Html->script('angular/controllers/PmCtrl',  array('block' => 'angular')); ?>