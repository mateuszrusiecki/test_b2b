/* 
 * Kontroler kalendarzy
 */

app.controller('CalendarsCtrl', function($scope, $http, $location) {   
    action_name = $location.absUrl().split('/').pop();
    
    if(action_name == 'add'){
        angular.element('#add_new_calendar').trigger('click');
    }
    
    $scope.getCalendars = function() {
        
        $http.post('/calendars/index.json').success(function(data) {
            $scope.calendars = data.calendars;         
        });
    };
    
    $scope.setClickedCalendarId = function(id, index) {
        
        $scope.clickedCalendarId = id;
        $scope.clickedCalendarIndex = index;
    };
    
    $scope.deleteCallendar = function() {      
        
        $http.post('/calendars/delete', {id : $scope.clickedCalendarId});
        $scope.calendars.splice($scope.clickedCalendarIndex, 1);
    };
    
    $scope.getCalendars();
});