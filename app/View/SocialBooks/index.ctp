<?php $this->Html->script('angular/controllers/SocialBookCtrl', array('block' => 'angular')); ?>
<div ng-controller="SocialBookCtrl" id="profile_cart_index">
    <?php echo $this->Metronic->portlet(__d('public','Lista użytkowników FEBbook'), 1); ?>
    <div class="clearfix row">
        <div class="col-md-3 col-sm-4 col-xs-12">
            <form class="form ng-pristine ng-valid">
                <div class="form-body">
                    <div class="form-group">
                        <div class="input-icon right">
                            <i class="icon-magnifier"></i>
                            <input ng-model="search" type="text" class="form-control" placeholder="<?php echo __d('public', 'Szukaj') ?>">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="tiles">
        <div 
            class="tile double userTile " 
            ng-repeat="user in socialBook| filter:search" 
            ng-cloak
            ng-class="{
                'hoverLink':  hoverLink,
                'hover': hover,
                'bg-purple':user.UserSection.section_id%5 == 0,
                'bg-red-sunglo':user.UserSection.section_id%5 == 1,
                'bg-blue-madison':user.UserSection.section_id%5 == 2,
                'bg-yellow':user.UserSection.section_id%5 == 3,
                'bg-green':user.UserSection.section_id%5 == 4,
                'bg-grey-silver':!user.UserSection.section_id
            }"
            >

            <div>
                <div class="tile-left">
                    <h3>{{user.Profile.firstname}} {{user.Profile.surname}}</h3>
                    <p>{{user.UserContractHistory.position}}</p>
                    <div class="tile-icons">
                        <a 
                            ng-if="user.SocialBook.facebook" 
                            href="http://facebook.com/{{user.SocialBook.facebook}}" 
                            target="_blank"
                            tooltip="{{user.SocialBook.facebook}}"
                            >
                            <i class="fa fa-facebook">
                            </i>
                        </a>

                        <i
                            ng-if="user.Profile.work_phone"
                            class="fa fa-phone" 
                            tooltip="{{user.Profile.work_phone}}">
                        </i>
                        <a href="mailto:{{user.User.email}}">
                            <i class="fa fa-at" 
                               tooltip="{{user.User.email}}">
                            </i>
                        </a>
                    </div>
                    <a ng-mouseover="hoverLink = true" 
                       ng-mouseleave="hoverLink = false" 
                       href="/social_books/view/{{user.User.email}}" 
                       class="poitnier btn btn-sm margin-bottom pull-left default"
                       >
                        Zobacz
                    </a>
                </div>
                <div class="tile-right" 
                     ng-mouseover="hover = true" 
                     ng-mouseleave="hover = false" 
                     >
                    <a href="/social_books/view/{{user.User.email}}">
<!--                        <img ng-init="src = user.User.avatar_url || '/files/user/' + user.User.avatar" ng-if="user.User.avatar || user.User.avatar_url" ng-src="{{src}}" width="135" height="135" class="center" />
                        <img ng-if="!user.User.avatar && !user.User.avatar_url" src="/assets/admin/pages/media/profile/avatar.png" width="135" height="135" class="center" />-->
                        <div ng-init="src = user.User.avatar_url || '/files/user/' + user.User.avatar" ng-if="user.User.avatar || user.User.avatar_url" 
                             class="avatarBg" style="background-image: url({{src}}); width: 135px; height: 135px;"></div>
                        <div ng-if="!user.User.avatar && !user.User.avatar_url" 
                             class="avatarBg" style="background-image: url(/assets/admin/pages/media/profile/avatar.png); width: 135px; height: 145px;"></div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php echo $this->Metronic->portletEnd(); ?>