<div ng-controller="SearchersCtrl">
    <div ng-init="clientProjects = <?php echo a(@$myProjects); ?>"></div>
    <div class="table-scrollable table-scrollable-borderless">
        <div class="clearfix">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <form>
                    <div class="input-icon right">
                        <i class="icon-magnifier"></i>
                        <div class="form-group">
                            <div class="input-icon right">
                                <input ng-model="search" type="text" id="search_box" placeholder="Szukaj" side="right" class="form-control form-control-inline" />
                            </div>
                        </div>                    
                    </div>
                </form>
            </div>	
        </div>
        <div class="portlet-body">            
            <div class="table-scrollable">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <th>
                            #
                        </th>
                        <th sort by="order" reverse="reverse" order="'ClientProject.client_project_id'" class='vertical-middle'>
                            <i class="fa fa-barcode"></i>
                            Link do projektu
                        </th>
                        <th sort by="order" reverse="reverse" order="'ClientProject.foundIn'" class='vertical-middle'>
                            <i class="fa fa-square"></i>  
                            Znaleziona fraza
                        </th>                        
                    </thead>
                    <tbody>
                        <tr ng-cloak ng-repeat="clientProject in clientProjects | filter:search | orderBy:order:reverse | pag: currentPage : 10">
                            <td>
                                {{$index + 1}}
                            </td>
                            <td>
                                <a ng-if="clientProject.ClientProject.client_project_id" ng-href="{{'/client_projects/view/' + clientProject.ClientProject.client_project_id}}">{{'/client_projects/view/' + clientProject.ClientProject.client_project_id}}</a>
                            </td>
                            <td>
                                <span ng-bind-html="renderHtml(clientProject.ClientProject.foundIn)"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="clientProjects | filter:search | length" boundary-links="true"></pagination>
</div>