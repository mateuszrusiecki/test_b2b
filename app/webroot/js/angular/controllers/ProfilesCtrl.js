/* 
 * Kontroler profili
 */

app.controller('ProfilesCtrl', function($scope, $http) {
    
    $scope.getProfiles = function() {
        
        $http.post('/profiles/index.json').success(function(data) {

            $scope.profiles = data.profiles;
            
            angular.forEach($scope.profiles, function(profileData) {
                profileData.Profile.id = parseInt(profileData.Profile.id);
            });
        });
    };
        
    $scope.getEmploymentTooltipText = function(state, workingTime){
        
        if(state && workingTime){
            return state + ' ' + workingTime;
        } else {
            return "Brak danych o umowie";
        }
    };
    
    $scope.getContractEndTooltipText = function(employmentEnd){
        
        if(employmentEnd){
            return "Umowa kończy się " + employmentEnd;
        } else {
            return "Brak danych o umowie";
        }
    };
    
    $scope.getProfiles();
});