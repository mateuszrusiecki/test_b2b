<?php
if (!empty($sections))
{
    ?>
    <div class="clearfix">
        <!--<i tooltip="<?php //echo __d('public', 'skaner działa w firefox oraz Internet Explorer') ?>" class="fa fa-exclamation-circle  font-red font-large cursor-help pull-right"></i>-->
        <i tooltip="<?php echo __d('public', 'Do działania skanera wymagane jest zakupienie licencji') ?>" class="fa fa-exclamation-circle  font-red font-large cursor-help pull-right"></i>
        <a ng-click="scanProjectFiles = true;"  class="btn btn-sm yellow margin-bottom pull-right ml"><?php echo __d('public', 'Skanuj dokumenty'); ?></a>
        <a  ng-click="addProjectFiles = true; bodyHidden = true; input = {};"  class="btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier"><?php echo __d('public', 'Dodaj plik'); ?></a>
    </div>
<?php } ?>
<div class="table-scrollable table-scrollable-borderless">
    <div class="clearfix filter">
        <div class="col-lg-2 col-md-3 col-xs-12 col-sm-6 margin-bottom-10">
            <div class="input-icon right">
                <i class="icon-magnifier"></i>
                <input ng-model="projectFilesFilter.search" type="text" side="right" class="pull-left form-control form-control-inline" name="" placeholder="<?php echo __d('public', 'Szukaj') ?>">
            </div>
        </div>

        <?php
        if (!empty($userList))
        {
            ?>
            <div class="col-lg-2 col-md-3 col-xs-12 col-sm-6 margin-bottom-10">
                <?php
                echo $this->Form->input('user_add', array(
                    'div' => ''
                    , 'empty' => __d('public', 'Dodał')
                    , 'options' => $userList
                    , 'ng-model' => "projectFilesFilter.user_add"
                    , 'class' => 'form-control'
                    , 'side' => "right"
                    , 'label' => false
                ))
                ?>
            </div>
        <?php } ?>
        <?php
        if (!empty($sections))
        {
            ?>
            <div class="col-lg-2 col-md-3 col-xs-12 col-sm-6 margin-bottom-10" ng-init="projectFilesFilter.section_id = '2'">
                <?php
                echo $this->Form->input('section_id', array(
                    'div' => ''
                    , 'empty' => __d('public', 'Dział')
                    , 'options' => $sections
                    , 'ng-model' => "projectFilesFilter.section_id"
                    , 'class' => 'form-control'
                    , 'side' => "right"
                    , 'label' => false
                ))
                ?>
            </div>
        <?php } ?>
        <div class="col-lg-3 col-md-4 col-xs-12 margin-bottom-10">
            <div class="row">
                <div class="col-xs-6">
                    <div class="input-icon right">
                        <i class="icon-calendar"></i>
                        <input ng-disabled="projectFilesFilter.data_last" ng-model="projectFilesFilter.data_from" type="text" side="right" class="form-control form-control-inline" date-picker name="" placeholder="<?php echo __d('public', 'Data od') ?>">
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="input-icon right">
                        <i class="icon-calendar"></i>
                        <input  ng-disabled="projectFilesFilter.data_last" ng-model="projectFilesFilter.data_to" type="text" side="right" class="form-control form-control-inline" date-picker name="" placeholder="<?php echo __d('public', 'Data do') ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xs-12 col-sm-6">
            <div class="row">
                <div class="col-xs-12">
                    <span ng-click="projectFilesFilter.data_last = (projectFilesFilter.data_last == 1) ? 0 : 1" ng-class="{'btn-primary':projectFilesFilter.data_last == 1, 'default':projectFilesFilter.data_last !== 1}" class="poitnier btn btn-sm   margin-bottom pull-left"><?php echo __d('public', 'Dzisiaj'); ?></span>
                    <span ng-click="projectFilesFilter.data_last = (projectFilesFilter.data_last == 7) ? 0 : 7" ng-class="{'btn-primary':projectFilesFilter.data_last == 7, 'default':projectFilesFilter.data_last !== 7}"  class="poitnier btn btn-sm margin-bottom pull-left ml"><?php echo __d('public', '7 dni'); ?></span>
                    <span ng-click="projectFilesFilter.data_last = (projectFilesFilter.data_last == 30) ? 0 : 30" ng-class="{'btn-primary':projectFilesFilter.data_last == 30, 'default':projectFilesFilter.data_last !== 30}"  class="poitnier btn btn-sm margin-bottom pull-left ml"><?php echo __d('public', '30 dni'); ?></span>
                </div>
            </div>
        </div>

    </div>
    <div  class="portlet-body">            
        <div class="table-scrollable">
            <table class="table table-striped table-bordered table-advance table-hover">
                <thead>
                <th sort by="order" reverse="reverse" class='vertical-middle center-lg' order="'ProjectFile.file'"><i class="fa fa-briefcase"></i> <?php echo __d('public', 'Nazwa'); ?></th>
                <th sort by="order" reverse="reverse" class='vertical-middle center-lg' order="'ProjectFile.created'"><i class="fa fa-calendar"></i> <?php echo __d('public', 'Data'); ?></th>
                <th sort by="order" reverse="reverse" class='vertical-middle center-lg hidden-xs' order="'Profile.surname'"><i class="fa fa-user"></i> <?php echo __d('public', 'Dodał'); ?></th>
                <th><i class="fa fa-cog"></i>  <?php echo __d('public', 'Opcje'); ?></th>
                </thead>
                <tbody>
                    <tr ng-cloak ng-repeat="projectFile in projectFiles| filterHrFiles: projectFilesFilter | orderBy:order:reverse | pag:currentPageFiles">
                        <td>
                            <i class="fa fa-file feb-icon fleft"></i> 
                            <span class="ml" > {{projectFile.ProjectFile.file}} </span>
                        </td>
                        <td class="hidden-xs">{{projectFile.ProjectFile.created}}</td>
                        <td>{{projectFile.Profile.firstname}} {{projectFile.Profile.surname}}</td>
                        <td class="action"   >

                            <a href="/project_files/delete_file/{{projectFile.ProjectFile.id}}" class="pointer" onclick="return confirm('Czy napewno chcesz usunąć?')">
                                <i class="fa fa-trash large-icon pull-right font-red" tooltip="<?php echo __d('public', 'Usuń dokument') ?>"></i>
                            </a>

                            <a ng-if="user_permission != 'client'" ng-click="fileEdit(projectFile.ProjectFile)" class="pointer">
                                <i class="fa fa-pencil-square  large-icon pull-right" tooltip="<?php echo __d('public', 'Edytuj dokument') ?>"></i> 
                            </a>  

<!--                            <a href="#" class="">
                                <i class="fa fa-print large-icon pull-right" tooltip="<?php echo __d('public', 'Drukuj') ?>"></i> 
                            </a>  -->

                            <a href="{{'/files/projectfile/' + projectFile.ProjectFile.file}}" download target="_blank" class="">
                                <i class="fa fa-download large-icon pull-right" tooltip="<?php echo __d('public', 'Pobierz') ?>"></i> 
                            </a>  

                            <a href="{{'/files/projectfile/' + projectFile.ProjectFile.file}}" target="_blank" class="">
                                <i class="fa fa-eye large-icon pull-right" tooltip="<?php echo __d('public', 'Szybki podgląd') ?>"></i> 
                            </a>  
                            <a ng-if="projectFile.ProjectFile.client_project_id"
                                href="/client_projects/<?php echo (empty($sections))?'view_client':'view'; ?>/{{projectFile.ProjectFile.client_project_id}}"
                                class=""
                                >
                                <i class="fa fa-link large-icon pull-right" tooltip="<?php echo __d('public', 'Link do projektu') ?>"></i>
                            </a> 
                        </td>
                    </tr>  

                </tbody>
            </table>
        </div>
    </div>
</div>
<pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPageFiles" items-per-page="10" total-items="projectFiles| filterHrFiles: projectFilesFilter  | length" boundary-links="true"></pagination>
