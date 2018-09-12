/*
 * Definicja routingu oraz
 * zestaw kontrollerów dla Managera
 */

//.when('/project/:projectId/:viewId/', {
//        templateUrl: 'partials/project-detail.html',
//        controller: 'ProjectDetailCtrl'
//    })

febApp.config(['$routeProvider', function($routeProvider) {
    $routeProvider.when('/projects/:mode/:leadOrProjectId/', {
        templateUrl: 'partials/project-list.html',
        controller: 'ProjectListCtrl'
    }).when('/projects/', {
        templateUrl: 'partials/project-list.html',
        controller: 'ProjectListCtrl'
    }).when('/project/:projectId/', {
        templateUrl: 'partials/project-detail.html',
        controller: 'ProjectDetailCtrl'
    }).when('/project/:mode/:leadOrProjectId/:projectId/', {
        templateUrl: 'partials/project-detail.html',
        controller: 'ProjectDetailCtrl'
    }).when('/settings/', {
        templateUrl: 'partials/settings.html',
        controller: 'SettingsCtrl'
    }).when('/settings/leadProjectMode/:leadOrProjectMode/:leadOrProjectId/', {
        templateUrl: 'partials/settings.html',
        controller: 'SettingsCtrl'
    }).when('/settings/:mode/', {
        templateUrl: 'partials/settings.html',
        controller: 'SettingsCtrl'
    }).when('/settings/:mode/:projectId/', {
        templateUrl: 'partials/settings/projectsetup.html',
        controller: 'ProjectSetupCtrl'
    }).when('/settings/:mode/:leadOrProjectMode/:leadOrProjectId/:projectId/', {
        templateUrl: 'partials/settings/projectsetup.html',
        controller: 'ProjectSetupCtrl'
    }).otherwise({
        redirectTo: '/projects/'
    });
}]);

febApp.controller('ProjectListCtrl', [
    '$scope',
    '$rootScope',
    '$location',
    '$window',
    '$routeParams',
    'ProjectService',
    'UserService',
    '$http',
    function($scope, $rootScope, $location, $window ,$routeParams, ProjectService, UserService, $http) {
        ProjectService.list().then(function(data) {            
            $scope.projects = data.data;
            $rootScope.projects = data.data;
            $rootScope.sidebarVisible = false;
        });
        $rootScope.project = {
            Category: {},
            pView: {}
        };
        
        $rootScope.routeParams = $routeParams;

        if($routeParams.hasOwnProperty('mode') && $routeParams.mode === 'lead_id'){
        
            $http.post('api/get_lead.json', {lead_id : $routeParams.leadOrProjectId}).success(function(data){

                $scope.clientLeadInfo = data;
            });
        } else if($routeParams.hasOwnProperty('mode') && $routeParams.mode === 'client_project_id'){

            $http.post('api/get_client_project.json', {client_project_id : $routeParams.leadOrProjectId}).success(function(data){

                $scope.clientProjectInfo = data;
            });
        }
        
        $scope.$watch('query', function(){
            $window.localStorage && $window.localStorage.setItem('query', $scope.query);
        });
        $scope.$watch('showArchived', function() {
            $window.localStorage && $window.localStorage.setItem('showArchived', $scope.showArchived);
        })
        $scope.$watch('managersFilter', function() {
            //console.log($scope.managersFilter);
            $window.localStorage && $window.localStorage.setItem('managersFilter', JSON.stringify($scope.managersFilter));
        })
        //document.body.style.backgroundColor = '#fff';
        $scope.managers = [];
        $scope.query = $window.localStorage.getItem('query') || '';
        $scope.showArchived = $window.localStorage.getItem('showArchived') || false;
        $scope.managersFilterLS = JSON.parse($window.localStorage.getItem('managersFilter')) || [];

        UserService.managers().then(function(data) {
            angular.forEach(data, function(value, key) {
                if(typeof value.User !== 'undefined') {
                  var newUser = {};
                  newUser.id = value.User.id;
                  newUser.name = value.Profile.name;
                  newUser.selected = false;
                  if (newUser.id == $rootScope.currentUser.id) {
                    if ($scope.managersFilterLS.length == 0) {
                      newUser.selected = true;
                    }
                  }
                  if ($scope.managersFilterLS.length > 0) {
                    for (var i in $scope.managersFilterLS) {
                      if (newUser.id == $scope.managersFilterLS[i].id) {
                        newUser.selected = true;
                        //console.log('SEL');
                        break;
                      }
                    }
                  }
                  $scope.managers.push(newUser);
                }
            })
        });
        $rootScope.allPanelsVisible = false;

        $scope.mySearch = function(item) {

            if ($scope.showArchived!=='true' && item.Project.archived == 1) {
                return false;
            }
            var found = false;
            angular.forEach($scope.managersFilter, function(value, key){
                if(value.id == item.Project.manager_id) {
                    found = true;
                }

            });
            if(found === false) {
                return false;
            }

            if(item.Client.Profile !== undefined){
                if (angular.lowercase(item.Client.Profile.name).indexOf(angular.lowercase($scope.query)) != -1
                        || angular.lowercase(item.Project.title).indexOf(angular.lowercase($scope.query)) != -1) {
                    return true;
                }
            }
            
            if(item.B2BClient.name !== null){
                if (angular.lowercase(item.B2BClient.name).indexOf(angular.lowercase($scope.query)) != -1) {
                    return true;
                }
            }
            //console.log($scope.managersFilter);
            return false;
        }

        $scope.go = function(path) {
            $location.path(path);
        }

        $scope.sendCommentsEmails = function() {
            $http.get('emails/sendCommentsEmails/');
        }    

        $scope.showClientAuthInfo = function(client) {
            bootbox.alert({
                title: 'Dane dostępowe dla <b>' + client.Profile.name + '</b>:',
                message: 'Witam,<br><br>przesyłam dostęp do projektów graficznych do realizowanego dla Państwa zlecenia:<br><br>' +
                    'user: ' + client.username + '<br>hasło: ' + client.clearpassword + '<br><br>' +
                    'http://projekty-graficzne.feb.net.pl'
            });
        }
    }]);

febApp.controller('ProjectDetailCtrl', ['$scope', '$http', '$rootScope', 'ProjectService', '$routeParams','GlobalService',
    function($scope, $http, $rootScope, ProjectService, $routeParams, GlobalService) {
        ProjectService.list().then(function(data) {
            $scope.projects = data.data;
            $rootScope.projects = data.data;
            $rootScope.commentsPanelVisible = true;
            $rootScope.sidebarVisible = true;
        });
              
        $rootScope.routeParams = $routeParams;      
        
        $scope.settings = GlobalService;
        document.body.style.backgroundColor = '#fff';
        $scope.currentProjectId = $routeParams.projectId;
        $scope.newComment = '';
        $rootScope.currentProjectId = $routeParams.projectId;
        $http.get('api/projectdetail/' + $routeParams.projectId + '.json').success(function(data) {
            $rootScope.project = data;
            $scope.project = data;
            $rootScope.projectName = data.Project.title;
  
            //if(data.Client.Profile !== undefined){
                //$rootScope.clientName = data.Client.Profile.name;
            //} else {
                $rootScope.clientName = data.B2BClient.name;
            //} 
            
            $rootScope.currentClient = data.B2BClient;
            $rootScope.currentCoordinator = data.Manager;
            //console.log($rootScope.currentClient);
            //console.log($rootScope.currentCoordinator);
            
            $rootScope.leftSidebarVisible = 1;
            project = $scope.project;
            for (i in project.Category) {
                $rootScope.catCollapsed[project.Category[i].id] = false;
                for (j in project.Category[i].pView) {
                    if (typeof ($rootScope.viewCollapsed[project.Category[i].pView[j].category_id]) == 'undefined') {
                        $rootScope.viewCollapsed[project.Category[i].pView[j].category_id] = [ ];
                    }
                    $rootScope.viewCollapsed[project.Category[i].pView[j].category_id][project.Category[i].pView[j].id] = false;
                }
            }
            $rootScope.allPanelsVisible = true;

            // otwieramy pierwszą kategorię, pierwszy widok i ładujemy najnowszą wersję (jeśli nie podano viewId)
            //$rootScope.catCollapsed[p]
            if(!$routeParams.hasOwnProperty('viewId')) {
                $rootScope.catCollapsed[project.Category[0].id] = true;
                $rootScope.viewCollapsed[project.Category[0].pView[0].category_id][project.Category[0].pView[0].id] = true;
                // ustawiamy wersję
                if(project.Category[0].pView[0].Version[0] !== null){
                    $rootScope.setVersion(project.Category[0].pView[0].Version[0]);
                } 
            } else {
                angular.forEach(project.Category, function(category, key){
                    angular.forEach(category.pView, function(view, key1){
                        if(view.id == $routeParams.viewId) {
                            $rootScope.catCollapsed[category.id] = true;
                            $rootScope.viewCollapsed[category.id][view.id] = true;
                            $rootScope.setVersion(view.Version[0]);
                            return;
                        }
                    });
                });
            }


        });

    }]);

febApp.controller('SettingsCtrl', ['$scope', '$rootScope', '$http', 'ProjectService', 'UserService', 'ngDialog', '$routeParams',
    function($scope, $rootScope, $http, ProjectService, UserService, ngDialog, $routeParams) {

        $rootScope.allPanelsVisible = false;
        $scope.mode = 'projects';
        if($routeParams.hasOwnProperty('mode')) {
            $scope.mode = $routeParams.mode;
        }

        $rootScope.routeParams = $routeParams;
        
        ProjectService.list().then(function(data) {
            $scope.projects = data.data;
        })

        UserService.list().then(function(data) {
            $scope.users = data;
        })

        UserService.managers().then(function(data) {
            $scope.managersSelect = data;
        })
        
        $scope.accessDialog = function(user) {
            $scope.user = {};
            angular.copy(user, $scope.user);
            if(user == null) {
                $scope.user.User = {};
                $scope.user.User.role = 'client';
            }
            var result = ngDialog.open({
                template: 'partials/settings/accessform.html',
                controller: 'AccessCtrl',
                closeByEscape: true,
                closeByDocument: false,
                scope: $scope,
            });
            result.closePromise.then(function(data){
                if(typeof(data.value)!=='undefined' && data.value=='*') {
                    $http({
                        url: 'api/saveuser/',
                        data: $.param($scope.user),
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    }).success(function(data) {
                        if (data.Status.success) {
                            //console.log(user);
                            if(user == null) {
                                $scope.users.push($scope.user);
                            }
                            angular.copy($scope.user, user);

                        }
                    });
                }
            });
        }

    }]);

febApp.controller('AccessCtrl', ['$scope', 'ngDialog', function($scope, ngDialog) {
    $scope.user = $scope.$parent.user;
    //console.log('ACC');
}]);


febApp.controller('ProjectSetupCtrl',
        ['$route', '$scope', '$rootScope', '$http', '$routeParams', 'ngDialog', 'UserService', 'currentUserService', 'ProjectDetailService', '$q', '$timeout',
            function($route, $scope, $rootScope, $http, $routeParams, ngDialog, UserService, currentUserService, ProjectDetailService, $q, $timeout) {

    $scope.manager = {};
    $scope.client = {};
    var managerId;
    var clientId = 0;
    bootbox.setDefaults({locale: "pl"});

    $scope.routeParams = $routeParams;
    
    if($routeParams.hasOwnProperty('leadOrProjectMode') && $routeParams.leadOrProjectMode === 'lead_id'){
        
        $http.post('api/get_lead.json', {lead_id : $routeParams.leadOrProjectId}).success(function(data){
            
            $scope.clientLead = data;
        });
    } else if($routeParams.hasOwnProperty('leadOrProjectMode') && $routeParams.leadOrProjectMode === 'client_project_id'){
        
        $http.post('api/get_client_project.json', {client_project_id : $routeParams.leadOrProjectId}).success(function(data){
            
            $scope.clientProject = data;
            
        });
    }

    var actions = [
        UserService.list().then(function(data) {
            $scope.users = data;
        }),
        UserService.managers().then(function(data) {
            $scope.managersSelect = data;
        }),
        currentUserService.getCurrentUser().then(function(data){
            $rootScope.currentUser = data.data;
            $rootScope.whoami = data.data.name;
            $rootScope.projectName = '- nie wybrano projektu -';          
            //$rootScope.projectName = data.Project.title;
        })
    ];
    if($routeParams.hasOwnProperty('projectId') && $routeParams.projectId != '0') {
        $scope.newProject = false;
        actions.push(
            ProjectDetailService.getData($routeParams.projectId).then(function(data){
                $scope.project = data.data;
                managerId = data.data.Project.manager_id;
                //console.log(data.data.Project);
                clientId =  data.data.Project.client_id;
            })
        );
    } else {

        $scope.newProject = true;
    }
    $q.all(actions).then(function(){
        if($scope.newProject) {
            managerId = $rootScope.currentUser.id;
        }
        // ustawiamy managera i klienta
        angular.forEach($scope.users, function(value, key){
            if(value.User.id == managerId) {
                $scope.manager = value;
            }
            if(value.User.id == clientId) {
                $scope.client = value;               
            }           
        });
        angular.forEach($scope.managersSelect, function(value, key){
            //console.log(value);
            //console.log(managerId);
            if(value.User.id == managerId) {
                $scope.manager = value;
                //console.log($scope.manager);
            }
        });
    });

    $scope.submit = function() {
        
        if(Object.keys($scope.client).length == 0 || $scope.form.$valid !== true)  {           
            return false;
        }
        // ustawiamy klucze obce
        data = $scope.project;
        data.Project.client_id = $scope.client.User.id;
        data.Project.manager_id = $scope.manager.User.id;
             
        params = {Project: data.Project};
        
        //leadOrProjectId
        if($routeParams.leadOrProjectMode == 'lead_id'){
            params.lead_id = $routeParams.leadOrProjectId;
        }

        if($routeParams.leadOrProjectMode == 'client_project_id'){
            params.client_project_id = $routeParams.leadOrProjectId;
        }
             
        $http({
            url: 'api/saveproject',
            data: $.param(params),
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).success(function(response){
            //console.log(data);
            if(response.Status.success==1) {
                $scope.newProject = false;
                //console.log(data);
                //console.log($rootScope.projects);
                //console.log(response);
                //$rootScope.projects.push(response.Project);
                $scope.project = response;
                
                $scope.project.Category = [];

                if(params.Project.id != undefined){
                    $route.reload();                   
                }
            }
        });
    }

    $scope.accessDialog = function(role) {
        if(typeof(accDlg)!=='undefined' && accDlg=='opened')
            return;
        accDlg = 'opened';
        $scope.user = { User: {role: role} };
        var result = ngDialog.open({
            template: 'partials/settings/accessform.html',
            controller: 'AccessCtrl',
            closeByEscape: true,
            closeByDocument: false,
            scope: $scope
        });
        result.closePromise.then(function(data){
            accDlg = 'closed';
            console.log(data);
            if(typeof(data.value)!=='undefined' && data.value=='*') {
                $http({
                    url: 'api/saveuser/',
                    data: $.param($scope.user),
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).success(function(data) {
                    if (data.Status.success==1) {
                        console.log($scope.users);
                        console.log(data);
                        user = {};
                        user.User = data.User;
                        $scope.users.push(user);
                        if(user.User.role=='client') {
                            $scope.client = user;
                        }
                        if(user.User.role=='manager'){
                            $scope.manager = user;
                        }
                        //angular.copy($scope.user, user);

                    }
                });
            }
        });
    }


    $scope.editCategory = function(category) {
        var isNewCategory = true;
        var categoryTitle = '';
        if(category !== null) {
            categoryTitle = category.title
            isNewCategory = false;

        }
        console.log($scope.project);
        bootbox.setDefaults({locale: "pl"});
        var box = bootbox.dialog({
            title: "Nazwa kategorii",
            message: '<input type="text" class="form-control" id="catName" value="' + categoryTitle + '" autofocus autosubmit>',
            buttons: {
            	cancel: {
                    label: 'Anuluj',
                    className: 'btn-danger'
                },
                save: {
                    label: 'Zapisz',
                    className: 'btn-success btn-primary btn-default',
                    callback: function() {
                        var input = document.getElementById('catName');
                        var value = input.value;
                        if(category === null) {
                            category = {project_id: $scope.project.Project.id};
                        }
                        category.title = value;
                        //delete category.pView;
                        var categoryDup = angular.copy(category);
                        delete categoryDup.pView;
                        $http({
                            url: 'api/savecategory',
                            data: $.param({Category: categoryDup}),
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            }
                        }).success(function(data){
                            $scope.errorMessage = '';
                            console.log(data);
                            //$scope.$apply(category);
                            if(isNewCategory===true) {
                                $scope.project.Category.push(data.Category);
                                //console.log(data);
                            }
                        })
                    }
                }

            }
        });
        box.bind('shown.bs.modal', function() {
            box.find("input[autofocus]").focus();
            box.find("input[autosubmit]").keypress(function(e){
                if((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
                    $('.modal-dialog button.btn-default').click();
                }
            });
        });
    }

    $scope.deleteCategory = function(category) {
        bootbox.setDefaults({locale: "pl"});
        bootbox.confirm('Usunąć kategorię <b>' + category.title + '</b>?', function(result){
            if(result===true) {
                $http({
                    url: 'api/deletecategory',
                    data: $.param({Category: category}),
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function(data){
                    if(data.Status.success==1) {
                        $scope.errorMessage = '';
                        for(var i in $scope.project.Category) {
                            if($scope.project.Category[i]==category) {
                                $scope.project.Category.splice(i, 1);
                            }
                        }

                    } else {
                        $scope.errorMessage = 'Błąd podczas usuwania kategorii';
                    }
                });
            }
        });
    }

    $scope.editView = function(view, category) {
        var isNewView = true;
        var viewName = '';
        if(view !== null) {
            viewName = view.name;
            isNewView = false;
        }
        var box = bootbox.dialog({
            title: 'Nazwa widoku',
            message: '<input type="text" class="form-control" id="viewName" value="' + viewName + '" autofocus autosubmit>',
            buttons: {
            	danger: {
                    label: 'Anuluj',
                    className: 'btn-danger'
                },
                main: {   label: 'Zapisz',
                    className: 'btn-success btn-default',
                    callback: function() {
	                	var input = document.getElementById('viewName');
                        var value = input.value;
                        if(view === null) {
                            view = {category_id: category.id, project_id: category.project_id};
                        }
                        view.name = value;
						var viewDup = angular.copy(view);
						delete viewDup.Version;
						$http({
                            url: 'api/saveview',
                            data: $.param({pView: viewDup}),
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            }
                        }).success(function(data){
                            if(data.Status.success != 1) {
                                $scope.errorMessage('Błąd zapisu widoku');
                                return;
                            }
                            $scope.errorMessage = '';
                            if(isNewView===true) {
                                if(!category.hasOwnProperty('pView')) {
                                    category.pView = [];
                                }
                                console.log(data);
                            	category.pView.push(data.pView);
                            }
                        })
                	}
                }

            }
        });
        box.bind('shown.bs.modal', function(){
            box.find("input[autofocus]").focus();
            box.find("input[autosubmit]").keypress(function(e){
                if((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
                    $('.modal-dialog button.btn-default').click();
                }
            });
        });
    }

    $scope.deleteView = function(view) {
		bootbox.confirm('Usunąć widok <b>' + view.name + '</b>?', function(result){
            if(result===true) {
                $http({
                    url: 'api/deleteview',
                    data: $.param({pView: view}),
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function(data){
                    if(data.Status.success==1) {
                        $scope.errorMessage = '';
                        console.log($scope.project);
                        //delete view;
                        for(var i in $scope.project.Category) {
                            for(var j in $scope.project.Category[i].pView) {
                                if($scope.project.Category[i].pView[j]==view) {
                                    $scope.project.Category[i].pView.splice(j, 1);
                                }
                            }
                        }
                    } else {
                        $scope.errorMessage = 'Błąd podczas usunięcia widoku';
                    }
                });
            }
		});
    }

    $scope.refreshVersions = function(project) {
        $scope.successMessage = '';
        $http.get('projects/refresh/' + project.Project.id).success(function(data) {
            versionsAdded = data.length;
            if(versionsAdded)
                $scope.successMessage = 'Wczytano ' + versionsAdded + ' wersji projektów graficznych.';
            else {
                $scope.successMessage = 'Brak wersji do wczytania';
            }
        });
    }

    $scope.archiveProject = function(project) {
        $scope.successMessage='';
        bootbox.confirm('Zarchiwizować projekt <b>' + project.Project.title + '</b>?', function(result){
            if(result===true) {
                $http.get('projects/archive/' + project.Project.id).success(function(data) {
                    if(data.Status.success==1) {
                        $scope.successMessage = 'Projekt ' + project.Project.title + ' został przeniesiony do archiwum';
                        //$scope.project = data;
                        //console.log(data);
                        project.Project.archived = 1;
                    }
                });
            }
        })
    }

    $scope.unarchiveProject = function(project) {
        $scope.successMessage='';
        bootbox.confirm('Przywrócić projekt <b>' + project.Project.title + '</b> z archiwum?', function(result){
            if(result===true) {
                $http.get('projects/unarchive/' + project.Project.id).success(function(data) {
                    if(data.Status.success==1) {
                        $scope.successMessage = 'Projekt ' + project.Project.title + ' został przywrócony z archiwum';
                        project.Project.archived = 0;
                    }
                });
            }
        })
    }

    function getViewByOrdernum(ordernum, dir, view) {
        var minNum = 0;
        var minNumIndex = null;
        var maxNum = Number.MAX_VALUE;
        var maxNumIndex = null;
        var categoryIndex = null;
        for(var i in $scope.project.Category) {
            if($scope.project.Category[i].id == view.category_id) {
                categoryIndex = i;
                for(var j in $scope.project.Category[i].pView) {
                    //console.log($scope.project.Category[i].pView[j].ordernum);
                    if(dir=='<') {
                        if($scope.project.Category[i].pView[j].ordernum < ordernum &&
                            $scope.project.Category[i].pView[j].ordernum > minNum) {
                            minNum = $scope.project.Category[i].pView[j].ordernum;
                            minNumIndex = j;
                        }
                    }
                    if(dir=='>') {
                        if($scope.project.Category[i].pView[j].ordernum > ordernum &&
                            $scope.project.Category[i].pView[j].ordernum < maxNum) {
                            maxNum = $scope.project.Category[i].pView[j].ordernum;
                            maxNumIndex = j;
                        }
                    }
                }
            }
        }
        if(dir=='>') {
            return maxNumIndex;
        }
        if(dir=='<') {
            return minNumIndex;
        }
        return null;
    }


    function getCategoryByOrdernum(ordernum, dir, category) {
        var minNum = 0;
        var minNumIndex = null;
        var maxNum = Number.MAX_VALUE;
        var maxNumIndex = null;
        for(var i in $scope.project.Category) {
            if(dir=='<') {
                if($scope.project.Category[i].ordernum < ordernum &&
                    $scope.project.Category[i].ordernum > minNum) {
                    minNum = $scope.project.Category[i].ordernum;
                    minNumIndex = i;
                }
            }
            if(dir=='>') {
                if($scope.project.Category[i].ordernum > ordernum &&
                    $scope.project.Category[i].ordernum < maxNum) {
                    maxNum = $scope.project.Category[i].ordernum;
                    maxNumIndex = i;
                }
            }
        }
        if(dir=='>') {
            return maxNumIndex;
        }
        if(dir=='<') {
            return minNumIndex;
        }
        return null;
    }

    $scope.viewPositionChange = function(view, direction) {
        for(var i in $scope.project.Category) {
            for(var j in $scope.project.Category[i].pView) {
                if($scope.project.Category[i].pView[j] == view) {
                    var currentNumber = $scope.project.Category[i].pView[j].ordernum;
                    if(direction==-1 && view.ordernum==1) {
                        return;
                    }
                    if(direction==1 && view.ordernum==$scope.project.Category[i].pView.length) {
                        return;
                    }
                    var tIndex = null;
                    if(direction==-1) {
                         tIndex = getViewByOrdernum(currentNumber, '<', view);
                    }
                    if(direction==1) {
                        tIndex = getViewByOrdernum(currentNumber, '>', view);
                    }
                    if(tIndex==null) {
                        return;
                    }
                    var temp = $scope.project.Category[i].pView[tIndex].ordernum;
                    $http.post('api/changevieworder', {
                        viewSourceId: view.id,
                        viewDestinationId: $scope.project.Category[i].pView[tIndex].id
                    }).success(function(data){
                        $scope.project.Category[i].pView[tIndex].ordernum = currentNumber;
                        view.ordernum = temp;
                    });
                    return;
                }
            }
        }
    }

    $scope.categoryPositionChange = function(category, direction) {
        for(i in $scope.project.Category) {
            if($scope.project.Category[i] == category) {
                var currentNumber = $scope.project.Category[i].ordernum;
                if(direction==-1 && category.ordernum==1) {
                    return;
                }
                if(direction==1 && category.ordernum==$scope.project.Category.length) {
                    return;
                }
                var tIndex = null;
                if(direction==-1) {
                    tIndex = getCategoryByOrdernum(currentNumber, '<', category);
                }
                if(direction==1) {
                    tIndex = getCategoryByOrdernum(currentNumber, '>', category);
                }
                if(tIndex==null) {
                    return;
                }
                var temp = $scope.project.Category[tIndex].ordernum;
                $http.post('api/changecategoryorder', {
                    categorySourceId: category.id,
                    categoryDestinationId: $scope.project.Category[tIndex].id
                }).success(function(data){
                    $scope.project.Category[tIndex].ordernum = currentNumber;
                    category.ordernum = temp;

                });
                return;
            }
        }
    }
}]);
