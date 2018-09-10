<?php $this->Html->script('angular/controllers/SocialBookViewCtrl', array('block' => 'angular')); ?>
<?php $this->Html->addCrumb(__d('public', 'Lista'), array('action' => 'index')); ?>
<div class="page-content" ng-controller="SocialBookViewCtrl">
    <div class="row margin-top-10" ng-init="getData('<?php echo $user_email; ?>')">
        <div class="col-xs-12">
            <div class="profile-sidebar">
                <div class="portlet light profile-sidebar-portlet">
                    <div class="profile-userpic text-center">
                        <?php
                        if (!empty($socialBook['User']))
                        {
                            $userProfile = $socialBook['User'];
                            $avatarOptions = array('width' => '135', 'height' => '135', 'crop' => true);
                            echo $this->element('default/avatar', compact('userProfile', 'avatarOptions'));
                        }
                        ?>
                    </div>
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            <?php echo $socialBook['Profile']['firstname']; ?>
                            <?php echo $socialBook['Profile']['surname']; ?>
                        </div>

                        <div class="profile-usertitle-job"><?php echo empty($contract['UserContractHistory']['position']) ? '' : $contract['UserContractHistory']['position']; ?></div>
                    </div>
                    <div class="profile-userbuttons">
                        <a href="<?php echo 'mailto:' . $socialBook['User']['email']; ?>" class="btn green-haze btn-sm"><?php echo __d('public', 'EMAIL') ?></a>
                        <a ng-if="socialBook.SocialBook.skype"
                           href="skype:{{socialBook.SocialBook.skype}}?call"
                           target="_blank"
                           class="btn bg-blue btn-sm"
                           >SKYPE</a>
                    </div>
                    <div ng-cloak class="profile-usertitle margin-top-10" style="font-size: 13px; color: grey; text-transform: none; padding-bottom: 20px;">
                        {{socialBook.SocialBook.office_room}}
                    </div>
                </div>
            </div>
            <div class="profile-content">
                <?php echo $this->Metronic->portlet(__d('public', 'Dane')); ?>

                <div class="portlet-body"
                     ><div class="col-md-7">
                             <?php echo $this->Metronic->portlet(__d('public', 'O mnie'), 0, 'fa  fa-users', 'yellow', 0); ?>
                        <div class="portlet-body">  
                            <div>
                                <div class="note note-success">
                                    <p ng-cloak ng-hide="editabout" class="pre-line">
                                        {{socialBook.SocialBook.about}}
                                    </p>
                                    <?php echo empty($isEdit) ? '' : $this->element('SocialBooks/saveSocialBook', array('field' => 'about')) ?>
                                </div>
                                <div class="tiles margin-top-20">
                                    <div class="tile bg-green editTile">
                                        <div class="tile-body">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <div class="tile-object">
                                            <div class="name">
                                                <?php echo $socialBook['Profile']['work_phone']; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tile bg-red-sunglo editTile">
                                        <div class="tile-body">
                                            <i class="fa fa-at"></i>
                                        </div>
                                        <div class="tile-object">
                                            <div class="name">
                                                <?php echo $socialBook['User']['email']; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tile bg-blue editTile">
                                        <div class="tile-body">
                                            <i class="fa fa-skype"></i>
                                        </div>
                                        <div class="tile-object">
                                            <div class="name" ng-cloak ng-hide="editskype">
                                                {{socialBook.SocialBook.skype}}
                                            </div>
                                            <?php echo empty($isEdit) ? '' : $this->element('SocialBooks/saveSocialBook', array('field' => 'skype')) ?>
                                        </div>
                                    </div>
                                    <div class="tile bg-purple editTile">
                                        <div class="tile-body">
                                            <i class="fa fa-globe"></i>
                                        </div>
                                        <div class="tile-object">
                                            <div class="name" ng-cloak ng-hide="editwebsite">
                                                {{socialBook.SocialBook.website}}
                                            </div>
                                            <?php echo empty($isEdit) ? '' : $this->element('SocialBooks/saveSocialBook', array('field' => 'website')) ?>
                                        </div>

                                    </div>
                                    <div class="tile bg-blue-steel editTile">
                                        <div class="tile-body">
                                            <i class="fa fa-facebook"></i>
                                        </div>
                                        <div class="tile-object">
                                            <div class="name" ng-cloak ng-hide="editfacebook">
                                                {{socialBook.SocialBook.facebook}}
                                            </div>
                                            <?php echo empty($isEdit) ? '' : $this->element('SocialBooks/saveSocialBook', array('field' => 'facebook')) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="note note-info">
                                    <h4 class="block"><?php echo __d('public', 'Kompetencje') ?></h4>

                                    <p ng-cloak ng-hide="editcompetence" class="pre-line">
                                        {{socialBook.SocialBook.competence}}
                                    </p>
                                    <?php echo empty($isEdit) ? '' : $this->element('SocialBooks/saveSocialBook', array('field' => 'competence')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->Metronic->portletEnd(); ?>
                    <div class="col-md-5">
                        <?php echo $this->Element('default/personal_purpose'); ?> 
                    </div>
                </div>
            </div>
            <?php echo $this->Metronic->portletEnd(); ?>
        </div>
    </div>
</div>