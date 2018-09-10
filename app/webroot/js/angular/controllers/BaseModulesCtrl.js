/* 
 * Kontroler listy bazy projektów
 */

app.controller('BaseModulesCtrl', function($scope, $http, $location) {   

    $scope.client_project_id = $location.absUrl().split('/').pop();
    
    if(isNaN($scope.client_project_id)){
        
        $scope.client_project_id = null;
    }

    $scope.getBaseModules = function() {
        
        $http.post('/base_modules/index.json', {client_project_id : $scope.client_project_id}).success(function(data) {
            
            $scope.baseModules = data.baseModules;         
        });
    };
    
    $scope.setClickedBaseModuleId = function(id, index) {
        
        $scope.clickedBaseModuleId = id;
        $scope.clickedBaseModuleIndex = index;
    };
    
    $scope.deleteBaseModule = function() {      
        
        $http.post('/base_modules/delete', {id : $scope.clickedBaseModuleId});
        $scope.baseModules.splice($scope.clickedBaseModuleIndex, 1);
    };
    
    $scope.getBaseModules();
});