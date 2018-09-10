<?php echo $this->Metronic->portlet(__d('public','Lista dokumentów tekstowych')); ?>

    <div aria-hidden="true" role="dialog" tabindex="-1" id="add_calendar_modal" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    <h4 class="modal-title"><?php echo __d('public', 'Dodaj nowy dokument') ?></h4>                    
                </div>
                <div class="modal-body">
                    <?php echo $this->Form->create('Calendar', array('controller' => 'Calendars', 'action' => 'add')); ?>
                    <div>
                        <?php
                            echo $this->Metronic->input('name', array(
                                'label' => 'Nazwa kalendarza',
                                'value' => isset($calendar['Calendar']['name']) ? $calendar['Calendar']['name'] : '',
                            ));
                            echo $this->Metronic->input('year', array(
                                'label' => 'Rok',
                                'value' => isset($calendar['Calendar']['year']) ? $calendar['Calendar']['year'] : '',
                            ));
                            echo $this->Metronic->input('id', array(
                                'value' => isset($calendar['Calendar']['id']) ? $calendar['Calendar']['id'] : '',
                            ));
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij') ?></button>
                    <button class="btn blue-madison" type="submit"><?php echo __d('public', 'Dodaj') ?></button>
                </div>

                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>

<div ng-controller="TextDocumentsCtrl">

    <div aria-hidden="true" role="dialog" tabindex="-1" id="delete_calendar" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    <h4 class="modal-title"><?php echo __d('public', 'Usuń dokument') ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo __d('public', 'Czy na pewno chcesz usunąć dokument?') ?>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij') ?></button>
                    <button data-dismiss="modal" ng-click="deleteDocument()" class="btn blue-madison"><?php echo __d('public', 'Potwierdź') ?></button>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix" ng-init="user_permission = '<?php echo $user_permission ?>'">
        <span class="ml caption-subject font-blue-madison bold uppercase ng-cloak " ng-if="clientLeadInfo.ClientLead.name">{{'Lead ' + clientLeadInfo.ClientLead.name}}</span>
        <a ng-show="lead_id == null && (user_permission == 'all' || user_permission == 'manager')" class="btn btn-sm yellow margin-bottom pull-right ml ng-cloak" id="add_new_calendar" href="/text_documents/create"><?php echo __d('public', 'Dodaj nowy dokument') ?></a>
        <a ng-show="lead_id != null && (user_permission == 'all' || user_permission == 'manager')" class="btn btn-sm yellow margin-bottom pull-right ml ng-cloak" id="add_new_calendar" href="/text_documents/create/{{lead_id}}"><?php echo __d('public', 'Dodaj nowy dokument') ?></a>
    </div>

    <div class="table-scrollable table-scrollable-borderless">
        <div class="clearfix">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form>
                    <div class="input-icon right">
                        <i class="icon-magnifier"></i>
                        <div class="form-group">
                            <div class="input-icon right">
                                <input ng-model="search" type="text" id="search_box" placeholder="<?php echo __d('public', 'Szukaj') ?>" side="right" class="form-control form-control-inline" />
                            </div>
                        </div>                    
                    </div>
                </form>
            </div>	
        </div>
        <div class="portlet-body">            
            <div class="table-scrollable">
                <table class="table table-striped table-bordered table-advance table-hover" ng-if="textdocuments">
                    <thead>
                        <th sort by="order" reverse="reverse" order="'TextDocument.name'" class='vertical-middle'>
                            <i class="fa fa-tags"></i> 
                            <?php echo __d('public', 'Nazwa'); ?>
                        </th>
                        <th sort by="order" reverse="reverse" order="'TextDocument.share_link'" class='vertical-middle'>
                            <i class="fa fa-file-o"></i>
                            <?php echo __d('public', 'Link do współdzielenia'); ?>
                        </th>
                        <th>
                            <i class="fa fa-cog"></i>  
                            <?php echo __d('public', 'Opcje'); ?>
                        </th>
                    </thead>
                    <tbody>
                        <tr ng-cloak ng-repeat="textDocument in textdocuments.textdocuments | filter:search | orderBy:order:reverse | pag: currentPage : 10">
                            <td>
                                {{textDocument.TextDocument.name}}
                            </td>
                            <td>
                                <!--{{ textDocument.TextDocument.share_link }}-->
                                <span ng-show="lead_id == null && (userdata.id == textDocument.TextDocument.user_id || textDocument.TextDocument.share_block == 0)" class="pointer">
                                    {{"http://www." + hostName + "/text_documents/update/" + textDocument.TextDocument.id}} 
                                </span>                                                        
                                
                                <span ng-show="lead_id != null && (userdata.id == textDocument.TextDocument.user_id || textDocument.TextDocument.share_block == 0)" class="pointer" ng-bind="'/text_documents/update/' + textDocument.TextDocument.id + '/' + lead_id">
                                    {{"http://www." + hostName + "/text_documents/update/" + textDocument.TextDocument.id + "/" + lead_id}}
                                </span>
                            </td>
                            <td>
                                <a ng-if="userdata.id == textDocument.TextDocument.user_id" class="pointer" class="action" id="delete_calendar" href="#delete_calendar" data-toggle="modal">
                                    <i class="fa fa-close large-icon pull-right" ng-click="setClickedDocumentId(textDocument.TextDocument.id, $index)" tooltip="<?php echo __d('public', 'Usuń') ?>"></i>
                                </a>  
                                
                                <a ng-show="lead_id == null && (userdata.id == textDocument.TextDocument.user_id || textDocument.TextDocument.share_block == 0)" class="pointer" ng-href="/text_documents/update/{{textDocument.TextDocument.id}}">
                                    <i class="fa fa-eye large-icon pull-right" tooltip="<?php echo __d('public', 'Edycja/Podglad') ?>"></i> 
                                </a>                                                        
                                
                                <a ng-show="lead_id != null && (userdata.id == textDocument.TextDocument.user_id || textDocument.TextDocument.share_block == 0)" class="pointer" ng-href="/text_documents/update/{{textDocument.TextDocument.id}}/{{lead_id}}">
                                    <i class="fa fa-eye large-icon pull-right" tooltip="<?php echo __d('public', 'Edycja/Podglad') ?>"></i> 
                                </a>
                                
                                <p ng-show="userdata.id != textDocument.TextDocument.user_id && textDocument.TextDocument.share_block == 1" class="pointer">
                                    <i class="fa fa-minus-square font-red pull-right" tooltip="<?php echo __d('public', 'Edycja zablokowana przez autora') ?>"></i>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="textdocuments | filter:search | length" boundary-links="true"></pagination>
</div>
<?php echo $this->Metronic->portletEnd(); ?>   