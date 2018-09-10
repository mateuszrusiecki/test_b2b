/* 
 * Kontroler listy bazy projektów
 */

app.controller('BaseProjectsCtrl', function($scope, $http) {   
    
    $scope.getBaseProjects = function() {
        
        $http.post('/base_projects/index.json').success(function(data) {
            
            $scope.baseProjects = data.baseProjects;         
        });
    };
    
    $scope.setClickedBaseProjectId = function(id, index) {
        
        $scope.clickedBaseProjectId = id;
        $scope.clickedBaseProjectIndex = index;
    };
    
    $scope.deleteBaseProject = function() {      
        
        $http.post('/base_projects/delete', {id : $scope.clickedBaseProjectId});
        $scope.baseProjects.splice($scope.clickedBaseProjectIndex, 1);
    };
    
    $scope.var = 'aaa';
    
    $scope.getBaseProjects();
});