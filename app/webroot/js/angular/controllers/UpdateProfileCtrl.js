/* 
 * Kontroler zatwirdzania zmian przez sekretariat
 */

app.controller('UpdateProfileCtrl', function($scope, $parse, $http, $location) {
    profile_id = $location.absUrl().split('/').pop();
    
    $scope.acceptChange = function(fieldName){
        
        elementName = 'hide_' + fieldName;        
        model = $parse(elementName);
        model.assign($scope, 1);
        
        data = {
            fieldName : fieldName, 
            profile_id : profile_id,
        };
        
        $http.post('/profiles/accept_temp_field', data);
    };
    
    $scope.rejectChange = function(fieldName){
        
        elementName = 'hide_' + fieldName + '_temp';        
        model = $parse(elementName);
        model.assign($scope, 1);
        
        data = {
            fieldName : fieldName, 
            profile_id : profile_id,
        };
        
        $http.post('/profiles/reject_temp_field', data);
    }; 
});