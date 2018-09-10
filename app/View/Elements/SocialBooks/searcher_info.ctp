<div ng-controller="SearchersCtrl">
    <div ng-init="socialBooks = <?php echo a(@$socialBooks); ?>"></div>
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
                        <th sort by="order" reverse="reverse" order="'User.email'" class='vertical-middle'>
                            <i class="fa fa-barcode"></i>
                            Link do profilu pracownika
                        </th>
                        <th sort by="order" reverse="reverse" order="'foundIn'" class='vertical-middle'>
                            <i class="fa fa-square"></i>  
                            Znaleziona fraza
                        </th>                        
                    </thead>
                    <tbody>
                        <tr ng-cloak ng-repeat="socialBook in socialBooks | filter:search | orderBy:order:reverse | pag: currentPage : 10">
                            <td>
                                {{$index + 1}}
                            </td>
                            <td>
                                <a ng-if="socialBook.User.email" ng-href="{{'/social_books/view/' + socialBook.User.email}}">{{'/social_books/view/' + socialBook.User.email}}</a>
                            </td>
                            <td>
                                <span ng-bind-html="renderHtml(socialBook.foundIn)"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="socialBooks | filter:search | length" boundary-links="true"></pagination>
</div>