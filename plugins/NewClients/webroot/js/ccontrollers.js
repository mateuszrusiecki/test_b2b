/*
 * Definicja routingu oraz
 * zestaw kontrollerów dla Klienta
 */

 febApp.config(['$routeProvider', function($routeProvider){
    $routeProvider.when('/projects/:mode/:leadOrProjectId/', {
            templateUrl: 'partials/client/project-list.html',
            controller: 'ProjectListCtrl'
        }).when('/projects', {
            templateUrl: 'partials/client/project-list.html',
            controller: 'ProjectListCtrl'
        }).when('/project/:mode/:leadOrProjectId/:projectId/:viewId', {
            templateUrl: 'partials/project-detail.html',
            controller: 'ProjectListCtrl'
        }).when('/project/:projectId/:viewId', {
            templateUrl: 'partials/project-detail.html',
            controller: 'ProjectListCtrl'
        }).otherwise({
            redirectTo: '/projects'
        });
}]);

///:mode/:leadOrProjectId/

febApp.controller('ProjectListCtrl', [
            '$scope',
            '$rootScope',
            '$http',
            '$routeParams',
            'ClientsProjectService',
            'GlobalService',
            function($scope, $rootScope, $http, $routeParams, ClientsProjectService, GlobalService){
    $scope.projects = [];
    $scope.project = [];
    $rootScope.allPanelsVisible = false;
    $rootScope.sidebarVisible = false;
    $scope.settings = GlobalService;
    $scope.routeParams = $routeParams;
    $rootScope.routeParams = $routeParams;

    ClientsProjectService.list().then(function(data){
        
        $scope.projects = data;
        $rootScope.projects = data;
        $rootScope.leftSidebarVisible = false;
        $rootScope.commentsPanelVisible = false;

        if($routeParams.projectId){
            $http.get('api/projectdetail/' + $routeParams.projectId + '.json').success(function(data) {

                $rootScope.clientName = data.B2BClient.name;      
                $rootScope.currentClient = data.B2BClient;
                $rootScope.currentCoordinator = data.Manager;
            });
        }
        
        // szukamy najnowszej wersji do pokazania
        if(typeof($routeParams.projectId)!='undefined' && typeof($routeParams.viewId)!='undefined') {
            //najpierw ustawiamy aktualny projekt
            for(i in data) {
                if(data[i].Project.id == $routeParams.projectId) {
                    $scope.setCurrentProject(data[i]);
                    $rootScope.sidebarVisible = true;
                    $rootScope.leftSidebarVisible = true;
                    $rootScope.allPanelsVisible = true;
                    $rootScope.commentsPanelVisible = true;
                }
            }
            for(i in $scope.project.Category) {
                var category = $scope.project.Category[i];
                for(j in category.pView) {
                    var view = category.pView[j];
                    if(view.id==$routeParams.viewId) {
                        $rootScope.setVersion(view.Version[0]);
                        //$rootScope.currentVersion = view.Version[0];
                        //console.log($scope.project.Category);
                    }
                }
            }

        } else {

            $scope.setCurrentProject(data[0]);

        }
    });
    $rootScope.project = {Category: {}, pView: {}};

    $scope.setCurrentProject = function(project) {
        $rootScope.catCollapsed = [];
        $rootScope.viewCollapsed = [ [] ];
        $scope.project = project
        $rootScope.project = project;
        $rootScope.projectName = project['Project']['title'];
        $rootScope.allPanelsVisible = true;

        for(i in project.Category) {
            $rootScope.catCollapsed[project.Category[i].id] = 0;
            for(j in project.Category[i].pView) {
                if(typeof($rootScope.viewCollapsed[project.Category[i].pView[j].category_id])=='undefined') {
                    $rootScope.viewCollapsed[project.Category[i].pView[j].category_id] = [];
                }
                $rootScope.viewCollapsed[project.Category[i].pView[j].category_id][project.Category[i].pView[j].id] = false;
            }
        }
        if(!$routeParams.hasOwnProperty('viewId')) {
            $rootScope.catCollapsed[project.Category[0].id] = true;
            $rootScope.viewCollapsed[project.Category[0].pView[0].category_id][project.Category[0].pView[0].id] = true;
            // ustawiamy wersję
            $rootScope.setVersion(project.Category[0].pView[0].Version[0]);
            //$rootScope.currentVersion = project.Category[0].pView[0].Version[0];
            //console.log($rootScope.currentVersion);
        } else {
            angular.forEach(project.Category, function(category, key){
                angular.forEach(category.pView, function(view, key1){
                    if(view.id == $routeParams.viewId) {
                        $rootScope.catCollapsed[category.id] = true;
                        $rootScope.viewCollapsed[category.id][view.id] = true;
                        //console.log(view);
                        $rootScope.setVersion(view.Version[0]);
                        //$rootScope.currentVersion = view.Version[0];
                        //console.log($rootScope.currentVersion);
                        return;
                    }
                });
            });
        }
    }
}]);
