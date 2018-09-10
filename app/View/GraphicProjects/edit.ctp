<div ng-controller="ProjectDetailCtrl">
    <div style="margin: 0 auto; width: 100%" ng-cloak>
        <div style="height: auto; position: relative; margin: 0 auto;">
            <img ng-src="/storage/image/path:/{{$root.currentVersion.image_path}}"
                style="margin: auto; display: block; height: auto; position: relative"
                id="image" fixparentwidth>
        </div>
    </div>
        <!--
        <div class="rectangle" ng-class="{'selected': region.selected}"
            ng-repeat="region in $root.currentVersion.Region"
            ng-style="{'top': region.top+'px', 'left': region.left+'px', 'width': region.width+'px', 'height': region.height+'px'}"
            ng-click="selectRegion(region)" ng-keypress="toDelete($event)">
            <div class="number badge badge-info">{{region.number}}</div>
            <div class="comments-count sb-comments-number">
                <i class="fa fa-comment-o"><span class="comment badge badge-default">{{region.Comment.length}}</span></i>
            </div>
        </div>
        -->
        <!--
        <div ng-repeat-start="region in $root.currentVersion.Region"
            style="z-index: 5;" class="region-circle pointer"
            ng-click="selectRegion(region)" ng-show="settings.getData().allPanelsVisible==true"
            ng-style="{'top': region.top+'px', 'left': region.left+'px'}">
            <i class="fa fa-circle" ng-show="region.selected" style="color: white; z-index: 5; left: 0px; top: 0px; position: absolute"></i>
            <i class="fa" style="z-index: 6; top: 0; top: 0; position: absolute"
                ng-class="{'feb': region.User.role=='manager', 'blue': region.User.role!='manager', 'fa-circle-o': region.selected, 'fa-circle': !region.selected}"></i>

            <span class="region-circle-number" style="position: absolute; top: 0; left: 0"
                ng-class="{'feb': region.User.role=='manager' && region.selected, 'blue': region.User.role!='manager' && region.selected, 'white': !region.selected}">{{region.number}}</span>

        </div>
        -->
        <!--
        <div class="tcomments"
            ng-style="{'top': region.top+'px', 'left': (region.left*1+region.width*1+4)+'px'}"
            ng-show="region.selected">
            <div class="tcomments-content" ng-cloak>
                <div class="tcomment-comment"
                    ng-repeat="item in $root.currentVersion.comments | commentRegionFilter:region.id">
                    <div class="commentheader" style="padding: 2px 10px 2px 10px"
                        ng-class="{'bgfeb': item.User.role=='manager', 'bgblue': item.User.role!='manager'}">
                        <div class="pull-left">
                            <b>{{item.User.name}}</b>
                        </div>
                        <div class="pull-right">{{item.Comment.created |
                            febDateFormat}}</div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="commentbody">{{item.Comment.content}}</div>
                </div>
            </div>
            <div class="tcomments-add">
                <div class="input-icon right">
                    <i class="fa fa-plus-circle pointer" ng-click="addComment(t)"></i><input
                        type="text" class="form-control" name="newComment"
                        placeholder="Odpowiedz..." ng-model="$root.newComment"
                        style="font-size: 11px" ng-keyup="$event.keyCode==13?addComment(t):null"
                        >
                </div>
            </div>
        </div>
        <div ng-repeat-end class="rectangle" style="z-index: 2"
            ng-show="region.selected"
            ng-style="{'top': region.top+'px', 'left': region.left+'px', 'width': region.width+'px', 'height': region.height+'px'}"></div>
    </div>
</div>
        -->
</div>