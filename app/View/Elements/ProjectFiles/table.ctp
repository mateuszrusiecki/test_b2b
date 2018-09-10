<!--     //     -->
<!--LISTA PLIKÓW-->
<!--     //     -->
<div class="project_fle_list" ng-controller="ProjectFilesCtrl as project_file">
    <table class="table table-bordered table-advance table-hover tbody-striped">
        <thead ng-init="orderFile = 'ProjectFile.created'; reverseFile = true;">
            <tr>
                <th sort by="orderFile" reverse="reverseFile" order="'ProjectFile.file'"><i class="fa fa-briefcase"></i> <?php echo __d('public', 'Nazwa'); ?></th>
                <th sort by="orderFile" reverse="reverseFile" order="'ProjectFile.file_category_name'"><i class="fa fa-suitcase"></i> <?php echo __d('public', 'Kategoria'); ?></th>
                <th sort by="orderFile" reverse="reverseFile" order="'ProjectFile.created'"><i class="fa fa-info"></i> <?php echo __d('public', 'Informacje'); ?></th>
                <th><i class="fa fa-cog"></i></th>
            </tr>
        </thead>
        <tbody  ng-cloak ng-repeat="file in  files| obj2arr | sectionFilter: section | filter:filesearch | orderBy:orderFile:reverseFile| pag:currentFilePag:10">
            <tr ng-if="!file.ProjectFile.text_document">
                <td>
                    <i ng-show="file.children" class="fa fa-plus pointer" ng-click="tableChildren = !tableChildren"></i>
                    <!-- @todo [TODO] Nazwa, będąca jednocześnie linkiem do pobierania pliku (wprzypadku Text Cooperation - edycji pliku)-->
                    <checkbox ng-model="file.ProjectFile.selected" name="file_id[]" value="{{file.ProjectFile.id}}"></checkbox>
                    <!--<a class="" href="/client_projects/file_save/{{file.ProjectFile.id}}" title="{{file.ProjectFile.file}}" > {{file.ProjectFile.file}} </a>--> 
                    <a class="" href="/client_projects/file_save/{{file.ProjectFile.id}}/{{ file.ProjectFileCategory.name == 'Brief' ? 'leadfile' : '' }}" title="{{file.ProjectFile.file}}" > {{file.ProjectFile.file}} </a>
                </td>

                <td>{{file.ProjectFileCategory.name}}</td>

                <td class="projest_document_table_row">
                    <?php echo __d('public', 'Utworzenie'); ?>: {{file.ProjectFile.created}}<br/>
                    <?php echo __d('public', 'Modyfikacja'); ?>: {{file.ProjectFile.modified}}
                </td>

                <td ng-init="client_available = file.ProjectFile.client_available"> 
                    <a ng-hide="user_authorized == 'client'" ng-click="fileEdit(file.ProjectFile)" class="pointer font-green" title="<?php echo __d('public', 'Dodaj nowszą wersję pliku') ?>">
                        <i class="fa fa-plus-square-o font-large"></i>
                    </a>
                    <a class=" copy_link" href="#copy_link" title="<?php echo __d('public', 'Link do pliku króty można skopiować i udostępnić') ?>" data-toggle="modal" ng-click="copyLink('<?php echo $this->Html->url('/client_projects/file_save/', true) ?>' + file.ProjectFile.id)">
                        <i class="fa fa-link font-large"></i>
                    </a>
                    <a ng-hide="user_authorized == 'user' || user_authorized == 'client' " class=" copy_link pointer font-red"  title="<?php echo __d('public', 'Usuń plik') ?>" ng-click="$parent.deleteFile = file.ProjectFile.id">
                        <i class="fa fa-trash-o font-large"></i>
                    </a>
                    <a id="'share_with_client_' + file.ProjectFile.id" ng-hide="user_authorized == 'user' || user_authorized == 'client'" 
                       data-toggle="modal" href="#share_with_client_{{file.ProjectFile.id}}"
                       ng-click="client_available=!(1*client_available)" 
                       class="pointer font-grey-salsa animate-if" 
                       ng-class="{'font-yellow':(1*client_available)}" 
                       tooltip="<?php echo __d('public', 'Udostępnianie klientowi') ?>">
                        <i class="fa icon-star font-large"></i>
                    </a>
                    
                        <div aria-hidden="true" role="share_with_client_{{file.ProjectFile.id}}" tabindex="-1" id="share_with_client_{{file.ProjectFile.id}}" class="modal fade" my-modal>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                                        <h4 ng-if="client_available" class="modal-title"><?php echo __d('public', 'Czy napewno chcesz udostępnić klientowi plik'); ?>: {{file.ProjectFile.file}} ?</h4>
                                        <h4 ng-if="!client_available" class="modal-title"><?php echo __d('public', 'Klient straci dostęp do pliku'); ?>: {{file.ProjectFile.file}}. <?php echo __d('public', 'Jesteś pewien'); ?>?</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <a class="btn default" ng-click="client_available=!(1*client_available)" data-dismiss="modal" href="javascript:;"><?php echo __d('public', 'Zamknij'); ?></a>
                                        <a class="btn blue" ng-click="clientShare(file.ProjectFile.id, (1*client_available));"  data-dismiss="modal" href="javascript:;"><?php echo __d('public', 'Potwierdź'); ?> </a>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                </td>
            </tr>
            <tr ng-if="file.ProjectFile.text_document">
                <td>
                    <a class="" href="/text_documents/update/{{file.ProjectFile.id }}/{{file.ProjectFile.lead_id}}" target="_blank">{{file.ProjectFile.name }}</a>
                </td>
                <td>Dokument TC</td>

                <td class="projest_document_table_row">
                    <?php echo __d('public', 'Utworzenie'); ?>: {{file.ProjectFile.created}}<br/>
                    <?php echo __d('public', 'Modyfikacja'); ?>: {{file.ProjectFile.modified}}
                </td>

                <td> 
                    <a class=" copy_link" href="#copy_link" title="<?php echo __d('public', 'Link do pliku króty można skopiować i udostępnić klientowi') ?>" data-toggle="modal" ng-click="copyLink( file.ProjectFile.share_link)">
                        <i class="fa fa-link font-large"></i>
                    </a>
                </td>
            </tr>
            <tr ng-show="tableChildren" ng-cloak  ng-repeat="children in file.children">
                <td colspan="2">
                    <a class="" href="/client_projects/file_save/{{children.ProjectFile.id}}" title="{{children.ProjectFile.file}}" > {{children.ProjectFile.file}} </a> 
                </td>
                <td colspan="2">
                    {{children.ProjectFile.created}}
                    {{children.Profile.firstname}} 
                    {{children.Profile.surname}}
                </td>
            </tr>
        </tbody>
    </table>


    <div aria-hidden="true" role="copy_link" tabindex="-1" id="copy_link" class="modal fade" my-modal>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    <h4 class="modal-title"><?php echo __d('public', 'Link do pliku króty można skopiować i udostępnić.'); ?></h4>
                </div>
                <div class="modal-body">
                    <p>
                        <?php
                        echo $this->Form->input('copy_link.', array(
                            'type' => 'input',
                            'label' => false,
                            'class' => 'pull-left form-control',
                            'id' => 'copy_link',
                            'ng-model' => 'copylink',
                            'div' => false,
                        ));
                        ?>
                    </p>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn default" type="button"><?php echo __d('public', 'Zamknij'); ?></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div ng-cloak class="modal-backdrop fade in ng-cloak" ng-show="deleteFile"></div>
    <div ng-cloak aria-hidden="true" tabindex="-1" ng-show="deleteFile" class="angular-modal ng-cloak">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" ng-click="deleteFile = false" class="close" type="button"></button>
                    <h4 class="modal-title"><?php echo __d('public', 'Potwierdzenie usunięcia pliku'); ?></h4>
                </div>
                <div class="modal-body">
                    Czy napewno chcesz usunąc plik?
                </div>
                <div class="modal-footer">
                    <button ng-click="deleteFile = false" class="btn default" type="button"><?php echo __d('public', 'Zamknij'); ?></button>
                    <a class="btn blue" ng-click="onDeleteFile(deleteFile, deleteFileType)" data-dismiss="modal" href="javascript:;"><?php echo __d('public', 'Potwierdź'); ?> </a>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>
