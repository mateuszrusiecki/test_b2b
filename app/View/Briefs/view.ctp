
<div class="row" ng-controller="BriefsCtrl">
    <div class="col-xs-12">
        <div class="profile-sidebar">
            <div class="portlet light profile-sidebar-portlet">
                <div class="margin-top-5 margin-bottom-15 text_center" style="font-size: 13px; color: grey; text-transform: none;">
                    <?php echo __d('public', 'Ofertę przygotował') ?>:
                </div>
                <div class="profile-userpic">
                    <?php //echo $this->image->thumb('/img/example_usr.jpg', array('width' => 135, 'height' => 135, 'crop' => true)); ?>		
                    <?php
                    if (!empty($brief['User'])) {
                        $userProfile = $brief['User'];
                        $avatarOptions = array('width' => '135', 'height' => '135', 'class' => 'clear');
                        echo $this->element('default/avatar', compact('userProfile', 'avatarOptions'));
                    }
                    ?>
                            
                </div>
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"><?php echo $brief['Profile']['firstname'].' '.$brief['Profile']['surname'] ?></div>

                    <?php if(!empty($brief['Profile']['work_phone'])): ?><div class="profile-usertitle-job">tel: <?php echo $brief['Profile']['work_phone'] ?></div> <?php endif ?>
                </div>
                <div class="profile-userbuttons padding-bottom-15">
                    <a href="mailto:<?php echo $brief['User']['email']?>" class="btn green-haze btn-sm">EMAIL</a>
                    <!--<a href="#"  class="btn bg-blue btn-sm">SKYPE</a>-->
                </div>
            </div>
            
			
			
            <?php if(!empty($all_briefs) && ($_SESSION['user_permission'] == 'all' || $_SESSION['user_permission'] == 'manager' || $_SESSION['user_permission'] == 'trader')): ?>
            
            <div class="portlet light profile-sidebar-portlet">
                <div class="margin-top-5 margin-bottom-15 text_center" style="font-size: 13px; color: grey; text-transform: none;">
                    <?php echo __d('public', 'Klient') ?>:
                </div>
                
                <div class="profile-usertitle">
                    <?php //debug($brief)?>
                    <div class="profile-usertitle-name"><?php echo $brief['Client']['name'] ?></div>

                    <?php if(!empty($brief['Client']['phone'])): ?><div class="profile-usertitle-job">tel: <?php echo $brief['Client']['phone'] ?></div> <?php endif ?>
                    <?php if(!empty($brief['Client']['email'])): ?><div class="profile-usertitle-job">email: <?php echo $brief['Client']['email'] ?></div> <?php endif ?>
                    <div class="clear-fix" ><br/></div>
                </div>
            </div>
            <div class="portlet light profile-sidebar-portlet">
                <div class="margin-top-5 margin-bottom-15 text_center" style="font-size: 19px; color: grey; text-transform: none;">
                    <?php echo __d('public', 'Wszystkie wersje') ?>:
                </div>
                <div class="table-scrollable">
					<table class="table table-striped table-bordered table-advance table-hover">
						<thead>
							<tr>
								<th><i class="fa fa-briefcase"></i> <?php echo __d('public', 'Nazwa') ?></th>
								<th><i class="fa fa-calendar"></i> <?php echo __d('public', 'Utworzono') ?></th>
								<th class="actions"><i class="fa fa-cog"></i> <?php echo __('Actions'); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$tmp = null;
							foreach ($all_briefs as $ab):
								$silverClass = ($ab['Brief']['id'] == $brief['Brief']['id'])?'bg-grey-silver':''
								?>
								<tr class="<?php echo $silverClass; ?>">
									<td><?php echo h($ab['Brief']['name']); ?>&nbsp;</td>
									<td><?php echo h($ab['Brief']['created']); ?></td>
									<td class="actions">
										<?php echo $this->Html->link('<i class="fa fa-eye large-icon pull-right" tooltip="Podgląd"></i> ', array('action' => 'view', $ab['Brief']['id']), array('escape' => false, 'class' => '')); ?>
										<?php echo $this->Html->link('<i class="fa fa-pencil large-icon pull-right" tooltip="Edytuj"></i> ', array('action' => 'add', $ab['Brief']['client_lead_id'], $ab['Brief']['id']), array('escape' => false, 'class' => '')); ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
            </div>
			<?php endif; ?>
			
        </div>
        <div class="profile-content">
			<!--<div ng-init="getBrief(<?php //if(!empty($brief['Brief']['id']) && $access) echo $brief['Brief']['id']; else echo '\''.$brief['Brief']['hid'].'\''; ?>)"></div>-->
			<div ng-init="getBrief(<?php if(!empty($brief['Brief']['id'])) echo $brief['Brief']['id']; else echo 0; ?>)"></div>
			
            <?php echo $this->Metronic->portlet(__d('public', 'Brief')); ?>
            <div class="row">
				
				<?php if($_SESSION['user_permission'] && $_SESSION['user_permission'] != 'client' && $brief['Brief']['completed']): ?>
					<div class="clearfix text_center">
						<a href="/briefs/reopen_brief/<?php echo $brief['Brief']['hid']; ?>" class="btn btn-sm green-haze btn-sm margin-bottom poitnier margin-bottom-15" >Otwórz brief</a>
					</div> 
				<?php endif;  ?>
                
                
                <div class="col-md-12 col-xs-12 briefView">
                    <div class="alert alert-info" role="alert">
                        <strong><?php echo __d('Brief', 'Uwaga') ?>!</strong> <?php echo __d('Brief', 'Brief działa w formie czatu i umożliwia jednoczesne edytowanie danych zarówno przez przedstawiciela handlowego jaki i klienta') ?>.
                        <br/><strong><?php echo __d('Brief', 'Aby dodać odpowiedź należy po wpisaniu treści wcisnąć enter lub strzałkę po prawej stronie pola') ?></strong>.
                    </div>
                    
                    <?php echo $this->Metronic->portlet(__d('public', 'Informacje'), 0, null, 'blue', 0, null, 1); ?>
					
                    <div class="clearfix second-silver">
                        <div class="col-xs-12">
                            <div class="padding-top-15 padding-bottom-15">
                                <div class="clearfix title">
                                    <span class="pull-left uppercase bold"><?php echo __d('Brief', 'Tytuł briefa') ?></span>
                                </div>
                                <div class="clearfix margin-top-15">
                                    <input type="text" class="form-control" value="<?php echo $brief['Brief']['name'] ?>" disabled="disabled"/>
                                </div>
                            </div>
                        </div>
						<?php if(!empty($all_briefs) && ($_SESSION['user_permission'] == 'all' || $_SESSION['user_permission'] == 'manager' || $_SESSION['user_permission'] == 'trader')): ?>
							<div class="col-xs-12">
								<div class="padding-top-15 padding-bottom-15">
									<div class="clearfix title">
										<span class="pull-left uppercase bold"><?php echo __d('public', 'Link briefa, który można udostępnić klientowi') ?></span>
									</div>
									<div class="clearfix margin-top-15">
                                        <label class="form-control cursor-text"> <?php echo Router::url(array($brief['Brief']['hid']), true) ?></label>
									</div>
								</div>
							</div>
						<?php endif; ?>
                        <div class="col-xs-12">
                            <div class="padding-top-15 padding-bottom-15">
                                <div class="clearfix title">
                                    <span class="pull-left uppercase bold"><?php echo __d('public', 'Data utworzenia') ?></span>
                                </div>
                                <div class="clearfix margin-top-15">
                                    <div class="input-icon right">
                                        <i class="icon-calendar"></i>
                                        <input type="text" name=""  class="form-control form-control-inline" side="right"  value="<?php echo date('Y-m-d', strtotime($brief['Brief']['created'])) ?>" disabled="disabled"/>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="padding-top-15 padding-bottom-15">
                                <div class="clearfix title">
                                    <span class="pull-left uppercase bold"><?php echo __d('public', 'Opiekun klienta') ?></span>
                                </div>
                                <div class="clearfix margin-top-15">
                                    <input type="text" class="form-control" disabled="disabled" value="<?php echo $brief['Guardian']['firstname'].' '.$brief['Guardian']['surname'] ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="padding-top-15 padding-bottom-15">
                                <div class="clearfix title">
                                    <span class="pull-left uppercase bold"><?php echo __d('public', 'SKĄD DOWIEDZIELI SIĘ PAŃSTWO O NASZEJ FIRMIE') ?>?</span>
                                </div>
                                <div class="clearfix margin-top-15">
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->Metronic->portletEnd(); ?>
                </div>
                <!--<pre>{{ brief_questions_lol|json }}</pre>-->
				<?php foreach($brief_questions as $group_category => $questions): ?>
						<div class="col-md-12 col-xs-12 briefView">
							
								<?php echo $this->Metronic->portlet($group_category, 0, null, 'purple', 0, null, 1); ?>
								<div class="clearfix second-silver">

									<div class="col-xs-12">
										<div class="col-xs-12">
											<div class="padding-top-15 padding-bottom-15">
												<?php foreach($questions as $question): ?>
												<div class="clearfix title padding-top-15">
													<span class="pull-left uppercase bold"><?php echo $question['content'] ?></span>
												</div>

												<div class="clearfix margin-top-15">
													<div class=" ng-binding reset_answer" style="height: auto;" rows="5" id="answer_<?php echo $question['id']; ?>">
													</div>
													
													<?php if(!$brief['Brief']['completed']): ?>
													<div class="brief_answer_div">
														<input id="brief_answer_input_<?php echo $question['id']; ?>" type="text" class="form-control brief_answer_input" placeholder="Wpisz swoją odpowiedź" 
														   ng-model="brief_question_answers<?php echo $question['id']; ?>" 
														   ng-keypress="submitAnswer(<?php echo $question['id']; ?>,$event);" />
														<i class="fa fa-arrow-circle-o-right font-purple" tooltip="Wyślij wiadomość" ng-click="submitAnswerClick(<?php echo $question['id']; ?>);"></i>
													</div>
													<?php endif; ?>
													
												</div>
												

												<?php endforeach; ?>
											</div>
										</div>
									</div>
								</div>
								<?php echo $this->Metronic->portletEnd(); ?>
							
						</div>
					<?php endforeach; ?>
				
					
				
				
				
				</div>
            </div>
        
        <?php if($_SESSION['user_permission'] && $_SESSION['user_permission'] != 'client'): ?>
            <div class="clearfix text_center">
              
            </div>
        <?php endif;  ?>
		<?php if(!empty($_SESSION['user_permission']) && $_SESSION['user_permission'] != 'client' && empty($brief['Brief']['completed'])): //użytkownik jest zalogowany, nie jst klientem i brief nie jest zakończony ?>
            <div class="clearfix">
                <a href="client_leads/view/<?php echo $brief['ClientLead']['client_id'].'/'.$brief['ClientLead']['id'] ?>" data-toggle="modal" 
                   class="btn btn-sm green-haze btn-sm margin-bottom poitnier"><i class="fa fa-arrow-circle-left"></i> Powrót do leada</a>  
                <a href="#close_brief" data-toggle="modal" class="btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier" ><?php echo __d('public', 'Zakończ i wygeneruj PDF') ?></a>
            </div> 
		<?php endif; ?>
		<?php if((!$_SESSION['user_permission'] || (isset($_SESSION['user_permission']) && $_SESSION['user_permission'] == 'client') && empty($brief['Brief']['completed']))): //użytkownik jest niezalogowny lub zalogowany na konto klienta a brief nie jest zamkniety ?>
            <div class="clearfix" ng-if="notifySalesmanButton">
                <a class="btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier" ng-click="notifySalesman('<?php echo $brief['Brief']['hid']; ?>')" tooltip="<?php echo __d('public', 'Powiadom handlowca o zakończeniu wypełniania briefa') ?>"><?php echo __d('public', 'Powiadom handlowca') ?></a>
            </div>
			<div class="clearfix ng-cloak" ng-show="notifySended">
                <a class="btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier"><?php echo __d('public', 'Powiadomienie zostało wysłane') ?></a>
            </div>
			
<!--                <div class="btn red-sunglo dziwny_przycisk" ng-if="selectFile" ng-hide="hidde_after_time">
                    {{ selectFile}}
                </div>-->
		<?php endif; ?>
            <?php echo $this->Metronic->portletEnd(); ?>
        </div>

	
<div aria-hidden="false" role="close_brief" tabindex="-1" id="close_brief" class="modal fade" my-modal ng-class="modal_toggle ? 'in' : ''">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                <h4 class="modal-title"><?php echo __d('public', 'Zamknięcie briefa'); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo __d('public', 'Zamknięcie briefa stworzy jego nową wersje i spowoduje wysłanie maila z PDF do klienta.'); ?>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij'); ?></button>
                <a class="btn blue" href="/briefs/close_brief/<?php echo $brief['Brief']['hid'] ?>" ><?php echo __d('public', 'Potwierdź'); ?> </a>

            </div>
        </div>
    </div>
</div>
	
    </div>

<?php echo $this->Html->script('angular/controllers/BriefsCtrl',  array('block' => 'angular')); ?>