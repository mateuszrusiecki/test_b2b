/* 
 * Kontroler składania wniosków urlopowych
 */

app.controller('VacationsAddCtrl', function($scope, $http) {

    $scope.modal_toggle = 0;
    $scope.vacationSubmit = function (ev) {
        if (angular.element('.row_row').length > 0) {
            //formularz ok, można wysłać
        } else {
            $scope.modal_toggle = 1;
            //$scope.dismiss();
            ev.preventDefault();
            return false;
        }
    }
    
     
  $scope.first = 'first value';
  $scope.second = 'second value';
  
  $scope.$watchCollection('[date_start, date_end]', function(newValues)
  {
      if($scope.date_start && $scope.date_end){

             $http.post("/vacations/get_section_vacations_by_date.json", {date_start: $scope.date_start, date_end: $scope.date_end}).
                    success(function (data) {
                        console.log(data);
                        $scope.section_vacation = false;
                        if(data["section_vacation"][0]) {
                            $scope.section_vacation = data;
                        }
                    });

      }
  });
    
});