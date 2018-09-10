
<div  class="notes_list ng-cloak" ng-init="note_list = <?php echo h(json_encode($clientProjectNote)); ?>" ng-cloak>

    <div class="log_type"></div>

    <div class="panel panel-default overflow-hidden">
        <div class="panel-heading">
            <?php echo __d('public', 'Lista notatek') ?>
        </div>
        <div class="padding-15 padding-bottom-0">
            <form class="form clearfix">
                <div class="form-body  col-md-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-icon right">
                            <i class="icon-magnifier"></i>
                            <input type="text" placeholder="<?php echo __d('public', 'Szukaj') ?>..." class="form-control" ng-model="search_notes">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="clearfix">
            <div class="table-scrollable table-scrollable-borderless  margin-bottom-0">
                <table class="table table-striped table-bordered table-advance table-hover col-md-12">

                    <tr  ng-cloak  ng-repeat="log in note_list| sectionFilter:section | filter:search_notes|orderBy:'ClientProjectNote.created':true | pag:currentNoticePag:5">

                        <td ng-init="client_access = log.ClientProjectNote.client_access == true" class="text-center notesImgTd">
                            <img ng-if="log.User.avatar || log.User.avatar_url" ng-init="src = log.User.avatar_url || '/files/user/'+log.User.avatar " ng-src="{{src}}" width="50" height="50" class="center ng-cloak" />
                            <img ng-if="!log.User.avatar && !log.User.avatar_url" src="/assets/admin/pages/media/profile/avatar.png" width="50" height="50" class="center" />
                        </td>
                        <td>     
                            <div class="clearfix">
                                <div class="pull-right">
                                    {{log.ClientProjectNote.created}}
                                </div>
                                <span>{{log.Profile.firstname}} {{log.Profile.surname}}</span>
                            </div>
                            <div ng-class="{'show':show}" class="note-content margin-top-10">
                                {{log.ClientProjectNote.content}}
                            </div>
                            <div class="clearfix">
                                <span ng-click="show = !show" class="font-red pull-right pointer">
                                    <i ng-show="show"><?php echo __d('public', 'Zobacz mniej') ?></i>
                                    <i ng-hide="show"><?php echo __d('public', 'Zobacz więcej') ?></i>
                                </span>
                            </div>
                        </td>
                        <td ng-hide="user_permission == 'client'">     
                            
                                <a id="'share_note_with_client_' + log.ClientProjectNote.id"
                                   data-toggle="modal" href="#share_note_with_client_{{log.ClientProjectNote.id}}"
                                   class="pull-right" 
                                   ng-class="{'font-yellow':(1*client_access)}" 
                                   title="<?php echo __d('public', 'Udostępnianie klientowi') ?>">
                                    <i class="fa icon-star pull-right client_access_for_project_note"></i>
                                </a>

                                <div aria-hidden="true" role="share_note_with_client_{{log.ClientProjectNote.id}}" tabindex="-1" id="share_note_with_client_{{log.ClientProjectNote.id}}" class="modal fade ng-cloak" my-modal>
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                                                <h4 ng-if="!client_access" class="modal-title"><?php echo __d('public', 'Czy napewno chcesz udostępnić klientowi notatke'); ?>?</h4>
                                                <h4 ng-if="client_access" class="modal-title"><?php echo __d('public', 'Klient straci dostęp do notatki. Jesteś pewien'); ?>?</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn default" data-dismiss="modal" href="javascript:;"><?php echo __d('public', 'Zamknij'); ?></a>
                                                <a class="btn blue" ng-click="accessForClient(log.ClientProjectNote.id, !client_access);client_access=!client_access"  data-dismiss="modal" href="javascript:;"><?php echo __d('public', 'Potwierdź'); ?> </a>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            
                        </td>
                    </tr>
                </table>	

            </div>
        </div>
    </div>
    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentNoticePag" items-per-page="5" total-items="note_list| sectionFilter:section | filter:search_notes | length" boundary-links="true"></pagination>
</div>