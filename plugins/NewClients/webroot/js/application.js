var febApp = angular.module('febApp', ['ngRoute', 'ngTable', 'multi-select', 'appFilters', 'ngDialog']);

febApp.run(['$http', '$rootScope', '$templateCache', 'ngTableParams', '$document', '$timeout', '$q', 'currentUserService', '$location',
    function($http, $rootScope, $templateCache, ngTableParams, $document, $timeout, $q, currentUserService, $location) {

        //var cUd = $q.defer();
        //$rootScope.currentUser = cUd.promise;
        /*
        $http.get('api/userdata.json').success(function(data) {
            //console.log('resolve');
            //cUd.resolve(data);
            $rootScope.currentUser = data;
            $rootScope.whoami = data.name;
            $rootScope.projectName = '- nie wybrano projektu -';
        });
        */
        //console.log(currentUserService);
        currentUserService.getCurrentUser().then(function(data){
            $rootScope.currentUser = data.data;
            $rootScope.whoami = data.data.name;
            $rootScope.projectName = '- nie wybrano projektu -';

        });
        $rootScope.sideBarVisible = false;
        $rootScope.allPanelsVisible = false;
        $rootScope.leftSidebarVisible = false;
        $rootScope.commentsPanelVisible = false;
        $rootScope.commentsPanelOpened = false;
        $rootScope.catCollapsed = [ ];
        $rootScope.viewCollapsed = [[ ]];
        $rootScope.currentVersion = null;
        $rootScope.drawingMode = false;
        $rootScope.regions = [ ];
        $rootScope.showAddCommentInput = false;
        $rootScope.newComment = '';

        var x1 = 0, y1 = 0, x2 = 0, y2 = 0;
        var inDrawing = false;
        // zdarzenia od myszki
        function mouseDown(e) {
            //console.log(e);
            if (!$rootScope.drawingMode) {
                return false;
            }
            var div = document.getElementById('rectangleDiv');
            var img = document.getElementById('image');
            //console.log(img.offsetTop);
            if (inDrawing == false) {
                inDrawing = true;
                div.hidden = 0;
                x1 = e.clientX;
                y1 = e.clientY + window.pageYOffset;
                x2 = x1;
                y2 = y1;
                reCalc(div);
            } else {

                //$rootScope.$apply();
            }
            return false;
        }

        function mouseUp(e) {
            if(inDrawing==true) {
                var div = document.getElementById('rectangleDiv');
                inDrawing = false;
                reCalc(div);
                $rootScope.addRegion(div);
                div.hidden = 1;
                $rootScope.drawingMode = false;
            }
        }

        function mouseMove(e) {
            // console.log($rootScope.drawingMode);
            // console.log(inDrawing);
            if (!$rootScope.drawingMode || !inDrawing) {
                return true;
            }
            var div = document.getElementById('rectangleDiv');
            x2 = e.clientX;
            y2 = e.clientY + window.pageYOffset;
            reCalc(div);
            return true;
        }

        function reCalc(div) {
            var x3 = Math.min(x1, x2);
            var x4 = Math.max(x1, x2);
            var y3 = Math.min(y1, y2);
            var y4 = Math.max(y1, y2);
            div.style.left = x3 + 'px';
            div.style.top = y3 + 'px';
            div.style.width = x4 - x3 + 'px';
            div.style.height = y4 - y3 + 'px';
        }

        // $templateCache.removeAll();
        $document.bind('keydown', function(event) {
            // usunięcie zaznaczonego regionu
            //console.log(event);
            if (event.charCode == 127 || event.keyCode == 46) {
                for (i in $rootScope.currentVersion.Region) {
                    if ($rootScope.currentVersion.Region[i].selected === true) {
                        $http({
                            url: 'api/deleteregion/',
                            data: $.param({
                                'Region': $rootScope.currentVersion.Region[i]
                            }),
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            }
                        }).success(function(data) {
                            if(data.Status.success==1) {
                                $rootScope.currentVersion.Region.splice(i, 1);
                                //$rootScope.$apply($rootScope.currentVersion.Region);
                            }
                        });
                        break;
                    }
                }
            }
        })

        $rootScope.commentsTable = new ngTableParams({
            page: 1,
        }, {
            counts: [ ],
            total: 1,
            $scope: {$data: {}}
        });

        $rootScope.isManager = function() {
            console.warn($rootScope.currentUser);
            return $rootScope.currentUser.User.role == 'manager' ? true : false;
        }

        $rootScope.catToggleCollapse = function(category) {
            var categoryId = category.id;
            oldCollapse = $rootScope.catCollapsed[categoryId];
            for (i in $rootScope.catCollapsed) {
                $rootScope.catCollapsed[i] = 0;
            }
            $rootScope.catCollapsed[categoryId] = !oldCollapse;
            // teraz ladujemy najnowszą wersję
            console.warn(category);
            if(category.pView.length>0) {
                var view = category.pView[0];
                if(view.Version.length > 0) {
                    $rootScope.setVersion(view.Version[0]);
                }
                for (i in $rootScope.viewCollapsed[categoryId]) {
                    $rootScope.viewCollapsed[categoryId][i] = 0;
                }
                $rootScope.viewCollapsed[categoryId][view.id] = !oldCollapse;

            }

        }

        $rootScope.newProject = function() {
            $rootScope.sidebarVisible = false;
            $location.url('/settings/projects/0');
        }

        $rootScope.viewToggleCollapse = function(categoryId, view) {
            var viewId = view.id;
            //console.log(view);
            oldCollapse = $rootScope.viewCollapsed[categoryId][viewId];
            for (i in $rootScope.viewCollapsed[categoryId]) {
                $rootScope.viewCollapsed[categoryId][i] = 0;
            }
            $rootScope.viewCollapsed[categoryId][viewId] = !oldCollapse;
            if(view.Version.length > 0) {
                $rootScope.setVersion(view.Version[0]);
            }
        }

        $rootScope.toggleVersionVisibility = function(versionObj) {
            var tObj = versionObj;
            tObj.visible = tObj.visible == 0 ? 1 : 0;

            $http({
                url: 'api/setversionvisibility/',
                data: $.param({
                    'Version': versionObj
                }),
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).success(function(data) {
                if (data.Status.success) {
                    // versionObj.visible = tObj.visible;
                }
            });
            
            if(tObj.visible == 1){
                $http({
                    url: 'api/sendversionvisiblemail/',
                    data: $.param({
                        'clientEmail': $rootScope.currentClient.email,
                    }),
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                });
            }
        }

        // przelicza aktualne statusy widoków na bazie danych z
        // modelu
        // (aby nie ładować z bazy całego projektu)
        $rootScope.setViewAcceptance = function(viewId, viewAcceptanceStatus) {
            for (i in $rootScope.project.Category) {
                var category = $rootScope.project.Category[i];
                for (j in category.pView) {
                    if (category.pView[j].id == viewId) {
                        category.pView[j].acceptance_status = viewAcceptanceStatus;
                        //console.log(viewId);
                        //le.log(viewAcceptanceStatus);
                    }
                }
            }
        }

        $rootScope.toggleAcceptance = function(mode, versionObj) {           
            var tObj = versionObj;
            if (mode == tObj.acceptance_status) {
                tObj.acceptance_status = 0;
            } else {
                tObj.acceptance_status = mode;
            }
            
            fullImagePath = 'http://www.' + $location.host() + '/new_clients/storage/image/path:/' + $rootScope.currentVersion.image_path
       
            $http({
                url: 'api/setversionacceptancestatus/',
                data: $.param({
                    'Version': versionObj,
//                    'fullImagePath': fullImagePath,
//                    'clientEmail': $rootScope.currentClient.email,
//                    'coordinatorEmail': $rootScope.currentCoordinator.email,
                }),
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).success(function(data) {
                if (data.Status.success) {
                    $rootScope.setViewAcceptance(tObj.view_id, data.Status.View.acceptance_status);
                }
            });
            
            if(versionObj.acceptance_status == 1){
                $http({
                    url: 'api/sendacceptanceemails/',
                    data: $.param({
                        //'Version': versionObj,
                        'fullImagePath': fullImagePath,
                        'clientEmail': $rootScope.currentClient.email,
                        'coordinatorEmail': $rootScope.currentCoordinator.email,
                    }),
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                });
            }
            
        }
        

        $rootScope.setVersion = function(version) {
            //console.log(version);
            $rootScope.currentVersion = version;
            var drawingArea = document.getElementById('image');
            
            if(drawingArea !== null){
                $http.get('api/comments/' + version.id).success(function(data) {
                    $rootScope.currentVersion.comments = data;
                    //var drawingArea = document.getElementById('image');
                    $('#image').bind('dragstart', function() {return false});
                    drawingArea.addEventListener('mousedown', mouseDown, false);
                    drawingArea.addEventListener('mouseup', mouseUp, false);
                    drawingArea.addEventListener('mousemove', mouseMove, false);
                    var div = document.getElementById('rectangleDiv');
                    div.addEventListener('mousedown', mouseDown, false);
                    div.addEventListener('mouseup', mouseUp, false);

                });
            }
        }

        $rootScope.toggleDrawingMode = function() {
            $rootScope.drawingMode = !$rootScope.drawingMode;
        }

        $rootScope.toggleShowAddCommentInput = function() {
            if($rootScope.currentVersion != null) {
                $rootScope.showAddCommentInput = !$rootScope.showAddCommentInput;
            }
        }

        $rootScope.addRegion = function(div) {
            //console.log('add region');
            var image = document.getElementById('image');
            var fixw = image.parentElement.offsetLeft;
            var maxNumber = 0;
            for (i in $rootScope.currentVersion.Region) {
                if ($rootScope.currentVersion.Region[i].number > maxNumber) {
                    maxNumber = $rootScope.currentVersion.Region[i].number;
                }
            }
            maxNumber++;

            var region = {
                top: div.style.top.substr(0, div.style.top.length - 2),
                left: div.style.left.substr(0, div.style.left.length - 2) - fixw,
                width: div.style.width.substr(0, div.style.width.length - 2),
                height: div.style.height.substr(0, div.style.height.length - 2),
                number: maxNumber,
                version_id: $rootScope.currentVersion.id,
                Comment: [ ],
                User: { role: $rootScope.currentUser.role}
            }
            $rootScope.currentVersion.Region.push(region);
            $rootScope.selectRegion(region);
            $timeout(function(){
                //$rootScope.$apply($rootScope.currentVersion.Region);
            })

            $http({
                url: 'api/saveregion/',
                data: $.param({
                    'Region': region
                }),
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).success(function(data) {
                if (data) {
                    region.id = data.Region.id;
                }
            });
        }

        $rootScope.selectRegion = function(region) {
            for (i in $rootScope.currentVersion.Region) {

                if ($rootScope.currentVersion.Region[i] == region) {
                    $rootScope.currentVersion.Region[i].selected = !$rootScope.currentVersion.Region[i].selected;
                    if($rootScope.currentVersion.Region[i].selected) {
                        $rootScope.currentRegion = region;
                    } else {
                        $rootScope.currentRegion = null;
                    }
                } else {
                    $rootScope.currentVersion.Region[i].selected = false;

                }
            }

        }

        $rootScope.toDelete = function(e) {
            console.log(e);
        }

        function addComment(comment) {
            $rootScope.currentVersion.comments.splice(0, 0, comment);
            //console.log($rootScope.currentVersion.comments);
            $rootScope.commentsTable.total($rootScope.currentVersion.comments.length);
            $timeout(function(){
                $rootScope.$apply($rootScope.currentVersion.comments);
            });
            //console.log(comment);
            $http({
                url: 'api/savecomment/',
                data: $.param(comment),
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).success(function(data) {
                if (data) {
                    comment.Comment.id = data.Comment.id;

                }
            });

        }

        $rootScope.addCommentWithoutRegion = function() {
            if($rootScope.newComment=='')
                return;
            var d = new Date();
            var comment = {
              Comment: {
                  user_id: $rootScope.currentUser.id,
                  region_id: null,
                  version_id: $rootScope.currentVersion.id,
                  content: $rootScope.newComment,
                  created: d.format('Y-m-d H:i')
              },
              User: {
                  role: $rootScope.currentUser.role,
                  Profile: {
                      name: $rootScope.currentUser.name,
                  }
              },
              Region: {
                  id: null,
              }
            };
            addComment(comment);
            $rootScope.newComment = '';
            $rootScope.showAddCommentInput = false;
        }

        $rootScope.addComment = function() {
            if($rootScope.newComment=='')
                return;

            var d = new Date();
            var comment = {
              Comment: {
                  user_id: $rootScope.currentUser.id,
                  region_id: $rootScope.currentRegion.id,
                  version_id: $rootScope.currentVersion.id,
                  content: $rootScope.newComment,
                  created: d.format('Y-m-d H:i')
              },
              User: {
                  role: $rootScope.currentUser.role,
                  Profile: {
                      name: $rootScope.currentUser.name,
                  }
              },
              Region: {
                  id: $rootScope.currentRegion.id,
                  number: $rootScope.currentRegion.number
              }
            };
            addComment(comment);
            $rootScope.newComment = '';
            //console.log($rootScope.currentVersion.comments);
        }

    }]);
