/* 
 * Kontroler szczegółów projektu
 */



app.controller('ProjectDetailCtrl', ['$scope', '$http', '$rootScope', 'ProjectService',
    function($scope, $http, $rootScope, ProjectService) {
        
        ProjectService.list().then(function(data) {
//            $scope.projects = data.data;
//            $rootScope.projects = data.data;
//            $rootScope.commentsPanelVisible = true;
//            $rootScope.sidebarVisible = true;
        });
//        $scope.settings = GlobalService;
//        document.body.style.backgroundColor = '#fff';
//        $scope.currentProjectId = $routeParams.projectId;
//        $scope.newComment = '';
//        $rootScope.currentProjectId = $routeParams.projectId;
//        $http.get('api/projectdetail/' + $routeParams.projectId + '.json').success(function(data) {
//            $rootScope.project = data;
//            $scope.project = data;
//            $rootScope.projectName = data.Project.title;
//            $rootScope.clientName = data.Client.name;
//            $rootScope.leftSidebarVisible = 1;
//            project = $scope.project;
//            for (i in project.Category) {
//                $rootScope.catCollapsed[project.Category[i].id] = false;
//                for (j in project.Category[i].pView) {
//                    if (typeof ($rootScope.viewCollapsed[project.Category[i].pView[j].category_id]) == 'undefined') {
//                        $rootScope.viewCollapsed[project.Category[i].pView[j].category_id] = [ ];
//                    }
//                    $rootScope.viewCollapsed[project.Category[i].pView[j].category_id][project.Category[i].pView[j].id] = false;
//                }
//            }
//            $rootScope.allPanelsVisible = true;
//
//            // otwieramy pierwszą kategorię, pierwszy widok i ładujemy najnowszą wersję (jeśli nie podano viewId)
//            //$rootScope.catCollapsed[p]
//            if(!$routeParams.hasOwnProperty('viewId')) {
//                $rootScope.catCollapsed[project.Category[0].id] = true;
//                $rootScope.viewCollapsed[project.Category[0].pView[0].category_id][project.Category[0].pView[0].id] = true;
//                // ustawiamy wersję
//                $rootScope.setVersion(project.Category[0].pView[0].Version[0]);
//            } else {
//                angular.forEach(project.Category, function(category, key){
//                    angular.forEach(category.pView, function(view, key1){
//                        if(view.id == $routeParams.viewId) {
//                            $rootScope.catCollapsed[category.id] = true;
//                            $rootScope.viewCollapsed[category.id][view.id] = true;
//                            $rootScope.setVersion(view.Version[0]);
//                            return;
//                        }
//                    });
//                });
//            }
//        });
}]);