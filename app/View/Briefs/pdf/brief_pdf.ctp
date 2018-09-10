<div class="page-logo" style="position: absolute;z-index: 1000">
    <img class="logo-default" src="http://<?php echo $_SERVER['SERVER_NAME']?>/img/_logo_front.png" alt="Fabryka e-biznesu" style="margin-top:10px;">
</div>

<div class="row" ng-controller="BriefsCtrl">
    <div class="col-xs-12">
		<h1 style="text-align: center;padding-top: 15px;"><?php echo $brief['Brief']['name'] ?></h1>
        <div class="profile-sidebar">
            <div class="portlet light profile-sidebar-portlet">
                <div class="margin-top-5 margin-bottom-15 text_center" style="font-size: 13px; color: grey; text-transform: none;">
                    <?php echo __d('public', 'Brief przygotował') ?>:
                </div>
                
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"><?php echo $brief['Profile']['firstname'].' '.$brief['Profile']['surname'] ?></div>

                    <?php if(!empty($brief['Profile']['work_phone'])): ?><div class="profile-usertitle-job">tel: <?php echo $brief['Profile']['work_phone'] ?></div> <?php endif ?>
                </div>
                <div class="profile-userbuttons padding-bottom-15">
                    <?php echo __d('public', 'Email') ?>: <?php echo $brief['User']['email']?>
                    <!--<a href="#"  class="btn bg-blue btn-sm">SKYPE</a>-->
                </div>
            </div>
        </div>
        <div class="profile-content">
			<div ng-init="getBrief(<?php if(!empty($brief['Brief']['id'])) echo $brief['Brief']['id']; else echo 0; ?>)"></div>
			
			
            <div class="row">
                <!--<pre>{{ brief_questions_lol|json }}</pre>-->
				<?php foreach($brief_questions as $group_category => $questions): ?>
					<div class="col-md-12 col-xs-12 briefView">

						<div class="portlet box purple">								
							<div class="portlet-title">
								<div class="caption">
									<i class=""></i><?php echo $group_category ?>								
								</div>
								<div class="tools caption">
									<a class="unactive_link" href="" data-original-title="" title="">
										<i class="fa fa-close middle-icon-white"></i>
									</a>
								</div>
							</div>

							<div class="clearfix second-silver">
								<div class="col-xs-12">
								<div class="col-xs-8">
								<div class="padding-top-15 padding-bottom-15">
											<?php foreach($questions as $question): ?>
												<div class="clearfix title padding-top-15">
													<span class="pull-left uppercase bold"><?php echo $question['content'] ?></span>
												</div>

												<div class="clearfix margin-top-15">
													<div class="form-control ng-binding reset_answer" style="height: auto;" rows="5" id="answer_<?php echo $question['id']; ?>">
														<?php foreach($question['BriefAnswer'] as $brief_answer): ?>
															<strong>
																<?php 
																if(empty($users[$brief_answer['user_id']])){
																	echo '[Klient niezalogowany]';
																} else {
																	echo '['.$users[$brief_answer['user_id']]['firstname'].' '.$users[$brief_answer['user_id']]['surname'].']'; 
																} ?>
															</strong>
															<?php
																echo $brief_answer['answer'].'<br/>'; 
															?>
														<?php endforeach; ?>
													</div>
												</div>
											<?php endforeach; ?>
								</div>
								</div>
								</div>
							</div>
						</div>

					</div>
				<?php endforeach; ?>
				
			</div>
        </div>
          
    </div>

</div>

